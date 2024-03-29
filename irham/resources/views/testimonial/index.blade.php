@extends('testimonial.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>List Testimonial</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('testimonial.create') }}"> Create New Testimonial</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <br>
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Testimonial</th>
            <th>Date submitted</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($testimonials as $testimonial)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $testimonial->testimonial }}</td>
            <td>{{ $testimonial->created_at }}</td>
            <td>
                <form action="{{ route('testimonial.destroy',$testimonial->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('testimonial.show',$testimonial->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('testimonial.edit',$testimonial->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>   
@endsection