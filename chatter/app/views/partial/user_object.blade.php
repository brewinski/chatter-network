
<div class="row post-row">
  <div class="row">
    <div class="col-md-3">
      <img src="{{URL::asset('images/User_Circle.png')}}" height="50" />
      <h2>{{{$user->first_name}}}</h2>
    </div>
    <div class="col-md-9">
      <h1><small><u><b>{{{$user->last_name}}}</b></u></small></h1>
      <h2><small></small></h2>
    </div>
  </div>
  {{ link_to_route('user.show', 'View Profile', array($user->id)) }}
</div>