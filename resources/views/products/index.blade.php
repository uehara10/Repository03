@extends('layouts.app')

@section('content')
<div class="container">
  <h1>商品一覧</h1>

  @if (session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif

  <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">商品登録</a>

  <form method="GET" action="{{ route('products.index') }}" class="mb-3">
    <div class="row">
      <div class="col-md-4">
        <label for="product_name">商品名</label>
        <input type="text" name="product_name" class="form-control" value="{{ request('product_name') }}">
      </div>
      <div class="col-md-4">
        <label for="company_id">企業名</label>
        <select name="company_id" class="form-control">
          <option value="">全て</option>
          @foreach($companies as $company)
          <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
            {{ $company->company_name }}
          </option>
          @endforeach
        </select>
      </div>
      <div class="col-md-4 align-self-end">
        <button type="submit" class="btn btn-primary">検索</button>
      </div>
    </div>
  </form>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>商品名</th>
        <th>企業名</th>
        <th>価格</th>
        <th>在庫</th>
        <th>コメント</th>
        <th>画像</th>
        <th>作成日</th>
        <th>更新日</th>
        <th>詳細</th>
        <th>削除</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($products as $product)
      <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->product_name }}</td>
        <td>{{ $product->company->company_name ?? '未登録' }}</td>
        <td>{{ $product->price }}</td>
        <td>{{ $product->stock }}</td>
        <td>{{ $product->comment }}</td>
        <td>
          @if ($product->img_path)
          <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" class="product-image">
          @else
          <p>画像なし</p>
          @endif
        </td>

        <td>{{ $product->created_at }}</td>
        <td>{{ $product->updated_at }}</td>

        <td>
          <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">詳細</a>
        </td>

        <td>
          <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">削除</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection