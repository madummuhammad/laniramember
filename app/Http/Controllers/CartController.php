<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductSize;
use App\Models\Expedisi;
use Validator;
use Auth;

class CartController extends Controller
{
    public function po()
    {
        $member_id=Auth::user()->id;
        $data['type_product']='PO';
        $data['cart']=Cart::where('type_product','PO')->where('member_id',$member_id)->with('product_size.product')->get();
        if($data['cart']->count()==0){
            return redirect('/')->with('error','Keranjang kosong ready stok, yuk belanja!');
        }
        return view('customer.cart',$data);
    }

    public function ready_stock()
    {
        $member_id=Auth::user()->id;
        $data['type_product']='Ready Stok';
        $data['cart']=Cart::where('type_product','Ready Stok')->where('member_id',$member_id)->with('product_size.product')->get();
        if($data['cart']->count()==0){
            return redirect('/')->with('error','Keranjang kosong ready stok, yuk belanja!');
        }
        return view('customer.cart',$data);
    }

    public function order(Request $request)
    {
        $type_product=$request->type_product;

        if($type_product=='Ready Stok'){
            $order_id=$this->checkout_ready_stock($request);
        } else {
            $order_id=$this->checkout_po($request);
        }
        return redirect('order/'.$order_id);

        // return $order_id;
    }

    public function checkout_po($request)
    {
        $email=$request->email;
        $name=$request->name;
        $telepon=$request->telepon;
        $type_product=$request->type_product;
        $cart_id=$request->cart_id;
        $note=$request->note;
        if($request->phone_dropship){
            $phone_dropship=$request->phone_dropship;
        } else {
            $phone_dropship=NULL;
        }

        if($request->sender_dropship){
            $sender_dropship=$request->sender_dropship;
        } else {
            $sender_dropship=NULL;
        }

        $berat=0; 
        $sub_total=0;
        $total=0;
        for ($i=0; $i < count($cart_id); $i++) { 
            $product=Cart::where('id',$cart_id[$i])->first();
            $berat=$berat+$product->product_size->product->berat;
            $sub_total=$sub_total+$product->final_price*$product->qty;
        }

        $total=$sub_total;
        $orderData=[
            'order_time'=>date('Y-m-d'),
            'order_status'=>'order',
            'confirm_payment'=>'Not Uploaded',
            'member_id'=>Auth::user()->id,
            'order_email'=>$email,
            'nama_penerima'=>$name,
            'order_tel'=>Auth::user()->no_wa,
            'phone'=>$telepon,
            'catatan'=>$note,
            'total'=>$total,
            'tipe'=>"",
            'phone_dropship'=>$phone_dropship,
            'sender_dropship'=>$sender_dropship,
            'order_type'=>$type_product
        ];

        $order_id=Order::create($orderData);

        for ($i=0; $i < count($cart_id); $i++) { 
            $product=Cart::where('id',$cart_id[$i])->with('product_size.product')->first();
            OrderItem::create([
                'order_id'=>$order_id->id,
                'product_id'=>$product->product_size->product->id,
                'product_name'=>$product->product_size->product->name,
                'qty'=>$product->qty,
                'price'=>$product->final_price,
                'order_type'=>$type_product,
                'size_id'=>$product->product_size->id,
                'ct_status'=>'order'
            ]);

            Cart::where('id',$cart_id[$i])->delete();
        }

        return $order_id->id;
    }

