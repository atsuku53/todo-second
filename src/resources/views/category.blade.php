@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/category.css') }}" />
@endsection

@section('content')

<div class="category__alert">

  @if (session('message'))
  <div class="category__alert--success">
    {{session('message')}}
  </div>
  @endif

  @if ($errors->any())
  <div class="category__alert--danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{$error}}</li>
      @endforeach
    </ul>
  </div>
  @endif

</div>

<div class="category__content">
  <form class="create-form" method="POST" action="/categories">
    @csrf
    <h1 class="create-form__title">カテゴリ新規作成</h1>
    <div class="create-form__content">
      <div class="create-form__item">
        <input class="create-form__item-input" type="text" name="name" placeholder="新しいカテゴリを入力してください" value="{{old('name')}}">
      </div>
      <div class="create-form__button">
        <button class="create-form__button-submit" type="submit">作成</button>
      </div>
    </div>
  </form>
  <div class="category-table">
    <table class="category-table__inner">
      <tr class="category-table__row">
        <th class="category-table__header">カテゴリ</th>
      </tr>
      @foreach ($categories as $category)
      <tr class="category-table__row">
        <form class="update-form" method="POST" action="/categories/update">
          @csrf
          @method('PATCH')
          <td class="category-table__item">
            <div class="update-form__item">
              <input class="update-form__item-input" type="text" name="name" value="{{$category->name}}">
              <input type="hidden" name="id" value="{{$category->id}}">
            </div>
          </td>
          <td class="category-table__item-button">
            <div class="update-form__button">
              <button class="update-form__button-submit" type="submit">更新</button>
            </div>
          </td>
        </form>
        <form class="delete-form" method="POST" action="/categories/delete">
          @csrf
          @method('DELETE')
          <td class="category-table__item-button">
            <div class="delete-form__button">
              <input type="hidden" name="name" value="{{$category->name}}">
              <input type="hidden" name="id" value="{{$category->id}}">
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