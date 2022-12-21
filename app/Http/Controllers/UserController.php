<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Http\Request;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/users",
     *     description="Get all Users",
     *     tags={"Users"},
     *     @OA\Response(
     *     response=200,
     *     description="Listado de Usuarios"
     * ),
     * )
     */

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


    public function storeUser(StoreUserRequest $request){

        $user = User::create($request->all());

        return response()->json($user, Response::HTTP_OK);

    }


}
