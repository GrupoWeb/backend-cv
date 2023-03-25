<?php

namespace App\Http\Controllers;

use App\Models\TipoTelefono;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TipoTelefonoController
 * @package App\Http\Controllers
 */
class TipoTelefonoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/tipo-telefono",
     *     description="Get all the types",
     *     tags={"Tipos de Teléfonos"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de tipo de Teléfono"
     *      ),
     * )
     */
    public function index()
    {
        $tipos = TipoTelefono::selectRaw('id as value, description as label')->get();
        return response()->json($tipos, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/tipo-telefono",
     *     description="Store a newly created resource in database",
     *     tags={"Tipos de Teléfonos"},
     *     @OA\RequestBody(
     *     required = true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "description",
     *                      description = "Descripción del Tipo",
     *                      type = "string"
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *      response=201,
     *      description="Crear un tipo",
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(TipoTelefono::$rules);
        return response()->json(TipoTelefono::create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/tipo-telefono/{tipo}",
     *     description="Get a record of phone type",
     *     tags={"Tipos de Teléfonos"},
     *     @OA\Parameter (
     *      name="tipo",
     *      in="path",
     *      description="id for type",
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
        $tipoTelefono = TipoTelefono::find($id);
        return response()->json($tipoTelefono,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param TipoTelefono $tipoTelefono
     * @param $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/tipo-telefono/{tipo}",
     *     description="Update a type",
     *     tags={"Tipos de Teléfonos"},
     *     @OA\Parameter (
     *          name="tipo",
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
     *                      property = "description",
     *                      description = "description",
     *                      type = "string",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *     response=201,
     *     description="Actualizar un tipo",
     * ),
     * )
     */
    public function update(Request $request, TipoTelefono $tipoTelefono, $id)
    {
        request()->validate(TipoTelefono::$rules);

        $tipoTelefono->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/tipo-telefono/{tipo}",
     *     description="Delete a single type on the ID supplied",
     *     tags={"Tipos de Teléfonos"},
     *     @OA\Parameter (
     *      description = "ID of type to delete",
     *      in = "path",
     *      name = "tipo",
     *      required = true,
     *     ),
     *     @OA\Response(
     *     response=204,
     *     description="Eliminar un tipo de telefono",
     * )
     * )
     */
    public function destroy(int $id)
    {
        $tipoTelefono = TipoTelefono::find($id)->delete();

        return response()->json($tipoTelefono,Response::HTTP_OK);
    }
}
