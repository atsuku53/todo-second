@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section('content')

<div class="todo__alert">

  @if (session('message'))
  <div class="todo__alert--success">
    {{session('message')}}
  </div>
  @endif

  @if ($errors->any())
  <div class="todo__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

</div>

<div class="todo__content">
  <form class="create-form" method="POST" action="/todos">
    @csrf
    <h1 class="create-form__title">新規作成</h1>
    <div class="create-form__content">
      <div class="create-form__item">
        <input class="create-form__item-input" type="text" name="content" placeholder="新しいタスクを入力してください">
      </div>
      <div class="create-form__category">
        <select class="create-form__category-select" type="select" name="category_id">
          <option value="">カテゴリ</option>
          @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="create-form__button">
        <button class="create-form__button-submit" type="submit">作成</button>
      </div>
    </div>
  </form>
  <form class="search-form" method="GET" action="/todos/search">
    @csrf
    <h1 class="search-form__title">Todo検索</h1>
    <div class="search-form__content">
      <div class="search-form__item">
        <input class="search-form__item-input" type="text" name="keyword" placeholder="キーワードを入力してください" value="{{old('keyword')}}">
      </div>
      <div class="search-form__category">
        <select class="search-form__category-select" type="select" name="category_id">
          <option value="">カテゴリ</option>
          @foreach ($categories as $category)
          <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="search-form__button">
        <button class="search-form__button-submit" type="submit">検索</button>
      </div>
    </div>
  </form>
  <div class="todo-table">
    <table class="todo-table__inner">
      <tr class="todo-table__row">
        <th class="todo-table__header">Todo</th>
        <th class="todo-table__header">カテゴリ</th>
        <th class="todo-table__item-button"></th>
        <th class="todo-table__item-button"></th>
      </tr>
      @foreach ($todos as $todo)
      <tr class="todo-table__row">
        <form class="update-form" method="POST" action="/todos/update">
          @csrf
          @method('PATCH')
          <td class="todo-table__item">
            <div class="update-form__item">
              <input class="update-form__item-input" type="text" name="content" value="{{$todo->content}}">
              <input type="hidden" name="id" value="{{$todo->id}}">
            </div>
          </td>
          <td class="todo-table__item">
            <div class="update-form__category">
              <p class="update-form__category-select">{{$todo->category->name}}</p>
            </div>
          </td>
          <td class="todo-table__item-button">
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </td>
        </form>
        <form class="delete-form" method="POST" action="/todos/delete">
          @csrf
          @method('DELETE')
          <td class="todo-table__item-button">
            <div class="delete-form__button">
              <input type="hidden" name="content" value="{{$todo->content}}">
              <input type="hidden" name="id" value="{{$todo->id}}">
              <button class="delete-form__button-submit" type="submit">削除</button>
            </div>
          </td>
        </form>
      </tr>
      @endforeach
    </table>
  </div>
</div>

@endsection