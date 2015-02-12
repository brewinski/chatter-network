<?php

class PostController extends \BaseController {

  /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
  public static $rules = array(
    'title' => 'required|min:3',
    'message' => 'required'
  );

  public function index()
  {
    $posts = Post::orderBy('created_at', 'desc')->get();

    foreach($posts as $post)
    {
      $user = User::find($post->user_id);
      $name = $user->first_name . " " . $user->last_name;
      $post->user = $name;
      $count = count($post->comments()->get());
      $post->count = $count;
    }

    return View::make('page.post', compact('posts'));
  }


  /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
  public function create()
  {
    //
  }


  /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
  public function store()
  {

    $post = new Post();

    $input = Input::all();

    $v = Validator::make($input, PostController::$rules);

    if($v->passes())
    {  
      $post->title = $input['title'];
      $post->message = $input['message'];
      $post->user_id = Auth::user()->id;
      $post->status = $input['status'];
      $post->save();
      $posts = Post::all();

      return Redirect::to(URL::previous());
    }
    else
    {
      return Redirect::to(URL::previous())->withErrors($v);
    }

  }


  /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function show($id)
  {
    $post = Post::find($id);
    $user = User::find($post->user_id);
    $name = $user->first_name . " hi " . $user->last_name;
    $post->user = $name;
    $count = count($post->comments()->get());
    $post->count = $count;
    return View::make('page.update_post')->withPost($post);
  }


  /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function edit($id)
  {
    $post = Post::find($id);
    return View::make('page.update_post')->withPost($post);
  }


  /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function update($id)
  {
    $post = Post::find($id);

    $input = Input::all();

    $v = Validator::make($input, PostController::$rules);

    if($v->passes())
    {
      $post->user_id = Auth::user()->id;
      $post->title = $input['title'];
      $post->message = $input['message'];
      $post->status = $input['status'];
      $post->save();

      return Redirect::to(URL::previous());
    }
    else
    {
      return Redirect::to(URL::previous())->withErrors($v);
    }
  }


  /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function destroy($id)
  {
    $post = Post::find($id);
    $comments = $post->comments()->get();
    foreach($comments as $comment)
      $comment->delete();

    $post->delete();
    return Redirect::to('post');
  }

  /**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function getPostComment($id)
  {
    $post = Post::find($id);
    $comments = $post->comments()->orderBy('created_at', 'desc')->get();
    $user = User::find($post->user_id);
    $name = $user->first_name . " " . $user->last_name;
    $post->user = $name;
    $count = count($comments);
    $post->count = $count;

    return View::make('page.post_comment')->withPost($post)->withComments($comments);
  }

}
