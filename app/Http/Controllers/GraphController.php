<?php

namespace App\Http\Controllers;
 
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class GraphController extends Controller
{
    private $api;
    public function __construct(Facebook $fb)
    {        
        $this->middleware(function ($request, $next) use ($fb) {            
            $fb->setDefaultAccessToken(Auth::user()->remember_token);            
            $this->api = $fb;            
            return $next($request);
        });
    }
 
    public function retrieveUserProfile(){
        try {            
 
            $params = "first_name,last_name";
            
            $user = $this->api->get('/me?fields='.$params)->getGraphUser();
 
            dd('usuario' . $user);
 
        } catch (FacebookSDKException $e) {
            
            dd('erro');
        }
 
    }
}