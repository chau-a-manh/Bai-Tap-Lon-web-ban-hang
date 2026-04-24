<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // 1. Cập nhật hàm index (Thêm chức năng lọc danh mục)
    public function index(Request $request)
    {
        $categories = Category::all(); // Lấy danh mục để làm bộ lọc
        $query = Product::with('category');

        // Nếu admin có chọn bộ lọc thì áp dụng
        if ($request->category_id) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->orderBy('id', 'desc')->get();
        return view('admin.products.index', compact('products', 'categories'));
    }

    // 2. Hàm hiển thị form Sửa
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 3. Hàm xử lý Cập nhật dữ liệu
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        // Nếu có up ảnh mới thì thay ảnh cũ
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/products');
            $file->move($destinationPath, $filename);
            $product->image = $filename;
        }

        $product->save();
        return redirect()->route('admin.products.index')->with('success', 'Cập nhật thành công!');
    }

    // 4. Hàm xử lý Xóa
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Đã xóa sản phẩm!');
    }

    // Hàm hiển thị Form thêm mới sản phẩm
    public function create()
    {
        $categories = Category::all(); // Lấy danh sách danh mục để đổ vào thẻ <select>
        return view('admin.products.create', compact('categories'));
    }

    // Hàm xử lý lưu sản phẩm vào Database
    public function store(Request $request)
    {
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;

        // Xử lý upload ảnh
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();

            // 1. Khai báo đường dẫn thư mục lưu ảnh
            $destinationPath = public_path('uploads/products');

            // 2. Kiểm tra nếu thư mục chưa tồn tại thì tự động tạo mới!
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // 3. Di chuyển ảnh vào thư mục vừa tạo
            $file->move($destinationPath, $filename);
            $product->image = $filename;
        }

        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Thêm sản phẩm thành công!');
    }
}
