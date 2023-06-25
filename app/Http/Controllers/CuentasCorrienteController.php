<?php

namespace App\Http\Controllers;

use App\Models\CuentasCorriente;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportAccount;

/**
 * Class CuentasCorrienteController
 * @package App\Http\Controllers
 */
class CuentasCorrienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/accounts",
     *     description="Obtener todas las cuentas corrientes",
     *     tags={"Cuentas"},
     *     @OA\Response(
     *     response=200,
     *     description="Éxito"
     * ),
     * )
     */
    public function index()
    {

        $cuentasContables = CuentasCorriente::whereNull('parent_id')
            ->with('children', 'children.children', 'children.children.children','children.children.children.children')
            ->get();

        return response()->json($cuentasContables, Response::HTTP_OK);

    }

    /**
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/accounts/parent",
     *     description="Get all Accounts Parent",
     *     tags={"Cuentas"},
     *     @OA\Response(
     *     response=200,
     *     description="Listado de cuentas contables"
     * ),
     * )
     */
    public function CuentasPadres(){
        $cuentasCorrientes = CuentasCorriente::select('id as value','title as label')->get();
        return response()->json($cuentasCorrientes, Response::HTTP_OK);
    }


    public function cuentaByNivel(Request $request){
        return response()->json(CuentasCorriente::select('id as value', 'title as text')->where(['nivel' =>  $request->level])->get(),Response::HTTP_OK);
    }

    public function cuentaByParentId(Request $request){
        return response()->json(CuentasCorriente::select('id as value', 'title as text')->where(['parent_id' => $request->parent_id])->get(), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */

    /**
     * @OA\Post (
     *     path="/api/accounts",
     *     description="Store a newly created resource in database",
     *     tags={"Cuentas"},
     *     @OA\RequestBody(
     *     required = true,
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema (
     *                  @OA\Property(
     *                      property = "codigo",
     *                      description = "codigo de la cuenta",
     *                      type = "integer"
     *                  ),
     *                  @OA\Property(
     *                      property = "title",
     *                      description = "Nombre de la cuenta",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "nivel",
     *                      description = "nivel de la cuenta",
     *                      type = "integer",
     *                  ),
     *                  @OA\Property(
     *                      property = "principal",
     *                      description = "Si es principal o no",
     *                      type = "boolean",
     *                  ),
     *                  @OA\Property(
     *                      property = "estilo",
     *                      description = "Negrita o simple",
     *                      type = "string",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *      response=201,
     *      description="Crear una cuenta",
     *     )
     * )
     */
    public function store(Request $request)
    {
        request()->validate(CuentasCorriente::$rules);

        $cuentas = CuentasCorriente::create($request->all());

        return response()->json($cuentas, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */

    /**
     * @OA\Get (
     *     path="/api/accounts/{account}",
     *     description="Get one Accounts",
     *     tags={"Cuentas"},
     *     @OA\Parameter (
     *      name="account",
     *      in="path",
     *      description="id account",
     *      required=true,
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Obtener una cuenta",
     *      )
     * )
     */
    public function show($id)
    {
        $cuentasCorriente = CuentasCorriente::find($id);
        return response()->json($cuentasCorriente,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  CuentasCorriente $cuentasCorriente
     * @param int $id
     * @return Response
     */

    /**
     * @OA\Put (
     *     path="/api/accounts/{account}",
     *     description="Update one Account",
     *     tags={"Cuentas"},
     *     @OA\Parameter (
     *          name="account",
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
     *                      property = "title",
     *                      description = "title for account",
     *                      type = "string",
     *                  ),
     *                  @OA\Property(
     *                      property = "parent_id",
     *                      description = "Id del Padre",
     *                      type = "integer",
     *                  ),
     *              ),
     *          ),
     *     ),
     *     @OA\Response(
     *     response=201,
     *     description="Actualizar una cuenta",
     * ),
     * )
     */
    public function update(Request $request, CuentasCorriente $cuentasCorriente, $id)
    {
        request()->validate(CuentasCorriente::$rules);

        $cuentasCorriente->find($id)->update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);

    }

    /**
     * @param int $id
     * @return Illuminate\Http\RedirectResponse
     * @throws Exception
     */

    /**
     * @OA\Delete (
     *     path="/api/accounts/{account}",
     *     description="Delete a single account on the ID supplied",
     *     tags={"Cuentas"},
     *     @OA\Parameter (
     *      description = "ID of account to delete",
     *      in = "path",
     *      name = "account",
     *      required = true,
     *     ),
     *     @OA\Response(
     *     response=204,
     *     description="Eliminar una cuenta",
     * )
     * )
     */
    public function destroy($id)
    {
        $cuentasCorriente = CuentasCorriente::find($id)->delete();

        return response()->json($cuentasCorriente,Response::HTTP_OK);
    }

    /**
     * Download Excel file
     *
     * @return BinaryFileResponse
     */

    /**
     * @OA\Get (
     *     path="/api/accounts/export",
     *     description="Download Excel File",
     *     tags={"Cuentas"},
     *     @OA\Response(
     *     response=200,
     *     description="Listado de cuentas contables",
     *      @OA\MediaType(
     *          mediaType = "application/vnd.ms-excel"
     *       ),
     *      ),
     * )
     */

    public function exportExcel()
    {
        return Excel::download(new ExportAccount, 'CuentasContables.xlsx');
    }

}
