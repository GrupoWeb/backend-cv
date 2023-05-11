<?php

namespace App\Http\Controllers;

use App\Models\Sancione;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class SancioneController
 * @package App\Http\Controllers
 */
class SancioneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/sancion",
     *     description="Obtener todas las areas",
     *     tags={"Sanciones Laborales"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de registros"
     *      ),
     * )
     */
    public function index()
    {
        $sanciones = Sancione::selectRaw('id as value, description as label')->get();

        return response()->json($sanciones, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/sancion",
     *     description="Guarda la información de las faltas laborales",
     *     tags={"Sanciones Laborales"},
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
        request()->validate(Sancione::$rules);

        return response()->json(Sancione::create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/sancion/{id}",
     *     description="Obtener una falta por ID",
     *     tags={"Sanciones Laborales"},
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
    public function show($id)
    {
        $sancione = Sancione::find($id);

        return response()->json($sancione,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Sancione $sancione
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/sancion/{id}",
     *     description="Actualizar una área",
     *     tags={"Sanciones Laborales"},
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
    public function update(Request $request, Sancione $sancione, int $id)
    {
        request()->validate(Sancione::$rules);

        $sancione->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/sancion/{id}",
     *     description="Elimina un registro",
     *     tags={"Sanciones Laborales"},
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
        $sancione = Sancione::find($id)->delete();

        return response()->json($sancione,Response::HTTP_OK);
    }
}
