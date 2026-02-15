<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo2;
use App\Http\Requests\TodoRequest;
use App\Models\Category;


class Todo2Controller extends Controller
{
    public function index()
    {
        $todos = Todo2::with('category')->get();
        $categories = Category::all();
        return view('index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function store(TodoRequest $request)
    {
        $content = $request->input('content');
        $category_id = $request->input('category_id');
        $message = $content . 'を作成しました。';
        Todo2::create(['content' => $content, 'category_id' => $category_id]);
        return redirect('/')->with('message', $message);
    }

    public function update(TodoRequest $request)
    {
        $content = $request->input('content');
        Todo2::find($request->input('id'))->update(['content' => $content]);
        $message = $content . 'に更新しました。';
        return redirect('/')->with('message', $message);
    }

    public function delete(Request $request)
    {
        $content = $request->input('content');
        Todo2::find($request->input('id'))->delete();
        $message = $content . 'を削除しました。';
        return redirect('/')->with('message', $message);
    }

    public function search(Request $request)
    {
    $todos = Todo2::with('category')->CategorySearch($request->category_id)->KeywordSearch($request->keyword)->get();
    $categories = Category::all();

    return view('index', compact('todos', 'categories'));
    }

}
