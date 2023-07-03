<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RajaongkirController extends Controller
{
    public function province()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 6a4b80b2e7d0648117dbd6f60cfd1ade"
        ),
      ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return response()->json(json_decode($response));
    }
    public function city()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/city?province=".request('province_id'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 6a4b80b2e7d0648117dbd6f60cfd1ade"
        ),
      ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return response()->json(json_decode($response));
    }

    public function kecamatan()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".request('city_id'),
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 6a4b80b2e7d0648117dbd6f60cfd1ade"
        ),
      ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return response()->json(json_decode($response));
    }

    public function expedisi()
    {
        $ekspedisi = request('expedisi');
        $subdistrict = request('subdistrict');
        $berat = request('berat');
        $berat = ceil($berat);
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=409&originType=city&destination=$subdistrict&destinationType=subdistrict&weight=$berat&courier=$ekspedisi",
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: 6a4b80b2e7d0648117dbd6f60cfd1ade"
        ),
      ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        return response()->json(json_decode($response));
    }
}
