@extends('layouts.app')

@section('template_title')
    Create Cuentas Corriente
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Cuentas Corriente</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cuentas-corrientes.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('cuentas-corriente.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
