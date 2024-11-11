@extends('layouts.app')

@section('content')
<div class="container">
  <h1>商品情報編集</h1>
  <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
      <label for="product_name">商品名 <span class="required-marker">*</span></label>
      <input type="text" name="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
    </div>

    <div class="form-group">
      <label for="company_id">企業名 <span class="required-marker">*</span></label>
      <select name="company_id" class="form-control" required>
        @foreach ($companies as $company)
        <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>
          {{ $company->company_name }}
        </option>
        @endforeach
      </select>
    </div>

    <div class="form-group">
      <label for="price">価格 <span class="required-marker">*</span></label>
      <input type="number" name="price" class="form-control" value="{{ old('price', $product->price) }}" required>
    </div>

    <div class="form-group">
      <label for="stock">在庫数 <span class="required-marker">*</span></label>
      <input type="number" name="stock" class="form-control" value="{{ old('stock', $product->stock) }}" required>
    </div>
    <div class="form-group">
      <label for="comment">コメント</label>
      <textarea name="comment" class="form-control">{{ old('comment', $product->comment) }}</textarea>
    </div>

    <div class="form-group">
      <label for="img_path">商品画像</label>
      <input type="file" name="img_path" class="form-control">
      @if ($product->img_path)
      <p>現在の画像:</p>
      <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-width: 100px;">
      @endif
    </div>

    <button type="submit" class="btn btn-primary">更新</button>
    <a href="{{ route('products.show', $product->id) }}" class="btn btn-secondary">戻る</a>
  </form>
</div>
@endsection