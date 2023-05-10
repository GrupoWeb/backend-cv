@extends('layouts.app')

@section('template_title')
    Money Loan
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Money Loan') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('money-loans.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Description</th>
										<th>Loan Amount</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($moneyLoans as $moneyLoan)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $moneyLoan->description }}</td>
											<td>{{ $moneyLoan->loan_amount }}</td>
											<td>{{ $moneyLoan->user_id }}</td>

                                            <td>
                                                <form action="{{ route('money-loans.destroy',$moneyLoan->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('money-loans.show',$moneyLoan->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('money-loans.edit',$moneyLoan->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $moneyLoans->links() !!}
            </div>
        </div>
    </div>
@endsection
