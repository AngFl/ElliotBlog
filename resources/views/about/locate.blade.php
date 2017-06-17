@extends('docker');

@section('content')
    <p style="margin-top: 100px;"></p>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon1">@</span>
        <input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1">
    </div>


    <label for="basic-url">Your vanity URL</label>
    <div class="input-group">
        <span class="input-group-addon" id="basic-addon3">https://example.com/users/</span>
        <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3">
    </div>

    {!! csrf_field() !!}
@stop