@extends('layout.master')

@section('title')
Chatter
@stop

@section('jumbotron')
<div class="row">
  @include('partial.welcome')
</div>
@stop
@section('content')
<div class="container" id="post-container">
@foreach($users as $user)
  @include('partial.user_object')
@endforeach
</div>

@stop

