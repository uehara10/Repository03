@extends('layouts.app')

@section('content')
<div class="container">
  <h1>商品詳細</h1>
  <div class="card">
    <div class="card-body">
      <h5>商品名: {{ $product->product_name }}</h5>
      <p>企業名: {{ $product->company->company_name ?? '未登録' }}</p>
      <p>価格: ¥{{ $product->price }}</p>
      <p>在庫数: {{ $product->stock }}</p>
      <p>コメント: {{ $product->comment }}</p>
      @if ($product->img_path)
      <p><img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="product-image-large"></p>
      @else
      <p>画像なし</p>
      @endif
      <div class="mt-3">
        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">編集</a>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">戻る</a>
      </div>
    </div>
  </div>
</div>
@endsection