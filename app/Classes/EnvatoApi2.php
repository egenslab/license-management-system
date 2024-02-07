<?php

namespace App\Classes;

use App\Models\License;
use App\Models\PurchaseCode;

class EnvatoApi2
{

    private static $bearer = "LojeZExJdIdNyTdPP8XGo5gMcNcwqCxb"; // replace the API key here.


    public static function getPurchaseData($purchase_code)
    {

        $bearer   = 'bearer ' . self::$bearer;
        $header   = array();
        $header[] = 'Content-length: 0';
        $header[] = 'Content-type: application/json; charset=utf-8';
        $header[] = 'Authorization: ' . $bearer;

        $verify_url = 'https://api.envato.com/v3/market/author/sale/';
        $ch_verify = curl_init($verify_url . '?code=' . $purchase_code);

        curl_setopt($ch_verify, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch_verify, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch_verify, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch_verify, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');

        $cinit_verify_data = curl_exec($ch_verify);
        curl_close($ch_verify);
        if ($cinit_verify_data != "")
            return json_decode($cinit_verify_data);
        else
            return false;
    }



   public static function marketplacePurchaseCode($purchase_code){

         if($purchase_code=  PurchaseCode::where("purchase_code", $purchase_code)->first()){
             return $purchase_code;
         } elseif (License::where('license_key', $purchase_code)->first()) {
            return true;
        }
         else{
            return false;
         }

   }





   public static function verifyPurchase($purchase_code, $marketplace_name=null)
    {

        if(strtolower($marketplace_name)=='envato'){
            $verify_obj = self::getPurchaseData($purchase_code);
            if ((false === $verify_obj) || !is_object($verify_obj) || isset($verify_obj->error) || !isset($verify_obj->sold_at))
                return  false;

            if ($verify_obj->supported_until == "" || $verify_obj->supported_until != null)
                return $verify_obj;

        }else{

           return self::marketplacePurchaseCode($purchase_code);
        }
        


        return 0;
    }

















}
