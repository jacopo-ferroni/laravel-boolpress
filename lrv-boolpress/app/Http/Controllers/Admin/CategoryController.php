<?php

namespace App\Http\Controllers\Admin;
use App\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show($id) {

        $category = Category::find($id);
        return view('admin.categories.show', compact('category'));
    }
}
