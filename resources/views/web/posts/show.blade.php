@extends('web.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">{{ $post->title }}</h1>
            </div>
            <div class="col-lg-12">
                {!! $post->description !!}
            </div>
        </div>
        <br><br>
        <h3>List Of Comments:</h3>
        @include('web.includes.comment', ['comments' => $comments])
    </div>
    <div class="container-fluid">
        <div class="card-body">
            <h5>Leave a comment</h5>
            <form method="post" action="{{ route('comments.store',$post->id) }}">
                @csrf
                <div class="form-group col-md-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="form-group col-md-9">
                    <label>Comment</label>
                    <input type="text" name="comment" class="form-control" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-sm btn-outline-danger py-0" style="font-size: 0.8em;" value="Add Comment" />
                </div>
            </form>
        </div>
    </div>
@endsection
