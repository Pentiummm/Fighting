<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use Image;
use App\Product;
use App\Category;


class ProductsController extends Controller
{
   public function index()
   {
       return Product::all();
   }

   public function allProduct()
   {
     $products = Product::get();
     $products = json_decode(json_encode($products));
     foreach ($products as $key => $value) {
        $category_name = Category::where(['id'=>$value->category_id])->first();
        $products[$key]->category_name = $category_name->name;
     }
     // echo '<pre>'; var_dump($products); echo '</pre>'; die;
     return view('admin.products.all_product', compact('products'))->with('number', 1);
   }

   public function addProduct(Request $request)
   {
      if($request->isMethod('post')){
        $data = $request->all();

        $product = new Product;
        $product['category_id'] = $data['category_id'];
        $product['product_name'] = $data['prod_name'];
        $product['product_code'] = $data['prod_code'];
        $product['product_color'] = $data['prod_color'];
        $product['description'] = $data['prod_description'];
        $product['price'] = $data['prod_price'];
        if($request->hasFile('prod_image')){

          $image_tmp = $request->file('prod_image');

          if($image_tmp->isValid()){
              $extension = $image_tmp->getClientOriginalExtension();
              $filename = rand(111,999999).'.'.$extension;
              $large_image_path = 'media/backend_images/products/large/'.$filename;
              $medium_image_path = 'media/backend_images/products/medium/'.$filename;
              $small_image_path = 'media/backend_images/products/small/'.$filename;

              // Resize Images;
              Image::make($image_tmp)->save($large_image_path);
              Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
              Image::make($image_tmp)->resize(300,300)->save($small_image_path);

              // Store image name in products table
              $product->image = $filename;
          }
        }

        $product->save();
        return redirect('admin/allproduct')->with('flash_message_success', 'Thêm mới sản phẩm thành công !');

      }
      $categories = Category::where(['parent_id'=>0])->get();
      $categories_dropdown = "<option selected disable>Select</option>";
      foreach ($categories as $cat) {
        $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
        $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
        foreach ($sub_categories as $sub_cat) {
          $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
        }
      }
      return view('admin.products.add_product')
        ->with(compact('categories_dropdown'));
    }
}
