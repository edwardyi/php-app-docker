@extends('layout')

@section('content')

<h1>Customer List</h1>

<form action="/customers" method="POST" class="pb-5">
    @csrf
    <p>Name:</p>
    <input class="input-group" type="text" name="name" value="{{ old('name') }}" />
    <div>{{ $errors->first('name') }}</div>
    <p>Email:</p>
    <input class="input-group" type="text" name="email" value="{{ old('email') }}" />
    <div>{{ $errors->first('email') }}</div>
    <button type="submit">Submit</button>
    <!-- <input type="submit" name="submit" value="submit" /> -->
</form>

<ul>
    @foreach($customers as $customer)
        <li>
            {{ $customer->name }}<span class="text-muted">({{ $customer->email }})</span>
        </li>
    @endforeach
</ul>

@endsection