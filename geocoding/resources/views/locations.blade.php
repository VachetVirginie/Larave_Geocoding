@extends('layout')


@section('content')

<div class="container center">

<div id="map"></div>

@if(isset($points))
    @foreach($points as $point)
        <p><strong>{{$point->name}}</strong> : {{$point->address}}</p>
    @endforeach
@endif

</div>

@stop