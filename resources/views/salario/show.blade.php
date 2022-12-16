@extends('layouts.app')

@section('template_title')
    {{ $salario->name ?? 'Show Salario' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Salario</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('salarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Salary:</strong>
                            {{ $salario->salary }}
                        </div>
                        <div class="form-group">
                            <strong>Bonus:</strong>
                            {{ $salario->bonus }}
                        </div>
                        <div class="form-group">
                            <strong>Agreed Bonus:</strong>
                            {{ $salario->agreed_bonus }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $salario->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
