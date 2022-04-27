<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Posts\PostSubCategory;

class PostSubCategoriesController extends Controller
{

    public function categorySub(SubCategoryRequest $request){
        $sub_main = $request->sub_main;
        $sub = $request->sub;
        PostSubCategory::insert([
            'post_main_category_id' => $sub_main,
            'sub_category' => $sub,
        ]);
        return redirect('/home');
    }

    public function categorySubDelete($id){
        PostSubCategory::where('id', $id)
            ->delete();

        return back();
    }
}
