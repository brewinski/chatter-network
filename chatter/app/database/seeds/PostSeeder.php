<?php

class PostSeeder extends Seeder
{
  public function run()
  {
    $post = new Post();
    $post->user = 'Christopher Brewin';
    $post->title = 'Good Evening';
    $post->message = 'Great to be back in version 2.0';
    $post->save();
    
    $post = new Post();
    $post->user = 'Christopher Brewin';
    $post->title = 'Good Evening';
    $post->message = 'Version 2.0!! This is more exiting than a koala riding a giraff';
    $post->save();
  }
}