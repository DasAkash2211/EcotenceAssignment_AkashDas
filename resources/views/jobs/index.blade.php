@extends('layouts.app')

@section('content')
<div class="container">






    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="card">

        <div class="card-header">
            <div class="row">
                <div class="col-lg-4 margin-tb">
                    <div class="pull-right">
                        <h2>Tasks</h2>
                    </div>
                </div>
                <div class="col-md-6">
                 

                    <div class="row">
                        <div class="col-sm-6">
                            <form class="form-inline" type="get" action="{{ url('/jobs') }}">
                        
                          <div class="input-group date" id="reservationdate" data-target-input="nearest">
                              <input type="date" class="form-control datetimepicker-input" placeholder="Search by date" name="ser" data-target="#reservationdate"/>
                              <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                              </div>
                              <button class="btn btn-info" type="submit">
                                <i class="fas fa-search" style="color: white;"></i>
                            </button>
                          </div>
                            </form>
                          
                        </div>
                        
                      </div>


                </div>
                <div class="col-md-2">
                    <div class="pull-right">
                        @can('task-create')
                        <a class="btn btn-primary btn-sm" href="{{ route('jobs.create') }}"> Add New +</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>

    <div class="card-body">

    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Title</th>
            <th>Created At</th>
            <th width="180px">Action</th>
        </tr>
	    @foreach ($tasks as $task)
	    <tr>
	        <td>{{ ++$i }}</td>
	        <td>{{ $task->title }}</td>
	        <td> {{ Carbon\Carbon::parse($task->created_at)->format('Y-m-d') }}</td>
	        <td>
                <form action="{{ route('jobs.destroy',$task->id) }}" method="POST">
                    <a class="btn btn-info btn-sm" href="{{ route('jobs.show',$task->id) }}" style="width: 40px;"><i class="fa fa-eye"></i></a>
                    @can('task-edit')
                    <a class="btn btn-primary btn-sm" href="{{ route('jobs.edit',$task->id) }}" style="width: 40px;"><i class="fa fa-edit"></i></a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('task-delete')
                    <button type="submit" class="btn btn-danger btn-sm" style="width: 40px;"><i class="fa fa-trash"></i></button>
                    @endcan
                </form>
	        </td>
	    </tr>
	    @endforeach
    </table>
    </div>
</div>
</div>
    {!! $tasks->links() !!}

@endsection