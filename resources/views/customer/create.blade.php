@extends('layout')

@section('title', 'Create A Customer')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Create A Customer</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="/customers" method="POST">
            @include('customer.form')
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>
@endsection