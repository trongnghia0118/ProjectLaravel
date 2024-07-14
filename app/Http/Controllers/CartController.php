<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function cart(){
        return view('cart');
    }
    public function checkout(Request $request){
         $order = new Order();
         $order->user_id = (Auth::check())?Auth::user()->id:null;
         $order->user_fullname = $request->fullname;
         $order->user_phone = $request->phone;
         $order->user_address = $request->address;
         $order->user_email = $request->email;
         $order->total_money = 0 ;
         $order->total_quantity = 0 ;
         $order->save();

         foreach(session('cart') as $sp){
            $order_detail = new OrderDetail();
            $order_detail->order_id = $order->id;
            $order_detail->product_id = $sp->id;
            $order_detail->quantity = $sp->quantity;
            $order_detail->price = is_null($sp->sale_price) ? $sp->price : $sp->sale_price;
            $order_detail->save();
            $order->total_money += $order_detail->quantity * $order_detail->price;
            $order->total_quantity += $order_detail->quantity;
         }
         $order->save();
         session()->forget('cart'); 
         return redirect()->route('home');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if( is_null(session('cart'))){
            session()->put('cart',[]);
        }
        $inCart = false;
        foreach(session('cart') as $sp){
            if( $sp->id == $request->product_id){
                $sp->quantity += $request->quantity;
                $inCart = true;
                break;
            }
        }
        if(!$inCart){
           $sp = Product::find($request->product_id);
           $sp->quantity = $request->quantity;
           session()->push('cart', $sp);
        }
        $kq = [
            "status"=>true,
            "message"=>"Đã Thêm Sản Phẩm Vào Giỏ Hàng",
            "data"=>session('cart'),
        ];
        return response()->json($kq,200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        foreach(session('cart') as $sp){
            if($sp->id == $id){
                $sp->quantity = $request->quantity;
                break;
            }
        }
        $kq = [
            "status"=>true,
            "message"=>"Đã Cập Nhật Sản Phẩm Vào Giỏ Hàng",
            "data"=>session('cart'),
        ];
        return response()->json($kq,200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $cart = session('cart');
       session()->forget('cart');
       array_splice($cart, $id,1);
       session()->put('cart', $cart);
        $kq = [
            "status"=>true,
            "message"=>"Đã Xóa Sản Phẩm Vào Giỏ Hàng",
            "data"=>session('cart'),
        ];
        return response()->json($kq,200);
    }
}
