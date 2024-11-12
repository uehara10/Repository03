<?php
/*
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::resource('products', ProductController::class);


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| 認証関連のルーティング
|--------------------------------------------------------------------------
*/

// 初期ページ表示、ログイン画面
Route::get('/', function () {
    return view('welcome');
});

// 認証ルート (ログイン、新規登録、パスワードリセット関連)
Auth::routes();

// 認証成功後のリダイレクト先（商品一覧画面）
Route::get('/home', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| 商品管理関連のルーティング
|--------------------------------------------------------------------------
*/

// 商品一覧画面
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// 商品検索（一覧画面と同一ルート、検索条件あり）
Route::get('/products/search', [ProductController::class, 'index'])->name('products.search');

// 商品新規登録画面
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');

// 商品新規登録処理
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 商品詳細画面
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

// 商品編集画面
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');

// 商品編集処理
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');

// 商品削除処理
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

/*
|--------------------------------------------------------------------------
| 画面遷移のリダイレクト設定
|--------------------------------------------------------------------------
*/

// 新規登録後、ログイン画面にリダイレクト
Route::get('/register/complete', function () {
    return redirect()->route('login');
});

// 商品登録後、商品一覧画面にリダイレクト
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// 戻るボタンで商品一覧画面へ遷移
Route::get('/products/back', function () {
    return redirect()->route('products.index');
});
