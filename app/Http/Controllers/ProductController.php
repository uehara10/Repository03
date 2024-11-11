<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('product_name')) {
            $query->where('product_name', 'like', '%' . $request->product_name . '%');
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $products = $query->get();
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'company_id' => 'required|integer',
            'product_name' => 'required|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $imagePath = null;
            if ($request->hasFile('img_path')) {
                $imagePath = $request->file('img_path')->store('images', 'public');
            }
            Product::create([
                'company_id' => $request->company_id,
                'product_name' => $request->product_name,
                'price' => $request->price,
                'stock' => $request->stock,
                'comment' => $request->comment,
                'img_path' => $imagePath,
            ]);

            return redirect()->route('products.index')->with('success', '商品を登録しました');
        } catch (\Exception $e) {
            Log::error('商品登録に失敗しました: ' . $e->getMessage());
            return back()->withErrors('商品登録に失敗しました。');
        }
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    public function update(Request $request, $id)
    {
        // バリデーション
        $request->validate([
            'company_id' => 'required|integer',
            'product_name' => 'required|string',
            'price' => 'required|numeric|min:1',
            'stock' => 'required|integer|min:0',
            'comment' => 'nullable|string',
            'img_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $product = Product::findOrFail($id);

            if ($request->hasFile('img_path')) {
                if ($product->img_path) {
                    Storage::delete('public/' . $product->img_path);
                }
                $product->img_path = $request->file('img_path')->store('images', 'public');
            }

            $product->update([
                'company_id' => $request->company_id,
                'product_name' => $request->product_name,
                'price' => $request->price,
                'stock' => $request->stock,
                'comment' => $request->comment,
                'img_path' => $product->img_path,
            ]);

            return redirect()->route('products.index')->with('success', '商品情報を更新しました');
        } catch (\Exception $e) {
            Log::error('商品更新に失敗しました: ' . $e->getMessage());
            return back()->withErrors('商品更新に失敗しました。');
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->route('products.index')->with('success', '商品を削除しました');
        } catch (\Exception $e) {
            Log::error('商品削除に失敗しました: ' . $e->getMessage());
            return redirect()->route('products.index')->withErrors('商品削除に失敗しました。');
        }
    }
}
