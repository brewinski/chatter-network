@extends('layout.master')

@section('title')
Chatter
@stop

@section('jumbotron')
<div class="row">
  @include('partial.welcome')
</div>
@stop
@section('content')

<div class="container" id="post-container">

  @foreach($posts as $post)
  @include('partial.post_object')
  @endforeach
</div>
{{ link_to_route('page.doc', 'DOC') }}
@stop