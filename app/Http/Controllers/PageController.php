<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
class PageController extends Controller
{
    public function home(){
        $dsSP = Product::limit(8)->get();
        return view('index', compact(['dsSP']));
    }
}
