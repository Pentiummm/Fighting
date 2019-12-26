@extends('layouts.adminLayout.admin_design')
@section('content')
  <div class="content">
    <h2 class="content-heading">
      Tất cả sản phẩm
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
                          <th>Product name</th>
                          <th>Category</th>
                          <th>Code</th>
                          <th>Price</th>
                          <th>Image</th>
                          <th class="text-center" style="width: 100px;">Actions</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($products as $product)
                      <tr>
                          <th class="text-center">{{ $number++ }}</th>
                          <th>{{ $product->product_name }}</th>
                          <th>{{ $product->category_name }}</th>
                          <th>{{ $product->product_code }}</th>
                          <th>{{ $product->price + 000 }}</th>
                          <th>
                            @if(!empty ($product->image))
                            <img width="70" src="{{ asset('media/backend_images/products/small').'/'.$product->image }}"/>
                            @endif
                          </th>
                          <td>
                              <div class="btn-group">
                                  <button type="button" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="modal" data-target="#modal-popout{{ $product->id }}"><i class="fa fa-eye"></i></button>
                                  <a href="{{ url('admin/editproduct/'.$product->id) }}" class="btn btn-sm btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="Sửa" data-original-title="Sửa">
                                      <i class="fa fa-pencil"></i>
                                  </a>
                                  <a href="" class="btn btn-sm btn-secondary js-tooltip-enabled" id="deleteCategory" data-toggle="tooltip" title="Xóa" data-original-title="Xóa">
                                      <i class="fa fa-times"></i>
                                  </a>
                              </div>
                          </td>
                      </tr>


 <div class="modal fade" id="modal-popout{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-popout" aria-hidden="true">
  <div class="modal-dialog modal-dialog-popout" role="document">
      <div class="modal-content">
          <div class="block block-themed block-transparent mb-0">
              <div class="block-header bg-primary-dark">
                  <h3 class="block-title">{{ $product->product_name }}</h3>
                  <div class="block-options">
                      <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                          <i class="si si-close"></i>
                      </button>
                  </div>
              </div>
              <div class="block-content">
                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
                  <p>Dolor posuere proin blandit accumsan senectus netus nullam curae, ornare laoreet adipiscing luctus mauris adipiscing pretium eget fermentum, tristique lobortis est ut metus lobortis tortor tincidunt himenaeos habitant quis dictumst proin odio sagittis purus mi, nec taciti vestibulum quis in sit varius lorem sit metus mi.</p>
              </div>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-alt-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-alt-success" data-dismiss="modal">
                  <i class="fa fa-check"></i> Perfect
              </button>
          </div>
      </div>
  </div>
</div>

                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>





@endsection
