<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCG\Voyager\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
