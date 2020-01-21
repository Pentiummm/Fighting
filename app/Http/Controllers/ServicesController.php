<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use Validator;
use App\Ftp\FtpClient;
use App\Ftp\FtpWrapper;
use App\Plesk\PleskApiClient;
use App\Service;
use Carbon\Carbon;


class ServicesController extends Controller
{
    protected $rules =
    [
        'service_name' => 'required|min:3|max:32',
        'tpl_code' => 'required|min:3|max:128'
    ];

    private function setting($var_name){
        $var_name == 'webspace_name' ? $var = config('constants.webspace_name') : '';
        $var_name == 'host' ? $var = config('constants.host') : '';
        $var_name == 'login' ? $var = config('constants.login') : '';
        $var_name == 'password' ? $var = config('constants.password') : '';
        $var_name == 'login_ftp' ? $var = config('constants.login_ftp') : '';
        $var_name == 'password_ftp' ? $var = config('constants.password_ftp') : '';
        return $var;
    }

    public function index(Request $request) {
    	$datas = $request->all();
    	return view('admin.services.add_service');
    }

    public function add(Request $request) {

        $datas = $request->all();   
        $validator = Validator::make($datas, $this->rules);

        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {

            $date_now = Carbon::now()->toDateTimeString();

            $service = new Service;
            $service['service_name'] = $datas['service_name'];
            $service['template_code'] = $datas['tpl_code'];
            $service['name_customer'] = $datas['name_customer'];
            $service['email_customer'] = $datas['email_customer'];
            $service['service_pack'] = '';
            $service['start_date'] = $date_now;
            $service['end_date'] = $date_now;
            $service['ftp_password'] = '';
            $service['status'] = 1;
            $service->save();

            return response()->json(array('success'=>'ok','service' =>$service));
        }

    }

    public function allService(Request $request) {
        $services = Service::get();

        return view('admin.services.all_service', compact('services'))
          ->with('number', 1);
    }
    

