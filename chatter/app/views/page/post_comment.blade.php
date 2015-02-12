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
      <h2><small>Add Comment....</small></h2>
      <!---------------------------------------- Post-Form ----------------------------------> 
      @if(Auth::check())
      {{ Form::open(array('action' => 'CommentController@store', 'class' => 'form-horizontal')) }}
         
      <div class="form-group">
        <div class="col-sm-8">
          {{ Form::hidden('post_id', $post->id) }}
          {{Form::textarea('message', null, ['class' => 'form-control', 'placeholder' => 'Enter A Message Here.......', 'size' => '0x4']) }}
          @if($errors->first('message'))
          <div class="btn btn-danger"> {{$errors->first('message')}} </div>
          @endif
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-8">
          {{ Form::submit('Leave Comment', array('class' => 'btn btn-danger')) }}
        </div>
      </div>
      {{Form::close()}}
      @else
      <h2><small>You need to creat an account to comment on posts....</small></h2>
      @endif
      <!---------------------------------------- End Post-Form ---------------------------------->
    </div>
  </div>
  <ul class="timeline">
    <li><div class="tldate">Comments</div></li>
    @foreach($comments as $comment)
    @if($comment->id % 2 == 0)
    <li class="timeline-inverted">
      @include('partial.comment_object')
    </li>
    @else
    <li>
      @include('partial.comment_object')
    </li>
    @endif

    @endforeach
  </ul>
</div>

@stop