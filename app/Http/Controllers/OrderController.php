<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\ConfirmPayment;
use Auth;
use Illuminate\Support\Facades\File;

class OrderController extends Controller
{
    public function index()
    {
        $member_id=Auth::user()->id;
        $data['order']=Order::where('member_id',$member_id)->get();
        return view('customer.order',$data);
    }

    public function detail($id)
    {
        $data['order']=Order::where('id',$id)->with('member','order_item.product','order_item.product_size','payment_confirm')->first();
        return view('customer.order_detail',$data);
    }

    public function confirm($id)
    {
        $data['id']=$id;
        $data['order']=Order::where('id',$id)->first();
        $data['payment_confirm']=ConfirmPayment::where('order_id',$id)->get();
        $deposit=0;
        foreach ($data['payment_confirm'] as $key => $value) {
            $deposit=$deposit+$value->deposit;
        }
        $data['sisa_pembayaran']=$data['order']->total+$data['order']->ongkir-$deposit;

        if($data['order']->order_type=='Ready Stok'){
            $confirm_payment=ConfirmPayment::where('order_id',$id)->count();
            if($confirm_payment>0){
                return back()->with('error','Konfirmasi sudah dilakukan');
            }
        } else {
            if($data['sisa_pembayaran']<=0){
                return back()->with('error','Konfirmasi sudah dilakukan');
            }
        }
        return view('customer.confirm',$data);
    }

    public function confirm_proses(Request $request)
    {
        $order_id=$request->order_id;
        $name=$request->name;
        $bank=$request->bank;
        $deposit=$request->deposit;
        $jumlah=$request->jumlah;
        $sisa=$request->sisa;
        $bukti = $request->file('bukti');

        if ($bukti) {
            $filename = time() . '.' . $bukti->getClientOriginalExtension();
            $bukti->move(public_path('image/bukti'), $filename);
        } else {
            $filename = 'default.png';
        }
        $data=[
            'order_id'=>$order_id,
            'nama'=>$name,
            'bank'=>$bank,
            'deposit'=>$deposit,
            'jumlah'=>$jumlah,
            'tanggal'=>date('Y-m-d'),
            'bukti'=>$filename
        ];

        ConfirmPayment::create($data);
        Order::where('id',$order_id)->update(['confirm_payment'=>'On Checking']);
        return redirect('order/'.$order_id)->with('success','Terimakasih telah melakukan konfirmasi');;
    }
}
