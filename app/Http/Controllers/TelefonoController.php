<?php

namespace App\Http\Controllers;

use App\Models\Telefono;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TelefonoController
 * @package App\Http\Controllers
 */
class TelefonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/telefono",
     *     description="Get phone list",
     *     tags={"Teléfonos"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de Teléfonos"
     *      ),
     * )
     */
    public function index()
    {
        $telefonos = Telefono::with(['tipoTelefono','user'])->get();
        return response()->json($telefonos,Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/telefono",
     *     description="Store a newly created resource in database",
     *     tags={"Teléfonos"},
     *     @OA\RequestBody(
     *     required = true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "number",
     *                      description = "Número de Teléfono",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "tipo_telefono_id",
     *                      description = "Identificación del tipo de teléfono",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "user_id",
     *                      description = "Identificación del Usuario",
     *                      type = "integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *      response=201,
     *      description="Crear un Teléfono",
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(Telefono::$rules);

        $telefono = Telefono::create($request->all());

        return response()->json($telefono, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/telefono/{id}",
     *     description="Get a record of phone type",
     *     tags={"Teléfonos"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id for Phone",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener un tipo de teléfono",
     *      )
     * )
     */
    public function show(int $id)
    {
        $telefono = Telefono::find($id);

        return response()->json($telefono, Response::HTTP_OK);
    }


    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/telefono/usuario/{id}",
     *     description="Get telefono information by ID",
     *     tags={"Teléfonos"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener la información de los teléfonos por su id",
     *      )
     * )
     */

    public function showByUserId(int $id){
        $telefono = Telefono::selectRaw('telefonos.id, telefonos.number, tipo_telefonos.description')->join('tipo_telefonos','tipo_telefonos.id','=','telefonos.tipo_telefono_id')
            ->where(['telefonos.user_id'    =>  $id])->get();
        return response()->json($telefono, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Telefono $telefono
     * @param $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/telefono/{id}",
     *     description="Update a Phone",
     *     tags={"Teléfonos"},
     *     @OA\Parameter (
     *          name="id",
     *          in="path",
     *          description="id",
     *          required = true,
     *      ),
     *     @OA\RequestBody(
     *          required = true,
     *          @OA\MediaType(
     *              mediaType = "application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "number",
     *                      description = "number",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "tipo_telefono_id",
     *                      description = "Phone type identification",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "user_id",
     *                      description = "User Identification",
     *                      type = "integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *     response=201,
     *     description="Actualizar un Teléfono",
     * ),
     * )
     */
    public function update(Request $request, Telefono $telefono, $id)
    {
        request()->validate(Telefono::$rules);

        $telefono->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/telefono/{id}",
     *     description="Delete a single phone on the ID supplied",
     *     tags={"Teléfonos"},
     *     @OA\Parameter (
     *      description = "ID of Phone to delete",
     *      in = "path",
     *      name = "id",
     *      required = true,
     *     ),
     *     @OA\Response(
     *     response=204,
     *     description="Eliminar un telefono",
     * )
     * )
     */
    public function destroy(int $id)
    {
        $telefono = Telefono::find($id)->delete();

        return response()->json($telefono, Response::HTTP_OK);
    }
}
