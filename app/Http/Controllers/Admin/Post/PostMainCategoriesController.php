<?php

namespace App\Http\Controllers\Admin\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Posts\PostMainCategory;

class PostMainCategoriesController extends Controller
{
    public function categoryForm(){
        $mainCategories = DB::table('post_main_Categories')
                            ->get();
        return view('admin.category')->with([
       "mainCategories" => $mainCategories,
        ]);
    }

    public function categoryMain(MainCategoryRequest $request){
        $main = $request->main;
        PostMainCategory::insert([
            'main_category' => $main,
        ]);
        return redirect('/home');
    }

    public function categoryMainDelete($id){
        PostMainCategory::where('id', $id)
            ->delete();

        return back();
    }
}
