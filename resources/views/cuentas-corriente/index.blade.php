@extends('layouts.app')

@section('template_title')
    Cuentas Corriente
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cuentas Corriente') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('cuentas-corrientes.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Title</th>
										<th>Parent Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cuentasCorrientes as $cuentasCorriente)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $cuentasCorriente->title }}</td>
											<td>{{ $cuentasCorriente->parent_id }}</td>

                                            <td>
                                                <form action="{{ route('cuentas-corrientes.destroy',$cuentasCorriente->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('cuentas-corrientes.show',$cuentasCorriente->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('cuentas-corrientes.edit',$cuentasCorriente->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $cuentasCorrientes->links() !!}
            </div>
        </div>
    </div>
@endsection
