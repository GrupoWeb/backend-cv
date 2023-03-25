@extends('layouts.app')

@section('template_title')
    {{ $telefono->name ?? 'Show Telefono' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Telefono</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('telefonos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Number:</strong>
                            {{ $telefono->number }}
                        </div>
                        <div class="form-group">
                            <strong>Tipo Telefono Id:</strong>
                            {{ $telefono->tipo_telefono_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $telefono->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
