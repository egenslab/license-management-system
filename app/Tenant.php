<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tenant;


class Tenant extends Model
{
    protected $table = "tenants";
    public static function getTenant() {
    	$url = request()->getHttpHost();
    	//echo $url;
    	//Amudha123Test
    	$urlArray = explode(".", $url);
    	$subdomain = $urlArray[0];
    	
    	if($subdomain == "www") $subdomain = $urlArray[1];
    	$tenant = Tenant::where('subdomain', 'LIKE', $subdomain)->first();
    	if(!$tenant) {
    		echo view("tenant_not_found")->with(['tenant' => $subdomain]);
    		exit();
    	}
    	$tenant->tenantName = $tenant->name;
    	if(\Session::get('tenantName'))  $tenant->SessionTenant = \Session::get('tenantName');
//    	session()->get('key');Session::push('
		\Session::put('tenantName', $tenant->tenantName);
		\Session::put('tenantid', $tenant->id);
    	\View::share('tenant', $tenant);
    	
    	
    }
}
