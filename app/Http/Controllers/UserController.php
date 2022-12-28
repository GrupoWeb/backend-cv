<?php

namespace App\Http\Controllers;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
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
        $user = User::where(['id' =>  $request->id])->get();
        return response()->json($user, Response::HTTP_OK);
    }

    public function urlAvatar(Request $request){

    }


    /**
     * @param StoreUserRequest $request
     * @return JsonResponse
     */
    public function storeUser(StoreUserRequest $request){

        $user = User::create($request->all());
        $fileName = time() . '_'.'fotografia_user_';
        $file = $request->file('file');
        $this->storeAvatarUser($file , $fileName, $file->getClientOriginalExtension(), $user->id);
        return response()->json($user, Response::HTTP_OK);

    }

    /**
     * @param $file
     * @param $filename
     * @param $extension
     * @param $id
     * @return void
     */
    protected function storeAvatarUser($file, $filename, $extension, $id): void
    {
        $fileName = $filename . $id . '.' . $extension;
        Storage::disk(config('voyager.storage.disk'))->putFileAs('users/',$file,$fileName);
        $url = Storage::url('users/' . $fileName );
        User::find($id)->update(['avatar'   =>  $url]);
    }


}
