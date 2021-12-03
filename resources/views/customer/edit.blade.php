@extends('layouts.app')

@section('title', 'Edit A Customer For '.$customer->name)

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Edit A Customer {{$customer->name}}</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="/customers/{{$customer->id}}" method="POST">
            @method('PATCH')
            @include('customer.form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection