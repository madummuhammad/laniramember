<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Slider;
class BrandController extends Controller
{
    public function ready_stock()
    {
        $data['slider']=Slider::get();
        $data['brand']=Brand::get();
        $data['type_product']='ready_stock';
        return view('customer.brand',$data);
    }

    public function po()
    {
        $data['slider']=Slider::get();
        $data['brand']=Brand::get();
        $data['type_product']='po';
        return view('customer.brand',$data);
    }
}
