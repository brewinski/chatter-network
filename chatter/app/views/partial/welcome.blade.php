@if(Auth::check())
<div class="col-md-6">
  <h1>Welcome {{{Auth::user()->first_name}}} {{{Auth::user()->last_name}}} </h1>
  <h1><small>Tell us what's on your mind. Make your first post today.</small></h1>
</div>
<div class="col-md-6">
  <!---------------------------------------- Post-Form ----------------------------------> 
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
  <!---------------------------------------- End Post-Form ---------------------------------->
</div> 
@else
<div class="col-md-6">
  <h1>Welcome To Chatter </h1>
  <h1><small>Tell us what's on your mind. Sign up and start posting today.</small></h1>
</div>
<div class="col-md-6">
  {{ Form::open(array('action' => 'UserController@store', 'class' => 'form-horizontal', 'id' => 'post-form')) }}
    <div class="form-group">
      <div class="col-sm-8">
        {{ Form::text('username', null,['class' => 'form-control', 'placeholder' => 'Enter Email Address']) }} 
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
        @if($errors->first('birth_date'))
          <div class="btn btn-danger"> {{$errors->first('')}} </div>
        @endif
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