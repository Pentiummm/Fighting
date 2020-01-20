@extends('layouts.adminLayout.admin_design')

@section('content')

<div class="content">
    <h2 class="content-heading">
      Thêm dịch vụ
    </h2>
    <div class="row">
      <div class="col-md-12">

            @if ( Session::has('flash_message_error') )
            <div class="alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ session('flash_message_error') }}</strong>
            </div>
            @endif

            @if ( Session::has('flash_message_success') )
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ session('flash_message_success') }}</strong>
            </div>
            @endif
            
            <div id="success_message"></div>

        <div class="block">
          <div class="block-header block-header-default">
              <h3 class="block-title">Thông tin dịch vụ</h3>
              <div class="block-options">
                  <button type="button" class="btn-block-option">
                      <i class="si si-wrench"></i>
                  </button>
              </div>
          </div>

          <div class="block-content">
              <form enctype="multipart/form-data" class="js-validation-bootstrap" action="{{ url('admin/addservice') }}" method="post" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="service_name">Service Name <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="service_name" name="service_name" placeholder="Enter a service name...">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="tpl_code">Template Code <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="tpl_code" name="tpl_code" placeholder="Your Template Code..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="name_customer">Name Customer <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="name_customer" name="name_customer" placeholder="...">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="email_customer">Email Customer <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="email" class="form-control" id="email_customer" name="email_customer" placeholder="...">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="ftp_password">FTP Password <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                      <input type="text" class="form-control" id="ftp_password" name="ftp_password" value="{{ str_random(8) }}">
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-8 ml-auto">
                        <button type="submit" class="btn btn-alt-primary btn-submit-service" id="submit_handle">Submit</button>
                    </div>
                </div>
            
                <div class="form-group" id="process" style="display:none;">
                   <div class="progress">
                      <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" style=""></div>
                   </div>
                </div>

            </form>
          </div>
      </div>
      </div>
    </div>
</div>

@endsection