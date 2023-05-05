<?php

namespace App\Http\Controllers;

use App\Models\Familium;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class FamiliumController
 * @package App\Http\Controllers
 */
class FamiliumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/familia",
     *     description="Obtain family records data",
     *     tags={"Familia"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de Datos Familiares"
     *      ),
     * )
     */
    public function index()
    {
        $familia = Familium::with('user')->get();

        return response()->json($familia, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/familia",
     *     description="Store a newly created resource in database",
     *     tags={"Familia"},
     *     @OA\RequestBody(
     *     required = true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "full_name",
     *                      description = "Nombre Completo",
     *                      type = "string"
     *                  ),
     *                  @OA\Property(
     *                      property = "gender",
     *                      description = "Género",
     *                      type = "string"
     *                  ),
     *                  @OA\Property(
     *                      property = "date_of_birth",
     *                      description = "Fecha de cumpleaños",
     *                      type = "string"
     *                  ),
     *                  @OA\Property(
     *                      property = "user_id",
     *                      description = "Identificación del Usuario",
     *                      type = "number"
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *      response=201,
     *      description="Crear un registro familiar",
     *     )
     * )
     */

    public function store(Request $request)
    {
        request()->validate(Familium::$rules);

        $familium = Familium::create($request->all());

        return response()->json($familium, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/familia/{id}",
     *     description="Get family information by ID",
     *     tags={"Familia"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener la información familiar por su id",
     *      )
     * )
     */
    public function show(int $id)
    {
        $familium = Familium::find($id);

        return response()->json($familium, Response::HTTP_OK);
    }


    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/familia/childrens/{id}",
     *     description="Get family information by ID",
     *     tags={"Familia"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener la información familiar por su id",
     *      )
     * )
     */
    public function showByUserId(int $id){
        $familium = Familium::selectRaw('id,full_name, CASE WHEN gender = "M" THEN "Masculino" WHEN gender = "F" THEN "Femenino" ELSE "OTROS" END as gender, date_of_birth, CASE WHEN (TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE())) = 0 THEN CONCAT(TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()), " años de edad") WHEN (TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE())) = 1 THEN CONCAT(TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()), " año de edad") WHEN (TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE())) > 1 THEN CONCAT(TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()), " años de edad") END AS age')->where(['user_id' => $id])->get();

        return response()->json($familium, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Familium $familium
     * @param $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/familia/{id}",
     *     description="Update a record",
     *     tags={"Familia"},
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
     *                      property = "full_name",
     *                      description = "Nombre Completo",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "gender",
     *                      description = "Género",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "date_of_birth",
     *                      description = "Fecha de nacimiento",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "user_id",
     *                      description = "identificación del usuario",
     *                      type = "number",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *     response=201,
     *     description="Actualizar un registro familiar",
     * ),
     * )
     */
    public function update(Request $request, Familium $familium, $id)
    {
        request()->validate(Familium::$rules);

        $familium->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/familia/{id}",
     *     description="Delete a single type on the ID supplied",
     *     tags={"Familia"},
     *     @OA\Parameter (
     *      description = "ID to delete",
     *      in = "path",
     *      name = "id",
     *      required = true,
     *     ),
     *     @OA\Response(
     *     response=204,
     *     description="Eliminar un registro familiar",
     * )
     * )
     */
    public function destroy($id)
    {
        $familium = Familium::find($id)->delete();

        return response()->json($familium, Response::HTTP_OK);
    }
}
