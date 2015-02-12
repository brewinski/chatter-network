<?php

class CommentController extends \BaseController {

  /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

  public static $rules = array(
    'message' => 'required'
  );

  public function index()
  {
    //
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
    $comment = new Comment();

    $input = Input::all();
    $name = Auth::user()->first_name . " " . Auth::user()->last_name;
    $v = Validator::make($input, CommentController::$rules);

    if($v->passes())
    {
      $comment->name = $name;
      $comment->message = $input['message'];
      $comment->post_id = $input['post_id'];
      $comment->user_id = Auth::user()->id;

      $comment->save();

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

  }


  /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function edit($id)
  {
    //
  }


  /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function update($id)
  {
    //
  }


  /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function destroy($id)
  {
    $comment = Comment::find($id);
    $comment->delete();
    return Redirect::to(URL::previous());
  }


}
