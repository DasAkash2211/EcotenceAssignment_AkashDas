@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




<div class="container">

    <div class="card">

    <div class="card-header">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Add New task</h2>
                </div>
             
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
    <form action="{{ route('jobs.store') }}" method="POST">
    	@csrf

         <div class="row">
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Title:</strong>
		            <input type="text" name="title" class="form-control" placeholder="Title" required id="textInput" maxlength="100">
		            <input type="hidden" name="created_by" class="form-control" value="{{auth::user()->id}}">
		            <input type="hidden" name="updated_by" class="form-control" value="{{auth::user()->id}}">
		            <input type="hidden" name="status" class="form-control" value="Processing">


                  
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12">
		        <div class="form-group">
		            <strong>Description:</strong>
		            <textarea class="form-control" style="height:150px" name="description" placeholder="Add Description"></textarea>
		        </div>
		    </div>
		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		            <button type="submit" class="btn btn-success">Submit</button>
		    </div>
		</div>

    </form>
    </div>
</div>
</div>

   <script>
        var textInput = document.getElementById('textInput');

        textInput.addEventListener('input', function() {
            var remainingCharacters = 100 - textInput.value.length;

            if (remainingCharacters == 0) {
                // Display SweetAlert when character limit is exceeded

                alert('Exceeded');
                Swal({
                    icon: 'error',
                    title: 'Character Limit Exceeded',
                    text: 'Please enter a maximum of 100 characters.',
                });

                // Trim the input value to 100 characters
                textInput.value = textInput.value.substring(0, 100);
            }

            // Optionally, you can log the remaining characters
            console.log('Remaining characters: ' + remainingCharacters);
        });
    </script>
   

@endsection