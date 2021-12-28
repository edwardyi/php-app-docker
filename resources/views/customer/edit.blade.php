@extends('layouts.app')

@section('title', 'Edit A Customer For '.$customer->name)

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Edit A Customer {{$customer->name}}</h1>
    </div>
</div>

<a class="btn btn-primary" href="{{route('test.odd.page')}}">test Odd Page</a>
<a class="btn btn-secondary" href="{{route('test.odd.page', ["customer_id" => $customer->id])}}">test route Passing argument</a>
<a class="btn btn-success" href={{action([App\Http\Controllers\CustomerController::class, 'edit'], ['customer' => $customer->id])}}>test action Passing argument</a>
<a class="btn btn-error" href={{url("/customers/$customer->id/edit")}}>test url Passing argument</a>


<div class="row">
    <div class="col-12">
        <form action="/customers/{{$customer->id}}" method="POST" enctype="multipart/form-data">
            @method('PATCH')
            @include('customer.form')
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>
@endsection