@extends('layouts.app')

@section('template_title')
    Create Money Loan
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Money Loan</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('money-loans.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('money-loan.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
