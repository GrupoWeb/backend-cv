<?php

namespace App\Http\Controllers;

use App\Models\Salario;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use DB;

/**
 * Class SalarioController
 * @package App\Http\Controllers
 */
class SalarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/salario",
     *     description="Get a list of salaries",
     *     tags={"Salarios"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de Salarios"
     *      ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     ),
     * )
     */
    public function index()
    {
        $salarios = Salario::with('user')->get();

        return response()->json($salarios, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/salario",
     *     description="Store a newly created resource in database",
     *     tags={"Salarios"},
     *     @OA\RequestBody(
     *     required = true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "salary",
     *                      description = "Salario",
     *                      type = "number"
     *                  ),
     *                  @OA\Property(
     *                      property = "bonus",
     *                      description = "Bonificación 78 89",
     *                      type = "number"
     *                  ),
     *                  @OA\Property(
     *                      property = "agreed_bonus",
     *                      description = "Bonificación Acordado Pactada",
     *                      type = "number"
     *                  ),
     *                  @OA\Property(
     *                      property = "user_id",
     *                      description = "Identificación del usuario",
     *                      type = "number"
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *      response=201,
     *      description="Crear un recurso de Salario",
     *     ),
     *     @OA\Response(
     *         response="500",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(Salario::$rules);

        $salario = Salario::create($request->all());

        return response()->json($salario, Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/salario/{id}",
     *     description="Get a Salary for the id",
     *     tags={"Salarios"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id for salary",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener un Salario",
     *      )
     * )
     */
    public function show(int $id)
    {
        $salario = Salario::find($id);

        return response()->json($salario, Response::HTTP_OK);
    }


    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/salario/usuario/{id}",
     *     description="Get salary information by ID",
     *     tags={"Salarios"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener la información salarios por su id",
     *      )
     * )
     */
    public function showByUserId(int $id){
        $salario = Salario::selectRaw('id,CONCAT("Q. ",salary) as salary,CONCAT("Q. ",bonus) as bonus,CONCAT("Q. ",agreed_bonus) as agreed_bonus,user_id, DATE_FORMAT(created_at, "%d/%m/%Y") as registration_date,CONCAT("Q. ",(salary+bonus+agreed_bonus)) as total')->where(['user_id' => $id])->get();

        return response()->json($salario, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Salario $salario
     * @param $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/salario/{id}",
     *     description="Update an employee's salary",
     *     tags={"Salarios"},
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
     *                      property = "salary",
     *                      description = "Salario",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "bonus",
     *                      description = "Bonificación 78 89",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "agreed_bonus",
     *                      description = "Bonificación Pactada",
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
     *     response=201,
     *     description="Actualizar un Salario de Empleado",
     * ),
     * )
     */

    public function update(Request $request, Salario $salario, $id)
    {
        request()->validate(Salario::$rules);

        $salario->find($id)->update($request->all());

        return response()->json($salario, Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/salario/{id}",
     *     description="Delete a single salary's on the ID supplied",
     *     tags={"Salarios"},
     *     @OA\Parameter (
     *      description = "ID of salary to delete",
     *      in = "path",
     *      name = "id",
     *      required = true,
     *     ),
     *     @OA\Response(
     *     response=204,
     *     description="Eliminar un Salario",
     * )
     * )
     */
    public function destroy($id)
    {
        $salario = Salario::find($id)->delete();

        return response()->json($salario, Response::HTTP_OK);
    }
}
