@extends('layout.master')

@section('title')
Chatter - Signup
@stop

@section('jumbotron')
<div class="row">
  <div class="col-md-6">
    <h1>Welcome to Chatter</h1>
    <h1><small><button class="btn btn-primary">Sign Up, Start Posting Today!</button></small></h1>
  </div>
  <div class="col-md-6">
    <!---------------------------------------- Post-Form ----------------------------------> 
    {{Form::model($user, array('method' => 'PUT', 'route' => array('user.update', $user->id), 'class' => 'form-horizontal'))}}
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::text('username', null,['class' => 'form-control', 'placeholder' => 'Create Username']) }} 
        @if($errors->first('username'))
        <div class="btn btn-danger"> {{$errors->first('username')}} </div>
        @endif
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::text('first_name', null,['class' => 'form-control', 'placeholder' => 'First Name']) }} 
        @if($errors->first('first_name'))
        <div class="btn btn-danger"> {{$errors->first('first_name')}} </div>
        @endif
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::text('last_name', null,['class' => 'form-control', 'placeholder' => 'Last Name']) }} 
        @if($errors->first('last_name'))
        <div class="btn btn-danger"> {{$errors->first('last_name')}} </div>
        @endif
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::submit('Create', array('class' => 'btn btn-danger')) }}
      </div>
    </div>
    {{ Form::close() }}
    <!---------------------------------------- End Post-Form ---------------------------------->
  </div> 
</div>
@stop