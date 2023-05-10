<?php

namespace App\Http\Controllers;

use App\Models\WorkAbsence;
use Illuminate\Http\Request;

/**
 * Class WorkAbsenceController
 * @package App\Http\Controllers
 */
class WorkAbsenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workAbsences = WorkAbsence::paginate();

        return view('work-absence.index', compact('workAbsences'))
            ->with('i', (request()->input('page', 1) - 1) * $workAbsences->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $workAbsence = new WorkAbsence();
        return view('work-absence.create', compact('workAbsence'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(WorkAbsence::$rules);

        $workAbsence = WorkAbsence::create($request->all());

        return redirect()->route('work-absences.index')
            ->with('success', 'WorkAbsence created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $workAbsence = WorkAbsence::find($id);

        return view('work-absence.show', compact('workAbsence'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $workAbsence = WorkAbsence::find($id);

        return view('work-absence.edit', compact('workAbsence'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  WorkAbsence $workAbsence
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WorkAbsence $workAbsence)
    {
        request()->validate(WorkAbsence::$rules);

        $workAbsence->update($request->all());

        return redirect()->route('work-absences.index')
            ->with('success', 'WorkAbsence updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $workAbsence = WorkAbsence::find($id)->delete();

        return redirect()->route('work-absences.index')
            ->with('success', 'WorkAbsence deleted successfully');
    }
}
