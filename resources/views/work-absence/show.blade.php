@extends('layouts.app')

@section('template_title')
    {{ $workAbsence->name ?? 'Show Work Absence' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Work Absence</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('work-absences.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Lack:</strong>
                            {{ $workAbsence->lack }}
                        </div>
                        <div class="form-group">
                            <strong>Sanction:</strong>
                            {{ $workAbsence->sanction }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $workAbsence->description }}
                        </div>
                        <div class="form-group">
                            <strong>Due Date:</strong>
                            {{ $workAbsence->due_date }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $workAbsence->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
