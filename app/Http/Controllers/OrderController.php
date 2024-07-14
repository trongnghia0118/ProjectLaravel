<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function follow($id){
        $dsdh = Order::where('user_id','=', $id)->paginate(10);
        return view('followorder', compact('dsdh'));
    }
}
