<?php

namespace App\Http\Controllers;

use App\Models\MoneyLoan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MoneyLoanController
 * @package App\Http\Controllers
 */
class MoneyLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/prestamo",
     *     description="obtiene todos los registros",
     *     tags={"Prestamos"},
     *     @OA\Response(
     *          response=200,
     *          description="Listado de general"
     *      ),
     *     @OA\Response(
     *         response="default",
     *         description="datos generales"
     *     ),
     * )
     */
    public function index()
    {
        $moneyLoans = MoneyLoan::with('user')->get();
        return response()->json($moneyLoans, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/pretamo",
     *     description="Guarda la información",
     *     tags={"Prestamos"},
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
     *                  @OA\Property(
     *                      property = "loan_amount",
     *                      description = "Cantidad",
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
     *      description="Crear dato",
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(MoneyLoan::$rules);
        $moneyLoan = MoneyLoan::create($request->all());
        return response()->json($moneyLoan, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/prestamo/{id}",
     *     description="Obtener un dato",
     *     tags={"Prestamos"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener registros",
     *      )
     * )
     */
    public function show(int $id)
    {
        $moneyLoan = MoneyLoan::find($id);

        return response()->json($moneyLoan, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param MoneyLoan $moneyLoan
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/puesto/{id}",
     *     description="Actualizar un registro",
     *     tags={"Prestamos"},
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
     *                  @OA\Property(
     *                      property = "loan_amount",
     *                      description = "Cantidad",
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
     *     response=201,
     *     description="Actualizar un registro",
     * ),
     * )
     */
    public function update(Request $request, MoneyLoan $moneyLoan, int $id)
    {
        request()->validate(MoneyLoan::$rules);

        $moneyLoan->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Delete (
     *     path="/api/prestamo/{id}",
     *     description="Elimina un registro",
     *     tags={"Prestamos"},
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
        $moneyLoan = MoneyLoan::find($id)->delete();

        return response()->json($moneyLoan,Response::HTTP_OK);
    }


    /**
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/prestamo/usuario/{id}",
     *     description="Obtener los registros",
     *     tags={"Prestamos"},
     *     @OA\Parameter (
     *      name="id",
     *      in="path",
     *      description="id",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener la información",
     *      )
     * )
     */

    public function showByUserId(int $id){
        $moneyLoan = MoneyLoan::selectRaw('id,CONCAT("Q. ",loan_amount) as loan_amount, description, CASE WHEN deleted_at IS NULL THEN "Activo" ELSE "Inactivo" END as active')
            ->where(['user_id' => $id])
            ->withTrashed()
            ->orderByDesc('id')
            ->get();

        return response()->json($moneyLoan, Response::HTTP_OK);
    }
}