    public function addSubDomain(Request $request) {
        $datas = $request->all();

        $validator = Validator::make($datas, [
            'service_name' => 'required',
            'template_code' => 'required',
        ]);

        $plesk_client = new PleskApiClient( $this->setting('host') );
        $plesk_client->setCredentials( $this->setting('login'), $this->setting('password'));

        $request_new_subdomain = '
        <packet>
            <subdomain>
                <add>
                    <parent>miyvietnam.com</parent>
                    <name>'.$datas["service_name"].'</name>
                    <property>
                        <name>www_root</name>
                        <value>/'.$datas["service_name"].'</value>
                    </property>
                </add>
            </subdomain>
        </packet>
        ';

        $response = $plesk_client->request($request_new_subdomain);
        $xml_response = simplexml_load_string($response) or die("Error: Cannot create object");
        $status = $xml_response->subdomain->add->result->status;
        $id_webspace = $xml_response->subdomain->add->result->id;

        if ($validator->passes()) {
            return response()->json([
               'result' => $status,
               'id_webspace' => $id_webspace
           ]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

    public function createFtp(Request $request) {
       
        $datas = $request->all();

        $plesk_client = new PleskApiClient( $this->setting('host') );
        $plesk_client->setCredentials( $this->setting('login'), $this->setting('password') );
        $request_new_ftp_site = '
            <packet>
               <ftp-user>
                   <add>
                      <name>uftp_'.$datas["service_name"].'</name>
                      <password>'.$datas["ftp_password"].'</password>
                      <home>/'.$datas["service_name"].'</home>
                      <permissions>
                           <read>true</read>
                           <write>true</write>
                       </permissions>
                      <webspace-name>'.$this->setting('webspace_name').'</webspace-name>
                   </add>
               </ftp-user>
           </packet>
        ';

        $response_new_ftp = $plesk_client->request($request_new_ftp_site);
        $xml_response_new_ftp = simplexml_load_string($response_new_ftp) or die("Error: Cannot create object");
        $ftpuser = 'ftp-user';
        $status = $xml_response_new_ftp->$ftpuser->add->result->status;

        if($status == 'ok'){
            Service::where('service_name', $datas["service_name"])->update(["ftp_password" => $datas["ftp_password"]]);
        }

        return response()->json(['result' => $status]);
    
    }

    public function createDatabase(Request $request) {
        $datas = $request->all();

        $plesk_client = new PleskApiClient( $this->setting('host') );
        $plesk_client->setCredentials( $this->setting('login'), $this->setting('password') );

        $request_get_info = '
            <packet>
                <site>
                    <get>
                        <filter>
                            <name>'.$this->setting('webspace_name').'</name>
                        </filter>
                        <dataset>
                            <hosting/>
                        </dataset>
                    </get>
                </site>
            </packet>
        ';

        $response_get_info = $plesk_client->request($request_get_info);
        $xml_response_info = simplexml_load_string($response_get_info) or die("Error: Cannot create object");
        $status_get_info = $xml_response_info->site->get->result->status;
        $id_site = $xml_response_info->site->get->result->id;

        if($id_site){

            $request_new_database = '
                <packet>
                    <database>
                        <add-db>
                            <webspace-id>'.$id_site.'</webspace-id>
                            <name>db_'.$datas["service_name"].'</name>
                            <type>mysql</type>
                        </add-db>
                    </database>
                </packet>
            ';

            $response_new_db = $plesk_client->request($request_new_database);
            $xml_response_new_db = simplexml_load_string($response_new_db) or die("Error: Cannot create object");
            $adddb = 'add-db';
            $id_db = $xml_response_new_db->database->$adddb->result->id;

            if($id_db){
                $request_new_database_user = '
                    <packet>
                        <database>
                            <add-db-user>
                                <db-id>'.$id_db.'</db-id>
                                <login>dbu_'.$datas["service_name"].'</login>
                                <password>'.$datas["ftp_password"].'</password>
                            </add-db-user>
                        </database>
                    </packet>
                ';
                $response_new_db_user = $plesk_client->request($request_new_database_user);
                $xml_response_new_db_user = simplexml_load_string($response_new_db_user) or die("Error");
                $adddb_user = 'add-db-user';
                $status = $xml_response_new_db_user->database->$adddb_user->result->status;

                if($status == 'ok'){

                    $user  = 'dbu_'.$datas["service_name"];
                    $pass = $datas["ftp_password"];
                    $$dbname = 'db_'.$datas["service_name"];
                    
                    $datas = $request->all();
                    $extract = '://'.$datas["service_name"].'.'.$this->setting('webspace_name').'/install.php';
                    $result_extra = file_get_contents($extract);

                    // $this->importDb('data.sql', $this->setting('host'), $user, $pass, $dbname);
                }
            }
        }

        return response()->json(['result_info' => $status_get_info, 'id' => $id_site, 'result_db' => $xml_response_new_db, 'result_db_user' => $xml_response_new_db_user, 'result' => $status, 'result_extra' => $result_extra]);  
    }

    public function clearAndUpSource(Request $request) {
        $datas = $request->all();
      
        $ftp = new FtpClient();
        $ftp->connect($this->setting('host'));
        $ftp->login('uftp_'.$datas["service_name"], $datas["ftp_password"]);

        return response()->json([
           'empty' => $ftp->cleanDir('./'), // Xóa file
           'empty_img' => $ftp->cleanDir('./img'), // Xóa file trong thư mục img
           'empty_fonts' => $ftp->cleanDir('./fonts'),
           'empty_f_img' => $ftp->rmdir('./img'), // Xóa thư mục
           'empty_f_fonts' => $ftp->rmdir('./fonts'), // Xóa thư mục
           'upload_source' => $ftp->put('./source.zip', 'https://miyvietnam.com/car.zip', FTP_BINARY),
           'upload_install_file' => $ftp->put('./install.php', 'https://miyvietnam.com/install.php', FTP_BINARY)
        ]);
    }  

    public function importDb($file_name, $host, $user, $pass, $dbname){
        $conn =new mysqli($host, $user, $pass , $dbname);
        $query = '';
        $sqlScript = file($file_name);
        foreach ($sqlScript as $line)   {
            
            $startWith = substr(trim($line), 0 ,2);
            $endWith = substr(trim($line), -1 ,1);
            
            if (empty($line) || $startWith == '--' || $startWith == '/*' || $startWith == '//') {
                continue;
            }
                
            $query = $query . $line;
            if ($endWith == ';') {
                mysqli_query($conn,$query) or die('Problem in executing the SQL query <b>' . $query. '</b>');
                $query= '';     
            }
        }
        return 'done';
    }

    // unlink( ROOT_PATH.'/commit.php' ); xóa file

    public function ajaxRequest() {
        return view('ajaxRequest');
    }

    public function ajaxRequestPost(Request $request) {

        $datas = $request->all();

        $validator = Validator::make($datas, [
            'name' => 'required',
            'code' => 'required',
        ]);

        // begin ftp
        $host = '45.32.17.187';
        $login_ftp = 'ftpuser1';
        $password_ftp = 'Pvhung@1990';

        $ftp = new FtpClient();
        $ftp->connect($host);
        $ftp->login($login_ftp, $password_ftp);
        
        return response()->json([
            'test' => $this->setting('webspace_name'),
            'isDir' => $ftp->isDir('./fonts') // chech forlder
            // 'response' => $ftp->scanDir('./', true),
            // 'empty' => $ftp->cleanDir('./'), // Xóa file
            // 'empty_img' => $ftp->cleanDir('./img'), // Xóa file trong thư mục img
            // 'empty_fonts' => $ftp->cleanDir('./fonts'),
            // 'empty_f_img' => $ftp->rmdir('./img'), // Xóa thư mục
            // 'empty_f_fonts' => $ftp->rmdir('./fonts') // Xóa thư mục
            // 'upload_source' => $ftp->putFromPath('https://miyvietnam.com/s_miy.zip')
        ]);
        // end frp    

        if ($validator->passes()) {
			return response()->json([
                'response' => $xml_response,
                'result' => $status,
                'id_webspace' => $id_webspace,
                'datas'   => $datas,
                'xml_response_new_ftp' => $xml_response_new_ftp
            ]);
        }
    	return response()->json(['error'=>$validator->errors()->all()]);
    }
}