@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="content">
    <h2 class="content-heading">
      Cập nhật danh mục
    </h2>
    <div class="row">
      <div class="col-md-12">
        <div class="block">
          <div class="block-header block-header-default">
              <h3 class="block-title">Thông tin danh mục cập nhật</h3>
              <div class="block-options">
                  <button type="button" class="btn-block-option">
                      <i class="si si-wrench"></i>
                  </button>
              </div>
          </div>
          <div class="block-content">
              <form class="js-validation-bootstrap" action="{{ url('admin/editcategory/'.$categoryDetails->id) }}" method="post" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="cat-name">Name <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="cat-name" name="cat_name" value="{{ $categoryDetails->name }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="cat-url">Url <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="cat-url" name="cat_url" value="{{ $categoryDetails->url }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="cat-description">Description <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                      <textarea class="form-control" id="cat-description" name="cat_description" rows="6">{{ $categoryDetails->description }} </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-lg-8 ml-auto">
                        <button type="submit" class="btn btn-alt-primary">Cập nhật</button>
                    </div>
                </div>
            </form>
          </div>
      </div>
      </div>
    </div>
</div>
@endsection
