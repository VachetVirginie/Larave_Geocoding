@extends('layout')


@section('content')

<div class="container center">

@if(Session::has('success'))

    <div class="alert alert-success">{{Session::get('success')}}</div>

@endif

<form action="{{url('add')}}" method="post">
{{csrf_field()}}
    <div class="form-group">
        <label for="address">Entrez une adresse</label>
        <input type="text" class="form-control" name="address" id="address" placeholder="Adresse">
        @if($errors->has('address'))
        <span class="label label-danger">{{$errors->first('address')}}</span>
        @endif
    </div>

    <div class="form-group">
    <input type="submit" class="btn btn-primary" value="Envoyer">
    </div>
</form>

</div>

@stop