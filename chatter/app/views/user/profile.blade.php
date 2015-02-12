@extends('layout.master')

@section('title')
Chatter
@stop

@section('jumbotron')
@if(Auth::check())
<div class="col-md-6">
  <h1>{{{$user->first_name}}} {{{$user->last_name}}} </h1>
  <h1><small>Age: {{{$user->age}}}</small></h1>
  @if(Auth::user()->id == $user->id)
  {{ Form::open(array('method' => 'GET', 'route' => array('user.edit', Auth::user()->id))) }}
  <button type="submit" class="btn btn-danger "><span class="glyphicon glyphicon-edit"></span> Edit Profile</button>
  {{ Form::close() }}
  {{ Form::open(array('route' => array('user.get_friends', $user->id))) }}
  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Friends</button>
  {{ Form::close() }}
  @else
  {{ Form::open(array('route' => array('user.get_friends', $user->id))) }}
    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Friends</button>
  {{ Form::close() }}
  @if($user->friends == true)
  {{ Form::open(array('route' => array('user.remove_friend', $user->id))) }}
  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon glyphicon glyphicon-user"><span class="glyphicon glyphicon glyphicon-plus"></span></span> Un-Friend</button>
  {{ Form::close() }}
  @else
  {{ Form::open(array('route' => array('user.add_friend', $user->id))) }}
  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon glyphicon glyphicon-user"><span class="glyphicon glyphicon glyphicon-plus"></span></span> Add Friend</button>
  {{ Form::close() }}
  @endif

  @endif
</div>
<div class="col-md-6">
  <!---------------------------------------- Post-Form ----------------------------------> 
  @if(Auth::user()->id == $user->id)
  {{ Form::open(array('action' => 'PostController@store', 'class' => 'form-horizontal', 'id' => 'post-form')) }}
  <div class="form-group">
    <div class="col-sm-8">
      {{ Form::text('title', null,['class' => 'form-control', 'placeholder' => 'Title']) }}
      @if($errors->first('title'))
      <div class="btn btn-danger"> {{$errors->first('title')}} </div>
      @endif
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-8">
      {{ Form::textarea('message', null, ['class' => 'form-control', 'size' => '0x5', 'placeholder' => 'Enter Message Here......']) }}
      @if($errors->first('message'))
      <div class="btn btn-danger"> {{$errors->first('message')}} </div>
      @endif
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8">
      <h2><small>public{{ Form::radio('status', 'public', true) }}
      friends only{{ Form::radio('status', 'friends') }}
        private{{ Form::radio('status', 'private') }}</small></h2>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8">
      {{ Form::submit('Submit Post', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
  {{ Form::close() }}
  @endif
  <!---------------------------------------- End Post-Form ---------------------------------->
</div> 
@else
<div class="col-md-6">
  <h1>{{{$user->first_name}}} {{{$user->last_name}}} </h1>
  <h1><small>Age: {{{$user->age}}}</small></h1>
  {{ Form::open(array('route' => array('user.get_friends', $user->id))) }}
  <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-user"></span> Friends</button>
  {{ Form::close() }}
</div>

<div class="col-md-6">
  {{ Form::open(array('action' => 'UserController@store', 'class' => 'form-horizontal', 'id' => 'post-form')) }}
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
      {{ Form::password('password', ['class' => 'form-control', 'placeholder' => 'Enter A Password']) }} 
      @if($errors->first('password'))
      <div class="btn btn-danger"> {{$errors->first('password')}} </div>
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
      {{ Form::text('birth_date', '', array('class' => 'form-control','placeholder' => 'Birth Date dd/mm/yyyy','data-datepicker' => 'datepicker')) }}
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-8">
      {{ Form::submit('Sign Up', array('class' => 'btn btn-danger')) }}
    </div>
  </div>
  {{ Form::close() }}
</div> 
@endif
@stop
@section('content')

<div class="container" id="post-container">

  @foreach($posts as $post)
  @include('partial.post_object')
  @endforeach
</div>
@stop