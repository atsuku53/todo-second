<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;


class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::all();
        return view('category', ['categories' => $categories]);
    }

    public function store(CategoryRequest $request)
    {
        $name = $request->input('name');
        $message = $name . 'を作成しました。';
        Category::create(['name' => $name]);
        return redirect('/category')->with('message', $message);
    }

    public function update(CategoryRequest $request)
    {
        $name = $request->input('name');
        Category::find($request->input('id'))->update(['name' => $name]);
        $message = $name . 'に更新しました。';
        return redirect('/category')->with('message', $message);
    }

    public function delete(Request $request)
    {
        $name = $request->input('name');
        Category::find($request->input('id'))->delete();
        $message = $name . 'を削除しました。';
        return redirect('/category')->with('message', $message);
    }
}
