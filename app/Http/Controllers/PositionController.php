<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class PositionController
 * @package App\Http\Controllers
 */
class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/puesto",
     *     description="Obtener todas los registros",
     *     tags={"Puestos Laborales"},
     *     @OA\Response(
     *          response=200,
     *          description="descripción"
     *      ),
     * )
     */
    public function index()
    {
        $positions = Position::selectRaw('id as value, description as label')->get();

        return response()->json($positions, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/puesto",
     *     description="Guarda la información de los puestos laborales",
     *     tags={"Puestos Laborales"},
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
     *      description="Crear una área",
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(Position::$rules);
        return response()->json(Position::create($request->all()), Response::HTTP_CREATED);


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/puesto/{id}",
     *     description="Obtener un puesto por ID",
     *     tags={"Puestos Laborales"},
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
        $position = Position::find($id);

        return response()->json($position,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Position $position
     * @param  int $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/puesto/{id}",
     *     description="Actualizar un puesto",
     *     tags={"Puestos Laborales"},
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
    public function update(Request $request, Position $position, int $id)
    {
        request()->validate(Position::$rules);

        $position->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/puesto/{id}",
     *     description="Elimina un registro",
     *     tags={"Puestos Laborales"},
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
        $position = Position::find($id)->delete();

        return response()->json($position,Response::HTTP_OK);
    }
}
