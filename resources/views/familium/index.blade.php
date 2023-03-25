@extends('layouts.app')

@section('template_title')
    Familium
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Familium') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('familia.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Full Name</th>
										<th>Gender</th>
										<th>Date Of Birth</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($familia as $familium)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $familium->full_name }}</td>
											<td>{{ $familium->gender }}</td>
											<td>{{ $familium->date_of_birth }}</td>
											<td>{{ $familium->user_id }}</td>

                                            <td>
                                                <form action="{{ route('familia.destroy',$familium->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('familia.show',$familium->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('familia.edit',$familium->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $familia->links() !!}
            </div>
        </div>
    </div>
@endsection
