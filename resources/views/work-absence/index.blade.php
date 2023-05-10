@extends('layouts.app')

@section('template_title')
    Work Absence
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Work Absence') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('work-absences.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
										<th>Lack</th>
										<th>Sanction</th>
										<th>Description</th>
										<th>Due Date</th>
										<th>User Id</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($workAbsences as $workAbsence)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $workAbsence->lack }}</td>
											<td>{{ $workAbsence->sanction }}</td>
											<td>{{ $workAbsence->description }}</td>
											<td>{{ $workAbsence->due_date }}</td>
											<td>{{ $workAbsence->user_id }}</td>

                                            <td>
                                                <form action="{{ route('work-absences.destroy',$workAbsence->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('work-absences.show',$workAbsence->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('work-absences.edit',$workAbsence->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
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
                {!! $workAbsences->links() !!}
            </div>
        </div>
    </div>
@endsection
