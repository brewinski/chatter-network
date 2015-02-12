@extends('layout.master')

@section('title')
Chatter - Login
@stop

@section('jumbotron')
<div class="row" style="height: 85vh; padding-top: 25%">
  <div class="col-md-6">
    <h1>Welcome to Chatter</h1>
    <h1><small><button class="btn btn-primary">Login Here ---></button></small></h1>
  </div>
  <div class="col-md-6">
    <!---------------------------------------- Post-Form ----------------------------------> 
    {{ Form::open(array('action' => 'UserController@login', 'class' => 'form-horizontal', 'id' => 'post-form')) }}
    @if($errors->first('invalid'))
    <div class="btn btn-danger"> {{$errors->first('invalid')}} </div>
    @endif
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::text('username', null,['class' => 'form-control', 'placeholder' => 'email address']) }} 
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'password']) }} 
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::submit('Login', array('class' => 'btn btn-danger')) }}
      </div>
    </div>
    {{ Form::close() }}
    <!---------------------------------------- End Post-Form ---------------------------------->
  </div> 
</div>
@stop