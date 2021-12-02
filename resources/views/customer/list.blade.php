@extends('layout')

@section('title', 'Customer List')

@section('content')

<div class="row">
    <div class="col-12">
        <h1>Customer List</h1>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="/customers" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</p>
                <input class="form-control" type="text" name="name" value="{{ old('name') }}" />
                <div>{{ $errors->first('name') }}</div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="text" name="email" value="{{ old('email') }}" />
                <div>{{ $errors->first('email') }}</div>
                <!-- <input type="submit" name="submit" value="submit" /> -->
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</div>
<hr>

<div class="row">
    <div class="col-12">
        <ul>
            @foreach($customers as $customer)
                <li>
                    {{ $customer->name }}<span class="text-muted">({{ $customer->email }})</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

@endsection