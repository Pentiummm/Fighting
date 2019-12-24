@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="content">
    <h2 class="content-heading">
      Thêm danh mục
    </h2>
    <div class="row">
      <div class="col-md-12">
        <div class="block">
          <div class="block-header block-header-default">
              <h3 class="block-title">Thông tin danh mục mới</h3>
              <div class="block-options">
                  <button type="button" class="btn-block-option">
                      <i class="si si-wrench"></i>
                  </button>
              </div>
          </div>
          <div class="block-content">
              <form class="js-validation-bootstrap" action="{{ url('admin/addcategory') }}" method="post" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="cat-name">Name <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="cat-name" name="cat_name" placeholder="Enter a name cateogry..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="cat-url">Url <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="cat-url" name="cat_url" placeholder="Your url..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="cat-description">Description <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                      <textarea class="form-control" id="cat-description" name="cat_description" rows="6" placeholder="Description..."></textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-8 ml-auto">
                        <button type="submit" class="btn btn-alt-primary">Submit</button>
                    </div>
                </div>
            </form>
          </div>
      </div>
      </div>
    </div>
</div>
@endsection
