@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{route('publish.image.page') }}" method="POST" class="form-data" enctype="multipart/form-data">
                       {{csrf_field()}}
                        <input class="form-control" type="text" name="message" id="">
                        <input class="form-control"  type="file" name="photo" >
                        <!-- <input class="form-control"  type="text" name="link" value="https://images.pexels.com/photos/248797/pexels-photo-248797.jpeg?auto=compress&cs=tinysrgb&h=350"> -->
                        <button class="btn btn-primary btn-small" type="submit">Get message</button>
                    </form> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
