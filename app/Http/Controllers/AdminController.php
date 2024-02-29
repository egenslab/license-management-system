<?php

namespace App\Http\Controllers;



use App\Models\Admin;
use App\Models\License;
use App\Models\Product;
use App\Classes\EnvatoApi2;
use App\Models\PurchaseCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    protected $api_token = '';
    protected $client;
    protected $base_url;
    protected $client_id;
    protected $client_secret;
    protected $envatoApi;


    public function __construct(EnvatoApi2 $envatoApi)
    {

        $this->envatoApi = $envatoApi;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)


    {

        $authorizations = $request->session()->get('ADMIN_ENVATO_AUTHORIZED');

        if ($authorizations == '') {
            return redirect('/admin/authorizations');
        }

        $result['totalInstall']       = DB::table('licenses')->count();
        $result['totalLicenseUsed']   = DB::table('licenses')
            ->where('license_key', '<>', '', 'and')
            ->count();

        $result['totalDeactivatedPlugin']   = DB::table('licenses')
            ->where(['plugin_activated_status' => 2])
            ->count();

        return view('admin.dashboard', $result);
    }


    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');



        // dd($result->authorizations_status);

        // $result=Admin::where(['email'=>$email, 'password'=>$password])->get();
        $result = Admin::where(['email' => $email])->first();

        if ($result) {
            if (Hash::check($password, $result->password)) {
                $request->session()->put('ADMIN_LOGIN', true);
                $request->session()->put('ADMIN_ID', $result->id);
                $request->session()->put('ADMIN_ENVATO_AUTHORIZED', $result->authorizations_status);
                return redirect('admin/dashboard');
            } else {
                $request->session()->flash('error', 'Please Enter Correct Password');
                return redirect('admin/login');
            }
        } else {
            $request->session()->flash('error', 'Please Enter Valid Email Address');
            return redirect('admin/login');
        }
    }

    /*
    * @ Authintications
    * @ Calling From Frontend
    */
    public function login(Request $request)
    {
        if ($request->session()->has('ADMIN_LOGIN')) {
            return redirect('admin');
        }

        return view('admin.auth');
    }

    /*
    * @ Return User List
    * @ Calling From API which one set in wordpress
    */
    public function license(Request $request)
    {

        $authorizations = $request->session()->get('ADMIN_ENVATO_AUTHORIZED');
        if ($authorizations == '') {
            return redirect('/admin/  ');
        }

        $license =  License::latest()->get();
        return view('admin.license_list', ['license' => $license]);
    }

    /*
    * @ Return License View
    * @ Calling From applications
    */
    public function licenseView($licenseId)
    {
        $license = License::find($licenseId);
        $response=  json_decode($license->envato_response , true);
        $ipDetails=  json_decode($license->ip_details , true);
    //    dd($response);
        return view('admin.license-detail', compact('license', 'response','ipDetails'));
    }

    /*
     * @ Return User List
     * @ Calling From API which one set in wordpress
     */
    public function users(Request $request)
    {

        $authorizations = $request->session()->get('ADMIN_ENVATO_AUTHORIZED');
        if ($authorizations == '') {
            return redirect('/admin/authorizations');
        }

        $installUsers = DB::table('licenses')->get();
        return view('admin.user_list', ['installUsers' => $installUsers]);
    }

    public function store()
    {
        echo 1;
        exit();
    }



    public function licenseDelete($id)
    {
        License::where('id', $id)->delete();
        toastr()->success('Data has been delete successfully!');
        return redirect()->back();
    }

    public function authorizations(Request $request)
    {
        $currentUrl     = url('admin/envato_authorized');
        $client_id      = 'laravel-applications-rqpsulk8';
        $redirectUrl = 'https://api.envato.com/authorization?response_type=code&client_id=' . $client_id . '&redirect_uri=' . $currentUrl . '';
        return view('admin.authorizations', ['redirectUrl' => $redirectUrl]);
    }

    public function envato_license_authorizations(Request $request)
    {




        $userId  = $request->session()->get('ADMIN_ID');
        $updateModel                          = Admin::find($userId);


        if (isset($_REQUEST['code'])) {

            $this->client_id        = 'eg_notifications_license-bllcb4o2';
            $this->client_secret    = 'OB4bxqgxw90M0eKsG52v7n7F4LtUtnYM';

            $redirectCode       = $_REQUEST['code'];


            $getAccessToken      = $this->getAccessToken($redirectCode);


            // dd($getAccessToken);

            $getAccessToken     = json_decode($getAccessToken);


            if (isset($getAccessToken->refresh_token)) {

                $refreshToken    = $getAccessToken->refresh_token;
                $access_token   = $getAccessToken->access_token;
                $expired        = $getAccessToken->expires_in;

                $updateModel->envato_refresh_token = $refreshToken;
                $updateModel->envato_access_token = $access_token;
                $updateModel->envato_expirations = $expired;
                $updateModel->authorizations_status = 'yes';

                if ($updateModel->update()) {
                    $request->session()->put('ADMIN_ENVATO_AUTHORIZED', $updateModel->authorizations_status);
                    return redirect('/admin/dashboard');
                }
            } else {
                return redirect('/admin/authorizations');
            }
        }
    }

    public function getAccessToken($redirectCode)
    {

        $this->base_url = 'https://api.envato.com';

        $dataArray   = [
            "grant_type" => "authorization_code",
            "code" => $redirectCode,
            "client_id" => $this->client_id,
            "client_secret" => $this->client_secret,
        ];

        return $this->POST($this->base_url . '/token', $dataArray);
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



    public function verify()
    {

        return view('admin.verify');
    }


    // public function envatoPurchase(Request $request)
    // {

    //     $purchase_code = $request->purchase_code;
    //     $result_type = $request->result_type;
    //     $o = $this->envatoApi::verifyPurchase($purchase_code);

    //     if (is_object($o)) {
    //         $output  = '<div class="panel panel-default">';
    //         $output .= '<div class="panel-heading">Product Name</div>';
    //         $output .= '<div class="panel-body">';
    //         $output .= '<strong>' . $o->item->name . '</strong>';
    //         $output .= '</div></div>';
    //         $output .= '<div class="panel panel-success">';
    //         $output .= '<div class="panel-heading">Item ID</div>';
    //         $output .= '<div class="panel-body">';
    //         $output .= '<strong>' . $o->item->id . '</strong>';
    //         $output .= '</div></div>';
    //         $output .= '<div class="panel panel-default">';
    //         $output .= '<div class="panel-heading">Purchase Date</div>';
    //         $output .= '<div class="panel-body">';
    //         $output .= '<strong>' . date("d F Y", strtotime($o->sold_at)) . '</strong>';
    //         $output .= '</div></div>';
    //         $output .= '<div class="panel panel-success">';
    //         $output .= '<div class="panel-heading">Buyer Name</div>';
    //         $output .= '<div class="panel-body">';
    //         $output .= '<strong>' . $o->buyer . '</strong>';
    //         $output .= '</div></div>';
    //         $output .= '<div class="panel panel-default">';
    //         $output .= '<div class="panel-heading">License Type</div>';
    //         $output .= '<div class="panel-body">';
    //         $output .= '<strong>' . $o->license . '</strong>';
    //         $output .= '</div></div>';
    //         $output .= '<div class="panel panel-success">';
    //         $output .= '<div class="panel-heading">Supported Until</div>';
    //         $output .= '<div class="panel-body">';
    //         $output .= '<strong>' . date("d F Y", strtotime($o->supported_until)) . '</strong>';
    //         $output .= '</div></div>';

    //         $output_table = '<table class="table table-bordered">';
    //         $output_table .= '<thead><tr><th>Title</th> <th>Value</th></tr> </thead>';
    //         $output_table .= '<tbody>';
    //         $output_table .= '<tr><td>Product Name</td><td>' . $o->item->name . '</td></tr>';
    //         $output_table .= '<tr><td>Product ID</td><td>' . $o->item->id . '</td></tr>';
    //         $output_table .= '<tr><td>Purchase Date</td><td>' . date("d F Y", strtotime($o->sold_at)) . '</td></tr>';
    //         $output_table .= '<tr><td>Buyer Name</td><td>' . $o->buyer . '</td></tr>';
    //         // $output_table .= '<tr><td>Buyer Name</td><td>'. $o->buyer_email .'</td></tr>';
    //         $output_table .= '<tr><td>License Type</td><td>' . $o->license . '</td></tr>';
    //         $output_table .= '<tr><td>Supported Until</td><td>' . date("d F Y", strtotime($o->supported_until)) . '</td></tr>';
    //         $output_table .= '</tbody>';
    //         $output_table .= '</table>';
    //         switch ($result_type) {
    //             case 'table':
    //                 return view('admin.verify', compact('output_table'));
    //                 break;

    //             case 'list':
    //                 return view('admin.verify', compact('output'));
    //                 break;
    //             default:
    //                 echo $output_table;
    //                 return view('admin.verify', compact('output_table'));
    //                 break;
    //         }
    //     } else {
    //         echo "<span style='color: red'>Sorry, This is not a valid purchase code or this user have not purchased any of your items.</div>";
    //     }
    // }


    public function purchaseCodeList()
    {
        $purchaseCodes = PurchaseCode::all();

        return view('admin.purchase-code-list', compact('purchaseCodes'));
    }

    public function purchaseCodeGenerate()
    {
        $products = Product::all();
        return view('admin.generate-code', compact('products'));
    }

    public function purchaseCodeStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'purchase_code' => 'required',
            'marketplace_name' => 'required',
            'product_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        PurchaseCode::create([
            'purchase_code' => $request->purchase_code,
            'marketplace_name' => $request->marketplace_name,
            'product_name' => $request->product_name
        ]);

        toastr()->success('Data has been saved successfully!');
        return redirect()->route('purchase.code.list');
    }

    public function purchaseCodeDelete($id)
    {
        PurchaseCode::where('id', $id)->delete();
        toastr()->success('Data has been delete successfully!');
        return redirect()->back();
    }
}
