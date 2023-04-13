<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller
{
    public function validator($data,$rules){
        $validate=Validator::make($data,$rules);
        if($validate->fails()){
            return $validate->errors();
        }else{
           return null;
        }
    }
}
