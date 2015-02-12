<div class="row post-row">
  <div class="row">
    <div class="col-md-3">
      @if(!empty($post->user))
      <img src="{{URL::asset('images/User_Circle.png')}}" height="75" />
      <h2>{{{htmlspecialchars($post->user)}}}</h2>
      <h5><small>Status: {{{$post->status}}}</small></h5>
      @else
      <h1><small>Anonymouse Post</small></h1>
      <h2><small>The poster has not specified their name...</small></h2>
      @endif
    </div>
    <div class="col-md-9">
      <h1><small><u><b>{{{htmlspecialchars($post->title)}}}</b></u></small></h1>
      <h2><small>{{{htmlspecialchars($post->message)}}}</small></h2>
    </div>
  </div>
  <div class="row">
      <div class="col-md-1">
        <a class="btn btn-danger" href="{{{url('post/post_comment/' . $post->id)}}}" role="button"><span class="glyphicon glyphicon-comment"></span> Comments ({{{$post->count}}})</a>
      </div>
     @if(Auth::check())
      <div class="col-md-9"></div>
      @if(Auth::user()->id == $post->user_id)
        <div class="col-md-1">
          {{ Form::open(array('method' => 'DELETE', 'route' => array('post.destroy', $post->id))) }}
          <button type="submit" class="btn btn-link pull-right btn-default post-btn"><span class="glyphicon glyphicon-trash"></span></button>
          {{ Form::close() }}
        </div>
        <div class="col-md-1">
          {{ Form::open(array('method' => 'GET', 'route' => array('post.show', $post->id))) }}
          <button type="submit" class="btn btn-link btn-default post-btn"><span class="glyphicon glyphicon-edit glyphicon-align-left"></span></button>
          {{ Form::close() }}
        </div>
      @endif
    @endif
  </div>
</div>