<div class="row">
  <div class="tl-circ"></div>
  <div class="timeline-panel">
    @if(Auth::check())
    @if(Auth::user()->id == $comment->user_id)
    {{ Form::open(array('method' => 'DELETE', 'route' => array('comment.destroy', $comment->id))) }}
    <button type="submit" class="btn btn-link pull-right btn btn-default post-btn"><span class="glyphicon glyphicon-remove pull-right"></span></button>
    {{ Form::close() }}
    @endif
    @endif
    <div class="tl-heading">
      <h4>{{{htmlspecialchars($comment->name)}}}</h4>
      <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i> 3 hours ago</small></p>
  
    </div>
    <div class="tl-body">
      <p>{{{htmlspecialchars($comment->message)}}}</p>
    </div>
  </div>
</div>

