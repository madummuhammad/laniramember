<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Slider;
class ProductController extends Controller
{
    public function product_detail($id)
    {
        $data['product']=Product::where('id',$id)->where('status','Publish')->with('product_size')->first();
        return view('customer.productdetail',$data);
    }

    public function list_ready_stock($brand_id)
    {
        $keyword=request('keyword');
        $data['slider'] = Slider::get();
        $query=Product::where('brand_id', $brand_id)
        ->where('status', 'Publish')
        ->where('type_product', 'Ready Stok');
        
        if($keyword){
            $product=$query->where('name','LIKE','%'.$keyword.'%');
            $data['keyword']=$keyword;
        } else {
            $data['keyword']="";
            $product=$query;
        }

        $data['product']=$product->paginate(12);

        $currentPage = $data['product']->currentPage();
        $lastPage = $data['product']->lastPage();
        $previousPageUrl = $data['product']->previousPageUrl();
        $nextPageUrl = $data['product']->nextPageUrl();

        $data['pagination'] = [
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'previousPageUrl' => $previousPageUrl,
            'nextPageUrl' => $nextPageUrl,
        ];

        $data['pageUrls'] = [];

        $startPage = max(1, $currentPage - 2);
        $endPage = min($startPage + 4, $lastPage);

        for ($i = $startPage; $i <= $endPage; $i++) {
            $data['pageUrls'][$i] = $data['product']->url($i);
        }
        return view('customer.product', $data);
    }


    public function list_po($brand_id)
    {
        $keyword=request('keyword');
        $data['slider'] = Slider::get();
        $query=Product::where('brand_id', $brand_id)
        ->where('status', 'Publish')
        ->where('type_product', 'PO');

        if($keyword){
            $product=$query->where('name','LIKE','%'.$keyword.'%');
            $data['keyword']=$keyword;
        } else {
            $data['keyword']="";
            $product=$query;
        }

        $data['product']=$product->paginate(12);

        $currentPage = $data['product']->currentPage();
        $lastPage = $data['product']->lastPage();
        $previousPageUrl = $data['product']->previousPageUrl();
        $nextPageUrl = $data['product']->nextPageUrl();

        $data['pagination'] = [
            'currentPage' => $currentPage,
            'lastPage' => $lastPage,
            'previousPageUrl' => $previousPageUrl,
            'nextPageUrl' => $nextPageUrl,
        ];

        $data['pageUrls'] = [];

        $startPage = max(1, $currentPage - 2);
        $endPage = min($startPage + 4, $lastPage);

        for ($i = $startPage; $i <= $endPage; $i++) {
            $data['pageUrls'][$i] = $data['product']->url($i);
        }

        return view('customer.product', $data);
    }
}
