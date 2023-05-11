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
        return response()->json(User::selectRaw("users.id,CONCAT(users.first_name, ' ', users.second_name, ' ', users.surname, ' ', users.second_surname) as name, users.email, users.corporate_mail, roles.display_name as rol, date_format(users.created_at,'%d/%m/%Y %H:%i:%S') as fecha_creacion,area_id, position_id, date_of_admission, bank_account, account_name, license_number, scholarship")->join('roles','roles.id','=','users.role_id')->get(),Response::HTTP_OK);
    }

    public function profile(Request $request)
    {
        $user = User::where(['id' =>  $request->id])->get();
        return response()->json($user, Response::HTTP_OK);
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

    /**
     * @param $file
     * @param $filename
     * @param $id
     * @return void
     */
    protected function UpdateAvatarUser($file, $filename, $id): void
    {
        $fileName = $filename;
        Storage::disk(config('voyager.storage.disk'))->putFileAs('users/',$file,$fileName);
        $url = Storage::url('users/' . $fileName );
        User::find($id)->update(['avatar'   =>  $url]);
    }

    /**
     * @param $name
     * @return bool
     */
    protected function existAndDeleteFile($name){
        if(Storage::disk(config('voyager.storage.disk'))->exists('users/'.$name)){
            Storage::disk(config('voyager.storage.disk'))->delete('users/' . $name);
            return true;
        }else{
            return false;
        }
    }

    /**
     * @param $id
     * @return string
     */
    protected function splitAvatarPath($id){
        $user = User::select('avatar')->where([ 'id'    =>  $id])->get();
        $name = explode('/storage/users/',$user[0]->avatar);
        return $name[1];
    }


    /**
     * @param Request $request
     * @return Response
     */
    public function updateAvatarById(Request $request){
        if($this->existAndDeleteFile($this->splitAvatarPath($request->id))){
            $file = $request->file('file');
            $name = $file->hashName();
            $this->UpdateAvatarUser($file, $name, $request->id);

            return response()->json(User::select('avatar')->where([ 'id'    =>  $request->id])->get(), Response::HTTP_ACCEPTED);
        }else{
            $fileName = time() . '_'.'fotografia_user_';
            $file = $request->file('file');
            $this->storeAvatarUser($file , $fileName, $file->getClientOriginalExtension(), $request->id);
            return response()->json(User::select('avatar')->where([ 'id'    =>  $request->id])->get(), Response::HTTP_ACCEPTED);
        }
    }


    public function updateUserById(Request $request){
        $user = User::where([ 'id'    =>  $request->id])->update($request->all());
        return response()->json($user, Response::HTTP_ACCEPTED);
    }

    /**
     * @param int $id
     * @return Response
     */

    public function destroy(int $id){

        if(User::where(['id' => $id, 'role_id' => 2])->delete() === 1){
            return response()->json(true,Response::HTTP_OK);
        }else{
            return response()->json(false,Response::HTTP_NOT_MODIFIED);
        }
    }

    /**
     * @param Request $request
     * @return Response
     */

    public function setLabor(Request $request){
        $user = User::where([ 'id'    =>  $request->id])->update($request->all());
        return response()->json($user, Response::HTTP_ACCEPTED);
    }


}
