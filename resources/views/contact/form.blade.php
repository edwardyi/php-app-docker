@extends('layouts.app')

@section('title', 'contact form')

@section('content')

<div class="row">
    <div class="row-12">
        <h1>Contact</h1>
    </div>
</div>

@if(!Session::has('message'))

<div class="row">
    <div class="col-12">
        <form action="/contact" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" name="name" value="{{old('name')}}" />

                <span>{{$errors->first('name')}}</span>
            </div>
    
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{old('email')}}" />

                <span>{{$errors->first('email')}}</span>
            </div>
    
            <div class="form-group">
                <label>Message</label>
                <textarea class="form-control" name="message" cols="20" rows="10">{{old('message')}}</textarea>

                <span>{{$errors->first('message')}}</span>
            </div>
    
            <button type="submit" class="btn btn-primary my-3">Send</button>
        </form>
    </div>
</div>
@endif

@endsection