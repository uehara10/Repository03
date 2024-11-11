@extends('layouts.app')

@section('content')
<div class="container">
  <h1>商品登録</h1>

  @if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
  @endif

  <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="product_name">商品名 <span class="required-marker">*</span></label>
      <input type="text" name="product_name" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="company_id">企業名 <span class="required-marker">*</span></label>
      <select name="company_id" class="form-control" required>
        <option value="">企業を選択してください</option>
        @foreach ($companies as $company)
        <!--<option value="{{ $company->id }}">{{ $company->name }}</option>-->
        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
        @endforeach

      </select>
    </div>

    <div class="form-group">
      <label for="price">価格 <span class="required-marker">*</span></label>
      <input type="number" name="price" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="stock">在庫数 <span class="required-marker">*</span></label>
      <input type="number" name="stock" class="form-control" required>
    </div>

    <div class="form-group">
      <label for="comment">コメント</label>
      <textarea name="comment" class="form-control"></textarea>
    </div>

    <div class="form-group">
      <label for="img_path">商品画像</label>
      <input type="file" name="img_path" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">登録</button>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
  </form>
</div>
@endsection