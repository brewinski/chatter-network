@extends('layout.master')

@section('title')
Chatter
@stop

@section('jumbotron')
<div class="row">
  <div class="col-md-6">
    <h1>Welcome to Chatter</h1>
    <h1><small>Tell us what's on your mind. Make your first post today.</small></h1>
  </div>
  <div class="col-md-6">
    <!---------------------------------------- Post-Form ----------------------------------> 

    <!---------------------------------------- End Post-Form ---------------------------------->
  </div> 
</div>
@stop
@section('content')
<div class="container" id="post-container">
  <p>I was able to complete all the task's except the uploading images task. I ran out of time.</p>
  <img src="{{URL::asset('images/User.png')}}" />
</div>
@stop