<?php

class Comment extends Eloquent 
{
  function post() 
  {
    $this->belongsTo('Post');
  }
  
  function user()
  {
    $this->belongsTo('User');
  }
}