@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="content">
    <h2 class="content-heading">
      Thêm thuộc tính sản phẩm
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

        <div class="block">
          <div class="block-header block-header-default">
              <h3 class="block-title">Thông mới thuộc tính</h3>
              <div class="block-options">
                  <button type="button" class="btn-block-option">
                      <i class="si si-wrench"></i>
                  </button>
              </div>
          </div>

          <div class="block-content">
              <form enctype="multipart/form-data" class="js-validation-bootstrap" action="{{ url('admin/addattribute/'.$productDetails->id) }}" method="post" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_name">Product Name <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="prod_name" name="prod_name" value="{{ $productDetails->product_name }}">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_code">Code (SKU) <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="prod_code" name="prod_code" value="{{ $productDetails->product_code }}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_color">Color <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="prod_color" name="prod_color" value="{{ $productDetails->product_color }}">
                    </div>
                </div>

                <div class="form-group form-inline row">
                    <label class="col-lg-4 col-form-label" for="">Add Color <span class="text-danger">*</span></label>
                    <div class="col-lg-8 wrapper">
                        <input type="text" class="form-control" name="sku[]" placeholder="SKU" style="width: 120px;"/>
                        <input type="text" class="form-control" name="size[]" placeholder="Size" style="width: 120px;"/>
                        <input type="text" class="form-control" name="price[]" placeholder="Price" style="width: 120px;"/>
                        <input type="text" class="form-control" name="stock[]" placeholder="Stock" style="width: 120px;"/>
                        <a href="javascript:void(0);" class="add_button" title="Add field">Add +</a>
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
