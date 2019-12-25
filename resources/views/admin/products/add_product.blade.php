@extends('layouts.adminLayout.admin_design')
@section('content')
<div class="content">
    <h2 class="content-heading">
      Thêm sản phẩm
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
              <h3 class="block-title">Thông tin sản phẩm thêm mới</h3>
              <div class="block-options">
                  <button type="button" class="btn-block-option">
                      <i class="si si-wrench"></i>
                  </button>
              </div>
          </div>

          <div class="block-content">
              <form enctype="multipart/form-data" class="js-validation-bootstrap" action="{{ url('admin/addproduct') }}" method="post" novalidate="novalidate">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_name">Product Name <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="prod_name" name="prod_name" placeholder="Enter a name product...">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="cat-name">Category <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <select class="form-control" name="category_id">
                          <?php echo $categories_dropdown; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_code">Code (SKU) <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="prod_code" name="prod_code" placeholder="Your Code..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_color">Color <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="prod_color" name="prod_color" placeholder="Your Color..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_description">Description <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                      <textarea class="form-control" id="prod_description" name="prod_description" rows="6" placeholder="Description..."></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_price">Price <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                        <input type="text" class="form-control" id="prod_price" name="prod_price" placeholder="Your Price..">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-4 col-form-label" for="prod_color">Image <span class="text-danger">*</span></label>
                    <div class="col-lg-8">
                      <div class="custom-file">
                          <input type="file" class="custom-file-input js-custom-file-input-enabled" id="example-file-input-custom" name="prod_image" data-toggle="custom-file-input">
                          <label class="custom-file-label" for="example-file-input-custom">Choose file</label>
                      </div>
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
