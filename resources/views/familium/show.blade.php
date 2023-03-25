@extends('layouts.app')

@section('template_title')
    {{ $familium->name ?? 'Show Familium' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Familium</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('familia.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Full Name:</strong>
                            {{ $familium->full_name }}
                        </div>
                        <div class="form-group">
                            <strong>Gender:</strong>
                            {{ $familium->gender }}
                        </div>
                        <div class="form-group">
                            <strong>Date Of Birth:</strong>
                            {{ $familium->date_of_birth }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $familium->user_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
