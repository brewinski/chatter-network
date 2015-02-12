<?php

class CommentSeeder extends Seeder
{
  public function run()
  {
    $comment = new Comment();
    $comment->name = 'Christopher Brewin';
    $comment->post_id = 1;
    $comment->message = 'Great to be back in version 2.0';
    $comment->save();
    
    $comment = new Comment();
    $comment->name = 'Christopher Brewin';
    $comment->post_id = 1;
    $comment->message = 'Great to be back in version 2.0';
    $comment->save();
  }
}