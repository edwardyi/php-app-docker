@csrf
<div class="form-group">
    <label for="name">Name</p>
    <input class="form-control" type="text" name="name" value="{{ old('name') ?? $customer->name }}" />
    <div>{{ $errors->first('name') }}</div>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input class="form-control" type="text" name="email" value="{{ old('name') ?? $customer->email }}" />
    <div>{{ $errors->first('email') }}</div>
    <!-- <input type="submit" name="submit" value="submit" /> -->
</div>
<div class="form-group">
    <label for="random">Random</label>
    <input class="form-control" type="text" name="random" value=""/>
    <div>{{$errors->first('random')}}</div>
</div>
<div class="form-group">
    <label for="status">Status</label>
    <select id="active" name="active" class="form-control">
        <option value="" disabled="disabled">Please Select Status</option>
        @foreach($customer->getActiveOptions() as $optionKey => $optionValue)
            <option value="{{$optionKey}}" {{(old($optionValue) ?? $customer->active) == $optionValue ? "selected": ""}}>{{$optionValue}}</option>
        @endforeach
    </select>
    <div>{{$errors->first('active')}}</div>
</div>
<div class="form-group">
    <label for="company">Company</label>
    <select name="company_id" class="form-control">
        <option disabled="disabled" value="">Please Select Company</option>
        @foreach($companies as $company)
            <option value="{{$company->id}}" {{$customer->company_id == $company->id ? "selected": ""}}> {{$company->name}} </option>
        @endforeach
    </select>

    <div>{{$errors->first('company_id')}}</div>
</div>

<div class="form-group d-flex flex-column">
    <label for="image">Image</label>
    <input type="file" name="image" />
    <div>{{$errors->first('image')}}</div>
</div>