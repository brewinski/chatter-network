<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');
  
  function posts() 
  {
    return $this->hasMany('Post');
  }
  //declares a user has many comments
  function comments()
  {
    return $this->hasMany('Comment');
  }
  //declares a user has many friends
  function friend() 
  {
    return $this->belongsToMany('User', 'User_friends', 'user_id', 'friend_id');
  }
  //declares a user inverse of frends
  function friendof()
  {
    return $this->belongsToMany('User', 'User_friends', 'friend_id', 'user_id');
  }
  //function that adds a friend to the database
  public function addFriend(User $user)
  {
     $this->friend()->attach($user->id);
  }    
//function removes friend relation from database
  public function removeFriend(User $user)
  {
     $this->friend()->detach($user->id);
  }  

}
