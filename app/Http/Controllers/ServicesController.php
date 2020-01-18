<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

use App\Ftp\FtpClient;
use App\Ftp\FtpWrapper;
use App\Plesk\PleskApiClient;

class ServicesController extends Controller
{
    private function setting($var_name){
        $var_name == 'webspace_name' ? $var = config('constants.webspace_name') : '';
        $var_name == 'host' ? $var = config('constants.host') : '';
        $var_name == 'login' ? $var = config('constants.login') : '';
        $var_name == 'password' ? $var = config('constants.password') : '';
        $var_name == 'login_ftp' ? $var = config('constants.login_ftp') : '';
        $var_name == 'password_ftp' ? $var = config('constants.password_ftp') : '';
        return $var;
    }

    public function addService(Request $request) {
    	$datas = $request->all();
        var_dump($datas);
    	return view('admin.services.add_service');
    }

    public function addSubDomain(Request $request) {
        $datas = $request->all();

        $validator = Validator::make($datas, [
            'name' => 'required',
            'code' => 'required',
        ]);

        $plesk_client = new PleskApiClient( $this->setting('host') );
        $plesk_client->setCredentials( $this->setting('login'), $this->setting('password'));

        $request_new_subdomain = '
        <packet>
            <subdomain>
                <add>
                    <parent>miyvietnam.com</parent>
                    <name>'.$datas["name"].'</name>
                    <property>
                        <name>www_root</name>
                        <value>/'.$datas["name"].'</value>
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

        $validator = Validator::make($datas, [
            'name' => 'required',
            'code' => 'required',
        ]);

        $plesk_client = new PleskApiClient( $this->setting('host') );
        $plesk_client->setCredentials( $this->setting('login'), $this->setting('password') );

        $request_new_ftp_site = '
            <packet>
               <ftp-user>
                   <add>
                      <name>ftpuser1</name>
                      <password>Pvhung@1990</password>
                      <home>/'.$datas["name"].'</home>
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

        if ($validator->passes()) {
            return response()->json([
               'result' => $xml_response_new_ftp
           ]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }

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