    public function checkout_ready_stock($request)
    {
        $email=$request->email;
        $name=$request->name;
        $address=$request->address;
        $note=$request->note;
        $telepon=$request->telepon;
        $province=explode('|', $request->province)[1];
        $city=explode('|', $request->city)[1];
        $district=$request->district;
        $expedisi=$request->expedisi;
        $paket=explode('|', request('paket'));
        $cart_id=$request->cart_id;
        // $berat=$request->berat;
        $type_product=$request->type_product;

        if($request->phone_dropship){
            $phone_dropship=$request->phone_dropship;
        } else {
            $phone_dropship=NULL;
        }

        if($request->sender_dropship){
            $sender_dropship=$request->sender_dropship;
        } else {
            $sender_dropship=NULL;
        }


        $berat=0; 
        $sub_total=0;
        $total=0;
        for ($i=0; $i < count($cart_id); $i++) { 
            $product=Cart::where('id',$cart_id[$i])->first();
            $berat=$berat+$product->product_size->product->berat;
            $sub_total=$sub_total+$product->final_price*$product->qty;
        }

        $total=$sub_total;
        // $total=$sub_total+$paket[1];

        $orderData=[
            'order_time'=>date('Y-m-d'),
            'order_status'=>'order',
            'confirm_payment'=>'Not Uploaded',
            'member_id'=>Auth::user()->id,
            'order_email'=>$email,
            'nama_penerima'=>$name,
            'order_tel'=>Auth::user()->no_wa,
            'phone'=>$telepon,
            'address'=>$address,
            'catatan'=>$note,
            'provinsi'=>$province,
            'distrik'=>$city,
            'tipe'=>'Kabupaten',
            'ekspedisi'=>$expedisi,
            'paket'=>$paket[0],
            'estimasi'=>$paket[2].' hari',
            'ongkir'=>$paket[1],
            'berat'=>$berat,
            'voucher'=>NULL,
            'resi'=>NULL,
            'total'=>$total,
            'phone_dropship'=>$phone_dropship,
            'sender_dropship'=>$sender_dropship,
            'order_type'=>$type_product
        ];

        $order_id=Order::create($orderData);


        for ($i=0; $i < count($cart_id); $i++) { 
            $product=Cart::where('id',$cart_id[$i])->with('product_size.product')->first();
            OrderItem::create([
                'order_id'=>$order_id->id,
                'product_id'=>$product->product_size->product->id,
                'product_name'=>$product->product_size->product->name,
                'qty'=>$product->qty,
                'price'=>$product->final_price,
                'order_type'=>$type_product,
                'size_id'=>$product->product_size->id,
                'ct_status'=>'order'
            ]);

            Cart::where('id',$cart_id[$i])->delete();
        }

        return $order_id->id;
    }

    public function delete()
    {
        $id=request('id');
        Cart::where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil menghapus keranjang');
    }

    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => 'required',
            'qty' => 'required|numeric|min:1',
            'size'=>'required',
            'price' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error','Gagal menambahkan keranjang');
        }

        $ProductSize=ProductSize::where('id',request('size'))->first();
        $product=Product::where('id',request('product_id'))->first();

        if($product->type_product=='Ready Stok'){            
            if($ProductSize->stok<=0){
                return redirect()->back()->with('error','Stok produk sama dengan '.$ProductSize->stok);
            }
        }
        $discount=$product->diskon_produk;
        $memberId = auth()->user()->id; 
        $productSizeId = $request->input('size');
        $qty = $request->input('qty');
        $price = $ProductSize->price;
        $finalPrice = ($ProductSize->price-($ProductSize->price*$discount/100));
        $createdAt = now();
        $updatedAt = now();

        $cart = new Cart();
        $cart->member_id = $memberId;
        $cart->product_size_id = $productSizeId;
        $cart->qty = $qty;
        $cart->price = $price;
        $cart->type_product=$product->type_product;
        $cart->discount = $discount;
        $cart->final_price = $finalPrice;
        $cart->created_at = $createdAt;
        $cart->updated_at = $updatedAt;
        $cart->save();
        if($product->type_product=='Ready Stok'){ 
            $stok=$ProductSize->stok-$qty;
            ProductSize::where('id',$productSizeId)->update(['stok'=>$stok]);
        }
        return redirect()->back()->with('success','Berhasil menambahkan keranjang');
    }

    public function checkout()
    {
        $member_id=Auth::user()->id;
        $type_product=request('type_product');
        $cart=Cart::where('type_product',$type_product)->where('member_id',$member_id)->with('product_size.product')->get();
        return redirect('cart/checkout')->with('cart',$cart)->with('type_product',$type_product);
    }

    public function checkout_View()
    {
        if(session('cart')){
            $member_id=Auth::user()->id;
            $data['member']=Auth::user();
            $data['expedisi']=Expedisi::where('status',1)->get();
            $data['type_product']=session('type_product');
            $data['cart']=session('cart');
            return view('customer.checkout',$data);
        } else {
            return redirect('/');
            // return back();
        }
    }
}
