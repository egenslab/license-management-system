<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{

    protected $api_token = '';
    protected $client;
    protected $base_url;
    protected $client_id;
    protected $client_secret;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $authorizations=$request->session()->get('ADMIN_ENVATO_AUTHORIZED');
        if ($authorizations==''){
            return redirect('/admin/authorizations');
        }

        $result['totalInstall']       = DB::table('licenses')->count();
        $result['totalLicenseUsed']   = DB::table('licenses')
            ->where('license_key', '<>', '', 'and')
            ->count();

        $result['totalDeactivatedPlugin']   = DB::table('licenses')
            ->where(['plugin_activated_status'=>2])
            ->count();

        return view('admin.dashboard',$result);
    }

    
    public function auth(Request $request)
    {
        $email=$request->post('email');
        $password=$request->post('password');

        // $result=Admin::where(['email'=>$email, 'password'=>$password])->get();
        $result=Admin::where(['email'=>$email])->first();

        if($result){
            if(Hash::check($password,$result->password)){
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID',$result->id);
                $request->session()->put('ADMIN_ENVATO_AUTHORIZED',$result->authorizations_status);
                return redirect('admin/dashboard');
            }else{
                $request->session()->flash('error','Please Enter Correct Password');
                return redirect('admin/login');
            }
            
        }else{
            $request->session()->flash('error','Please Enter Valid Email Address');
            return redirect('admin/login');
        }        
        
    }

    /*
    * @ Authintications
    * @ Calling From Frontend
    */
    public function login(Request $request)
    {
        if($request->session()->has('ADMIN_LOGIN')){
            return redirect('admin');
        }

        return view('admin.auth');

    }

    /*
    * @ Return User List
    * @ Calling From API which one set in wordpress
    */
    public function license(Request $request){

        $authorizations=$request->session()->get('ADMIN_ENVATO_AUTHORIZED');
        if ($authorizations==''){
            return redirect('/admin/authorizations');
        }

       $license= DB::table('licenses')
            ->where('license_key', '<>', '', 'and')
            ->get();
        return view('admin.license_list',['license'=>$license]);
    }

    /*
    * @ Return License View
    * @ Calling From applications
    */
    public function licenseView($licenseId){
        $license= DB::table('licenses')
            ->where('license_key', '<>', '', 'and')
            ->get();
        return view('admin.license_list',['license'=>$license]);
    }

    /*
     * @ Return User List
     * @ Calling From API which one set in wordpress
     */
    public function users(Request $request){

        $authorizations=$request->session()->get('ADMIN_ENVATO_AUTHORIZED');
        if ($authorizations==''){
            return redirect('/admin/authorizations');
        }

        $installUsers= DB::table('licenses')->get();
        return view('admin.user_list',['installUsers'=>$installUsers]);
    }

    public function store(){
        echo 1;
        exit();
    }

    public function authorizations(Request $request)
    {
        $currentUrl     =url('admin/envato_authorized');
        $client_id      ='laravel-applications-rqpsulk8';

        $redirectUrl='https://api.envato.com/authorization?response_type=code&client_id='.$client_id.'&redirect_uri='.$currentUrl.'';
        return view('admin.authorizations',['redirectUrl'=>$redirectUrl]);

    }

    public function envato_license_authorizations(Request $request)
    {
        $userId  =$request->session()->get('ADMIN_ID');
        $updateModel                          = Admin::find($userId);

        if (isset($_REQUEST['code'])){

            $this->client_id        ='eg_notifications_license-bllcb4o2';
            $this->client_secret    ='OB4bxqgxw90M0eKsG52v7n7F4LtUtnYM';

            $redirectCode       =$_REQUEST['code'];
            $getAccessToken      =$this->getAccessToken($redirectCode);
            $getAccessToken     =json_decode($getAccessToken);

            if (isset($getAccessToken->refresh_token)){

                $refreshToken    =$getAccessToken->refresh_token;
                $access_token   =$getAccessToken->access_token;
                $expired        =$getAccessToken->expires_in;

                $updateModel->envato_refresh_token=$refreshToken;
                $updateModel->envato_access_token=$access_token;
                $updateModel->envato_expirations=$expired;
                $updateModel->authorizations_status='yes';

                if ($updateModel->update()){
                    $request->session()->put('ADMIN_ENVATO_AUTHORIZED',$updateModel->authorizations_status);
                    return redirect('/admin/dashboard');
                }
            }else{
                return redirect('/admin/authorizations');
            }
        }

    }

    public function getAccessToken($redirectCode){

        $this->base_url='https://api.envato.com';

        $dataArray   = [
            "grant_type" => "authorization_code",
            "code" =>$redirectCode,
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
}
