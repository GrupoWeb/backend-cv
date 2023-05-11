<?php

namespace App\Http\Controllers;

use App\Models\WorkAbsence;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class WorkAbsenceController
 * @package App\Http\Controllers
 */
class WorkAbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $workAbsences = WorkAbsence::selectRaw('id, faltas_id, sanciones_id, description, date_format(due_date,"%d/%m/%Y ") as due_date, date_format(created_at,"%d/%m/%Y ")  as fecha_creada')->get();

        return response()->json($workAbsences, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        request()->validate(WorkAbsence::$rules);

        return response()->json(WorkAbsence::create($request->all()), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id)
    {
        $workAbsence = WorkAbsence::find($id);

        return response()->json($workAbsence,Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  WorkAbsence $workAbsence
     * @param int $id
     * @return Response
     */
    public function update(Request $request, WorkAbsence $workAbsence, int $id)
    {
        request()->validate(WorkAbsence::$rules);

        $workAbsence->find($id)>update($request->all());

        return response()->json('Actualizado correctamente',Response::HTTP_OK);
    }

    /**
     * @param int $id
     * @return Response
     */
    public function destroy(int $id)
    {
        $workAbsence = WorkAbsence::find($id)->delete();

        return response()->json($workAbsence,Response::HTTP_OK);
    }


    public function showByUserId(int $id){
        $moneyLoan = WorkAbsence::selectRaw('work_absences.id, faltas.description as falta, sanciones.description as sancion, work_absences.description, date_format(work_absences.due_date,"%d/%m/%Y ") as due_date, date_format(work_absences.created_at,"%d/%m/%Y") as fecha_creada,CASE WHEN GREATEST(TIMESTAMPDIFF(DAY, NOW(), work_absences.due_date),0) = 0 THEN CONCAT(GREATEST(TIMESTAMPDIFF(DAY, NOW(), work_absences.due_date),0), " días") WHEN GREATEST(TIMESTAMPDIFF(DAY, NOW(), work_absences.due_date),0) = 1 THEN CONCAT(GREATEST(TIMESTAMPDIFF(DAY, NOW(), work_absences.due_date),0), " día") ELSE CONCAT(GREATEST(TIMESTAMPDIFF(DAY, NOW(), work_absences.due_date),0), " días") END as dias, IF(NOW() <= work_absences.due_date, "Vigente", "No vigente") AS vigente')
            ->join('faltas','faltas.id','=','work_absences.faltas_id')
            ->join('sanciones','sanciones.id','=','work_absences.sanciones_id')
            ->where(['work_absences.user_id' => $id])
            ->withTrashed()
            ->orderByDesc('id')
            ->get();

        return response()->json($moneyLoan, Response::HTTP_OK);
    }
}
