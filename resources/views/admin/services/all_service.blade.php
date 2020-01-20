@extends('layouts.adminLayout.admin_design')
@section('content')
  <div class="content">
    <h2 class="content-heading">
      Tất cả danh mục
    </h2>

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

    <div class="block">
          <div class="block-header block-header-default">
              <h3 class="block-title">Table</h3>
              <div class="block-options">
                  <div class="block-options-item">
                      <code>.table</code>
                  </div>
              </div>
          </div>

          <div class="block-content">
              <table class="table table-vcenter">
                  <thead>
                      <tr>
                          <th class="text-center" style="width: 50px;">#</th>
                          <th>Service Name</th>
                          <th>Template Code</th>
                          <th>Status</th>
                          <th class="text-center" style="width: 100px;">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($services as $service)
                      <tr>
                          <th class="text-center" scope="row">{{ $number++ }}</th>
                          <td>{{ $service->service_name }}</td>
                          <td>{{ $service->template_code }}</td>
                          <td>{{ $service->status }}</td>
                          <td class="text-center">
                              <div class="btn-group">
                                  <a href="{{ url('/admin/editservice/'.$service->id) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="Sửa" data-original-title="Sửa">
                                      <i class="fa fa-pencil"></i>
                                  </a>
                                  <a href="{{ url('/admin/deleteservice/'.$service->id) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" id="deleteCategory" data-toggle="tooltip" title="Xóa" data-original-title="Xóa">
                                      <i class="fa fa-times"></i>
                                  </a>
                              </div>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
@endsection
