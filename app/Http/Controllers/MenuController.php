<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index(Request $request){
        if($request->menu == 'Administrator'){
            return menu('cvisual','_json');
        }else{
            return menu($request->menu,'_json');
        }
    }
}
