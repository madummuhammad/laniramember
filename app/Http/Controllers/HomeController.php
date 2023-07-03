<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Product;
class HomeController extends Controller
{
    public function index()
    {
        $data['slider']=Slider::get();
        $data['ready_stock']=Product::where('type_product','Ready Stok')->where('status','Publish')->limit(8)->orderBy('created_at','DESC')->get();
        $data['po']=Product::where('type_product','PO')->where('status','Publish')->limit(8)->orderBy('created_at','DESC')->get();
        return view('customer.home',$data);
    }
}
