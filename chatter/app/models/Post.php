<?php

class Post extends Eloquent 
{
  //declares a post has many comments
  function comments() 
  {
    return $this->hasMany('Comment');
  }
  //declares a post belongs to a user
  function user() 
  {
    return $this->belongsTo('User');
  }
}