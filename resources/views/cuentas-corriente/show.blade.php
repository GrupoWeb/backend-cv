@extends('layouts.app')

@section('template_title')
    {{ $cuentasCorriente->name ?? 'Show Cuentas Corriente' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cuentas Corriente</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('cuentas-corrientes.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title:</strong>
                            {{ $cuentasCorriente->title }}
                        </div>
                        <div class="form-group">
                            <strong>Parent Id:</strong>
                            {{ $cuentasCorriente->parent_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
