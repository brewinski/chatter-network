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
  @include('partial.post_object')
  <div class="row post-row" >
    <div class="col-md-10">
      <h2><small>Update post</small></h2>
      <!---------------------------------------- Post-Form ----------------------------------> 
      {{Form::model($post, array('method' => 'PUT', 'route' => array('post.update', $post->id), 'class' => 'form-horizontal'))}}
      <div class="form-group">
        <div class="col-sm-8">
          {{Form::text('user', null, array('class' => 'form-control'))}}
          @if($errors->first('user'))
          <div class="btn btn-danger"> {{$errors->first('user')}} </div>
          @endif
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-8">
          {{Form::text('title', null, array('class' => 'form-control'))}}
          @if($errors->first('title'))
          <div class="btn btn-danger"> {{$errors->first('title')}} </div>
          @endif
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-8">
          {{Form::textarea('message', null, array('class' => 'form-control')) }}
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
          {{ Form::submit('Update', array('class' => 'btn btn-danger')) }}
        </div>
      </div>
      {{Form::close()}}
      <!---------------------------------------- End Post-Form ---------------------------------->
    </div>
  </div>
</div>
@stop