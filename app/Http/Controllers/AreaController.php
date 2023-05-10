<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AreaController
 * @package App\Http\Controllers
 */
class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/area",
     *     description="Obtener todas las areas",
     *     tags={"Areas Laborales"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de Areas"
     *      ),
     * )
     */
    public function index()
    {
        $areas = Area::selectRaw('id as value, description as label')->get();

        return response()->json($areas, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/area",
     *     description="Guarda la información de las áreas laborales",
     *     tags={"Areas Laborales"},
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
        request()->validate(Area::$rules);
        return response()->json(Area::create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/area/{id}",
     *     description="Obtener una area por ID",
     *     tags={"Areas Laborales"},
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
        $area = Area::find($id);

        return response()->json($area,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  Area $area
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/area/{id}",
     *     description="Actualizar una área",
     *     tags={"Areas Laborales"},
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
    public function update(Request $request, Area $area, int $id)
    {
        request()->validate(Area::$rules);

        $area->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/area/{id}",
     *     description="Elimina un registro",
     *     tags={"Areas Laborales"},
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
    public function destroy(int $id)
    {
        $area = Area::find($id)->delete();

        return response()->json($area,Response::HTTP_OK);
    }
}
