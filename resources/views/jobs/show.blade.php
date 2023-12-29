@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-lg-12 margin-tb">
                    <div class="pull-left">
                        <h2>Task Details</h2>
                    </div>
                    {{-- <div class="pull-right">
                        <a class="btn btn-primary" href="{{ route('tasks.index') }}"> Back</a>
                    </div> --}}
                </div>
            </div>
        
        </div>


    @if ($errors->any()) 
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Something went wrong.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card-body">

    <form action="{{ route('jobs.update',$job->id) }}" method="POST">
    	@csrf
        @method('PUT')

         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Name:</strong>
		            <input type="text" name="title" value="{{ $job->title }}" class="form-control" placeholder="Name" readonly>
                    <input type="hidden" name="updated_by" value="{{Auth::user()->id}}">
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Detail:</strong>
		            <textarea class="form-control" style="height:150px" name="description" placeholder="Detail" readonly>{{ $job->description }}</textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>


    </form>
</div>
</div>
</div>
@endsection