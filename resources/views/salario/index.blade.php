@extends('layouts.app')

@section('template_title')
    Salario
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Salario') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('salarios.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Salary</th>
										<th>Bonus</th>
										<th>Agreed Bonus</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($salarios as $salario)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $salario->salary }}</td>
											<td>{{ $salario->bonus }}</td>
											<td>{{ $salario->agreed_bonus }}</td>
											<td>{{ $salario->user_id }}</td>

                                            <td>
                                                <form action="{{ route('salarios.destroy',$salario->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('salarios.show',$salario->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('salarios.edit',$salario->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $salarios->links() !!}
            </div>
        </div>
    </div>
@endsection
