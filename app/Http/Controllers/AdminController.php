<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\User;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        $soDonHang = Order::count();
        $soSanPham = Product::count();
        $soKhachHang = User::where('role','user')->count();
        $doanhThu = Order::where('status','success')->sum('total_money');
        $dsDH = Order::orderby('created_at','DESC')->limit(5)->get();
        $dsBL = Comment::orderby('created_at','DESC')->limit(5)->get();
        
        $tkDoanhThu = Order::where('status','success')->groupByRaw('YEAR(created_at), MONTH(created_at)')->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(total_money) as total')->get();
        return view('admin',compact(['soDonHang','soSanPham','soKhachHang','doanhThu','dsDH','dsBL','tkDoanhThu']));
    }
    public function product(){
        $dsSP = Product::where('category_id', '!=', 3)->paginate(10);
        $soSanPham = Product::count();
        $soSapHet = Product::where('instock', '<=', 20)->count();
        $SoDanhMuc = Product::count();
        $trash = Product::where('category_id','3')->count();
        return view('admin_product', compact(['dsSP','soSanPham','soSapHet','SoDanhMuc','trash']));
    
     }
    public function productAdd(){
        $dsDM = Category::get();
        return view('admin_product_add',compact('dsDM'));
     }
     public function postProductAdd(Request $request){
        $product = new Product();
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->instock = $request->instock;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->image = '';
        $product->save();

        if($request->hasFile('image')){
           $img = $request->file('image');
           $imgName = "{$product->id}.{$img->getClientOriginalExtension()}";
           $img->move(public_path('img/products/'),$imgName);
           $product->image = $imgName;
           $product->save();
        }
        if($request->hasFile('images')){
            $imgList = $request->file('images');
            foreach ($imgList as $key => $img) {
                $imgName = "{$product->id}.{$key}.{$img->getClientOriginalExtension()}";
           $img->move(public_path('img/products/'),$imgName);
           $productImage = new ProductImage();
           $productImage->image = $imgName;
           $productImage->product_id = $product->id;
           $productImage->save();
            }
        }

     }
     public function deleteProduct($id){
        $delete = Product::find($id);
        $delete->category_id = 3;
        $delete->save();
        return back();
     }
     public function updateproduct($id){
        $SP = Product::where('id','=',$id)->first();
        $dsDM = Category::get();
        return view('admin_product_edit',compact('dsDM','SP'));
     }
     public function postupdateproduct(Request $request, $id){
        $product = Product::find($id);
        if ($product) {
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->instock = $request->instock;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->sale_price = $request->sale_price;
        $product->image = '';
        $product->save();
            
        }

        if($request->hasFile('image')){
           $img = $request->file('image');
           $imgName = "{$product->id}.{$img->getClientOriginalExtension()}";
           $img->move(public_path('img/products/'),$imgName);
           $product->image = $imgName;
           $product->save();
        }else{
            $product->image = $request->imgdefault;
            $product->save();
        }
        

     }
     public function order()
{
    $dssc = Order::where('status', 'success')->count();
    $dsod = Order::where('status', 'pending')->count();
    $dssh = Order::where('status', 'shipping')->count();
    $dsca = Order::where('status', 'cancle')->count();
    $dsdh = Order::paginate(10); // Sử dụng all() thay cho get() nếu muốn lấy tất cả bản ghi

    return view('admin_order', compact('dssc', 'dsod', 'dssh', 'dsca', 'dsdh'));
}
 public function vieworder($id){
   $donhang = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
                      ->join('products', 'order_details.product_id', '=', 'products.id')
                      ->where('order_id', '=', $id)
                      ->first();
                      $donhang2 = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
                      ->join('products', 'order_details.product_id', '=', 'products.id')
                      ->where('order_id', '=', $id)
                      ->get();
   return view ('admin_orderview',compact('donhang','donhang2'));
 }
 public function updateorder($id){
   $donhang = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
                      ->join('products', 'order_details.product_id', '=', 'products.id')
                      ->where('order_id', '=', $id)
                      ->first();
                      $donhang2 = OrderDetail::join('orders', 'order_details.order_id', '=', 'orders.id')
                      ->join('products', 'order_details.product_id', '=', 'products.id')
                      ->where('order_id', '=', $id)
                      ->get();
   return view ('admin_orderupdate',compact('donhang','donhang2'));
 }
 public function postupdateorder(Request $request, $id){
   $Order = Order::find($id);
    if ($Order) {
                      $Order->status = $request->status;
                      $Order->save();
                      Session::flash('success_message', 'Cập nhật trạng thái đơn hàng thành công!');

                      // Chuyển hướng người dùng đến trang khác
                      return redirect()->route('admin.order');
 }
 }
}