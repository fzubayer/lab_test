<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

    

class AdminController extends Controller
{
    public function login(Request $request){
    	if($request->isMethod('post')){
    		$data = $request->input();
            $adminCount = Admin::where(['username' => $data['username'],'password'=>($data['password'])]); 
            {

                
                
                
                session()->put('adminSession', $data['username']);
                //$request->session()->put('adminSession',$data['username']);
                
                return redirect('/dashboard');
            }   
        
    	}
    	return view('admin_login');
    }



    

    public function logout(){
        session()->flush();
        return redirect('/admin')->with('flash_message_success', 'Logged out successfully.');
       
    }
    
}

