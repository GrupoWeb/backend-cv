<?php

namespace App\Http\Controllers;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::selectRaw("users.id,CONCAT(users.first_name, ' ', users.second_name, ' ', users.surname, ' ', users.second_surname) as name, users.email, roles.display_name as rol, date_format(users.created_at,'%d/%m/%Y %H:%i:%S') as fecha_creacion")->join('roles','roles.id','=','users.role_id')->get(),Response::HTTP_OK);
    }

    public function profile(Request $request)
    {
        $profile = [];
        $user = User::selectRaw("CONCAT(users.first_name, ' ', users.second_name, ' ', users.surname, ' ', users.second_surname) as name")->where(['id' =>  $request->id])->first();
        $avatar = Voyager::image( User::select('avatar')->where(['id'   =>  $request->id])->first()->avatar );
        $profile[] = [
            "avatar" => $avatar,
            "user" => $user
        ];
        return $profile;
    }
}
