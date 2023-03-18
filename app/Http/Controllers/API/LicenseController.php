<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\License;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LicenseController extends Controller
{
    public $successStatus = 200;

    public $userId;
    protected $api_token = '';
    protected $client;
    protected $base_url;
    protected $client_id;
    protected $client_secret;

    public function __construct() {
        $this->userId = 1;
        $this->client_id ='eg_notifications_license-bllcb4o2';
        $this->client_secret ='OB4bxqgxw90M0eKsG52v7n7F4LtUtnYM';
        $this->base_url ='https://api.envato.com';
    }

    //Save Installations Plugin Informations
    public function installPlugin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'ip_details' => 'required',
            'website_url' => 'required',
            'email' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input = $request->all();
        $result=License::where(['website_url'=>$input['website_url']])->first();
        if ($result){
            $updateModel                          = License::find($result->id);
            $updateModel->name                    =!empty($input['name'])?$input['name']:$updateModel->name;
            $updateModel->ip_details              =!empty($input['ip_details'])?$input['ip_details']:$updateModel->ip_details;
            $updateModel->website_url             =!empty($input['website_url'])?$input['website_url']:$updateModel->website_url;
            $updateModel->email                   =!empty($input['email'])?$input['email']:$updateModel->email;
            $updateModel->username                =isset($input['username'])?$input['username']:$updateModel->username;
            $updateModel->image                   =isset($input['image'])?$input['image']:$updateModel->image;
            $updateModel->user_type               =isset($input['user_type'])?$input['user_type']:$updateModel->user_type;
            $updateModel->plugin_activated_status =isset($input['plugin_activated_status'])?$input['plugin_activated_status']:'';
            $updateModel->plugin_version           =isset($input['plugin_version'])?$input['plugin_version']:'';
            $updateModel->json                     =json_encode($input);
            $updateModel->user_id                  =$this->userId;

            if ($updateModel->update()) {
                $success['status'] = 200;
                $success['name'] = $updateModel->website_url;
                return response()->json(['success' => $success], $this->successStatus);
            } else {
                return response()->json(['error' => 'Internal Server Error----'], 500);
            }

        }else{
          $model=new License();
          $model->name                      =$input['name'];
          $model->ip_details                =$input['ip_details'];
          $model->website_url               =$input['website_url'];
          $model->email                     =$input['email'];
          $model->username                  =isset($input['username'])?$input['username']:'';
          $model->image                     =isset($input['image'])?$input['image']:'';
          $model->user_type                 =isset($input['user_type'])?$input['user_type']:'';
          $model->plugin_activated_status   =isset($input['plugin_activated_status'])?$input['plugin_activated_status']:'';
          $model->plugin_version            =isset($input['plugin_version'])?$input['plugin_version']:'';
          $model->user_id                   =$this->userId;
          $model->json     =json_encode($input);


            if ($model->save()) {
                $success['name'] = $model->website_url;
                return response()->json(['success' => $success], $this->successStatus);
            } else {
                return response()->json(['error' => 'Internal Server Error----'], 500);
            }

        }
    }

    //Store License Key
    public function setupLicense(Request $request){
        $validator = Validator::make($request->all(), [
            'license_key' => 'required',
            'ip_details' => 'required',
            'website_url' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input          = $request->all();
        $result         =License::where(['license_key'=>$input['license_key']])->first();
        $trackInstall   =License::where(['website_url'=>$input['website_url']])->first();

        if ($result){
            $error['status']='used';
            $error['message']='this license key already used.Please removed from this website';
            $error['website']=$input['website_url'];
            return response()->json(['success' => $error], 500);
        }else{
            //FIrst Envato Validations
            $userInformations         =Admin::where(['id'=>$this->userId])->first();
            if ($userInformations){
                $getEnvatoLicenseKeyStatus=self::validateEnvatoLicense($userInformations,$input['license_key']);
                if (isset($getEnvatoLicenseKeyStatus->response_code)){
                    $error['status']='invalid';
                    $error['message']='Invalid License key';
                    $error['website']=$input['website_url'];
                    return response()->json(['success' => $error], 500);
                }else{
                    //update License
                    $updateModel                          = License::find($trackInstall->id);
                    $updateModel->license_key             =$input['license_key'];
                    $updateModel->status =1;

                    if ($updateModel->update()) {
                        $success['status'] = 200;
                        $success['name'] = $updateModel->website_url;
                        return response()->json(['success' => $success], $this->successStatus);
                    } else {
                        return response()->json(['error' => 'Internal Server Error----'], 500);
                    }
                }
            }else{
                return response()->json(['error' => 'Internal Server Error----'], 500);
            }
        }
    }

    //Delete License Key
    public function removedLicenseKey(Request $request){
        $validator = Validator::make($request->all(), [
            'license_key' => 'required',
            'ip_details' => 'required',
            'website_url' =>'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }

        $input          = $request->all();
        $result         =License::where(['license_key'=>$input['license_key']])->first();
        if ($result){
            $deleteModel= License::find($result->id);
            $deleteModel->status=0;
            $deleteModel->license_key='';
            if ($deleteModel->save()){
                $success['status'] ='delete';
                return response()->json(['success' => $success], $this->successStatus);
            }
        }
    }


    public  function validateEnvatoLicense($userModel,$licenseCode){

        $refreshToken              =$userModel->envato_refresh_token;
        $clientId                   =$this->client_id;
        $clientSecret              =$this->client_secret;

        //Revoke Access Token
        $responseAccessToken       =$this->getRefreshToken($refreshToken);
        $responseAccessToken       =json_decode($responseAccessToken);
        $accessToken               =$responseAccessToken->access_token;
        $this->api_token=$accessToken;

        $getAuthorSellDetails       =self::getAuthorSale($licenseCode);

        return $getAuthorSellDetails;
    }


    public function getAuthorSale ($code) {
        $query = ['code' => $code];
        return $this->GET($this->base_url.'/v3/market/author/sale',  $query);
    }

    public function getRefreshToken($refreshToken){
        $dataArray   = [
            "grant_type" => "refresh_token",
            "refresh_token" =>$refreshToken,
            "client_id" =>$this->client_id,
            "client_secret" =>$this->client_secret,
        ];

        return $this->POST($this->base_url.'/token',$dataArray);
    }


    public function POST($url, $data)
    {
        $data = http_build_query($data);
        $headers = ["User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_14_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/79.0.3945.117 Safari/537.36"];

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true, // return the transfer as a string of the return value
            CURLOPT_TIMEOUT => 0,   // The maximum number of seconds to allow cURL functions to execute.
            CURLOPT_POST => true,   // This line must place before CURLOPT_POSTFIELDS
            CURLOPT_POSTFIELDS => $data // Data that will send
        ));
        // Set Header
        if (!empty($headers)) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        }
        $response = curl_exec($curl);
        $errno = curl_errno($curl);
        if ($errno) {
            return false;
        }
        curl_close($curl);
        return $response;
    }


    public function GET($endpoint,$query=[]){

        $curl = curl_init($endpoint);
        $personal_token =$this->api_token;
        $header = array();
        $header[] = 'Authorization: Bearer '.$personal_token;
        $header[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10.11; rv:41.0) Gecko/20100101 Firefox/41.0';
        $header[] = 'timeout: 20';
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER,$header);
        $envatoRes = curl_exec($curl);
        curl_close($curl);
        $responseData    = json_decode($envatoRes);

        return $responseData;
    }
}
