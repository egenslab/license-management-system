<?php

// Authentication mechanism
namespace App\Http\Controllers;

use Redirect;
use Auth;
use Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Html\HtmlServiceProvider;


class UsersController extends Controller{
    public
  function showLogin()
    {
    // Form View
    return view('login');
    }
  public
  function doLogout()
    {
    Auth::logout(); // logging out user
    return Redirect::to('login'); // redirection to login screen
    }
  public
  function doLogin()
    {
    // Creating Rules for Email and Password
    $rules = array(
      'email' => 'required|email', // make sure the email is an actual email
      'password' => 'required|alphaNum|min:8');
      // password has to be greater than 3 characters and can only be alphanumeric and);
      // checking all field
      $validator = Validator::make(request()->all() , $rules);
      // if the validator fails, redirect back to the form
      if ($validator->fails())
        {
        return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
        ->withInput(request()->except('password')); // send back the input (not the password) so that we can repopulate the form
        }
        else
        {
        // create our user data for the authentication
        $userdata = array(
          'email' => request()->get('email') ,
          'password' => request()->get('password'),
          'tenantid' => \Session::get('tenantid')
        );
        
        \App\Tenant::getTenant();
        if((\Session::get('tenantid'))) {
		     // attempt to do the login
		     if (Auth::attempt($userdata))
		       {
		       // validation successful
		       // do whatever you want on success
		       
		       return Redirect::to('/');
		       }
		       else
		       {
		       	\Session::put('loginerror', "Authentication Failed!!!!");
		       // validation not successful, send back to formreturn redirect("login")->withSuccess('You are not allowed to access');
		       return Redirect::to('login');
		       }
		     } else {
		     \Session::put('loginerror', "Authentication Failed for this Tenant!!!!");
		     	return Redirect::to('login');
		     }
        }
      }
}
