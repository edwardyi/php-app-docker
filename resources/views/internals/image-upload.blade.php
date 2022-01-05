@extends('layouts.app')

@section('title', 'Image Upload')

@section('content')

<div class="flex-center position-ref full-height" id="app">
    <image-upload></image-upload>
</div>

<div class="container">
    <div class="row">
        @foreach($images as $image)
            <div class="col-2 mb-4">
                <a href="{{$image->original}}">
                    <img src="{{$image->thumbnail}}" class="w-100" />
                </a>

                <form action="/upload-image/{{$image->id}}" method="POST">
                    @method("DELETE")
                    @csrf
                    <button class="small btn btn-outline-danger mt-2" type="submit">delete</button>
                </form>
            </div>
        @endforeach
    </div>
</div>
@endsection