<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Slug;

class ProductController extends Controller
{
    public function home(){
        try {
            $users = Product::all();
            return response()->json([
            'status' => 'success',
            'message' => 'Dữ liệu được lấy thành công',
            'data' => $users,
            ], 200);
            } catch (\Exception $e) {
            return response()->json([
            'status' => 'fail',
            'message' => $e->getMessage(),
            'data' => null,
            ], 500);
            }
    }
    public function detail($slug){
        $sp = Product::where('slug', $slug)->first();
        return view('chitiet', compact(['sp']));
       }
       public function index()
       {
       }
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
            ]);
    
            $product = Product::create([
                'name' => 'Product Name',
                'description' => 'Product Description',
                'price' => 99.99,
                'slug' => 'product-name',
                'instock' => 1,
                'category_id' => 1 // ID của danh mục sản phẩm
            ]);
    
            return response()->json([
                'message' => 'Product created successfully!',
                'product' => $product
            ], 201);
        }
    
    

        public function show($id)
        {
            $product = Product::findOrFail($id);
            return response()->json($product);
        }
        /* {
            "name": "Product Name",
            "description": "Product Description",
            "price": 99.99
        } */
    public function update(Request $request, $id)
    {
            // Xác thực yêu cầu
            $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'nullable|string',
                // Add more validation rules as needed
            ]);
    
            // Tìm sản phẩm theo ID
            $product = Product::find($id);
    
            // Kiểm tra nếu sản phẩm không tồn tại
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }
    
            // Cập nhật thông tin sản phẩm
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->description = $request->input('description', $product->description); // giữ lại giá trị cũ nếu không được cung cấp
            // Cập nhật các thuộc tính khác nếu cần
    
            $product->save();
    
            // Trả về phản hồi thành công
            return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
    }

        public function destroy($id)
        {
            $product = Product::find($id);
    
            if (!$product) {
                return response()->json(['message' => 'Product not found'], 404);
            }
    
            $product->delete();
    
            return response()->json(['message' => 'Product deleted successfully'], 200);
        }
}