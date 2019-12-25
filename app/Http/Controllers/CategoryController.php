<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function allCategory()
    {
        $categories = Category::get();
        // $categories = json_decode(json_encode($categories));
        // echo '<pre>'; var_dump($categories); exit;
        return view('admin.categories.all_category', compact('categories'))
          ->with('number', 1);
    }

    public function addCategory(Request $request)
    {
      if($request->isMethod('post')){
        $data = $request->all();
        $category = new Category;
        $category->name = $data['cat_name'];
        $category->parent_id = $data['parent_id'];
        $category->url = $data['cat_url'];
        $category->description = $data['cat_description'];
        $category->save();
        return redirect('admin/allcategory')
          ->with('flash_message_success', 'Tạo mới danh mục thành công !');
      }
      $levels = Category::where(['parent_id'=>0])->get();
      return view('admin.categories.add_category')
        ->with(compact('levels'));
    }

    public function editCategory(Request $request, $id = NULL)
    {
      if($request->isMethod('post')){
        $data = $request->all();
        Category::where(['id'=>$id])
          ->update([
            'name' => $data['cat_name'],
            'parent_id'=>$data['parent_id'],
            'url' => $data['cat_url'],
            'description' => $data['cat_description']
          ]);
        return redirect('admin/allcategory')
          ->with('flash_message_success', 'Cập nhật danh mục thành công !');
      }

      $categoryDetails = Category::where(['id'=>$id])->first();
      $levels = Category::where(['parent_id'=>0])->get();
      return view('admin.categories.edit_category')
        ->with(compact('categoryDetails', 'levels'));
    }

    public function deleteCategory($id = NULL)
    {
      if(!empty($id)){
        Category::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success', 'Xóa danh mục thành công !');
      }
    }
}
