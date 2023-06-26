<?php

namespace App\Http\Controllers;

use App\Models\Falta;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FaltaController
 * @package App\Http\Controllers
 */
class FaltaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/falta-laboral",
     *     description="Obtener todas las areas",
     *     tags={"Faltas Laborales"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de registros"
     *      ),
     * )
     */
    public function index()
    {
        $faltas = Falta::selectRaw('id, articulo_interno, description, area, fundamento_legal, frecuencia, limpia_record')->get();

        return response()->json($faltas, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/falta-laboral",
     *     description="Guarda la información de las faltas laborales",
     *     tags={"Faltas Laborales"},
     *     @OA\RequestBody(
     *     required = true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "description",
     *                      description = "Descripción",
     *                      type = "string"
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *      response=201,
     *      description="Crear una falta",
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(Falta::$rules);

        return response()->json(Falta::create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/falta-laboral/{id}",
     *     description="Obtener una falta por ID",
     *     tags={"Faltas Laborales"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="ID",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="descripción",
     *      )
     * )
     */
    public function show(int $id)
    {
        $falta = Falta::find($id);

        return response()->json($falta,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Falta $falta
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/falta-laboral/{id}",
     *     description="Actualizar una área",
     *     tags={"Faltas Laborales"},
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
     *                      property = "description",
     *                      description = "description",
     *                      type = "string",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *     response=201,
     *     description="Actualizar un registro",
     * ),
     * )
     */
    public function update(Request $request, Falta $falta, int $id)
    {
        request()->validate(Falta::$rules);

        $falta->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/falta-laboral/{id}",
     *     description="Elimina un registro",
     *     tags={"Faltas Laborales"},
     *     @OA\Parameter (
     *      description = "ID of type to delete",
     *      in = "path",
     *      name = "id",
     *      required = true,
     *     ),
     *     @OA\Response(
     *     response=204,
     *     description="Eliminar un registro",
     * )
     * )
     */
    public function destroy($id)
    {
        $falta = Falta::find($id)->delete();

        return response()->json($falta,Response::HTTP_OK);
    }
}
