<?php

class UserController extends \BaseController {

  /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

  public static $rules = array(
    'username' => 'required|email|min:5|max:50',
    'password' => 'required|min:6|max:30|alpha_num',
    'first_name' => 'sometimes|required|min:3|max:30|alpha',
    'last_name' => 'sometimes|required|min:3|max:30|alpha',
    'birth_date' => 'sometimes|required|date_format:"d/m/Y"|min:10|max:10'
  );

  public function index()
  {

  }


  /**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
  public function create()
  {
    return View::make('user.create_user');
  }


  /**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
  public function store()
  {

    $input = Input::all();

    $v = Validator::make($input, UserController::$rules);

    if ($v->passes())
    {
      $password = $input['password'];
      $encrypted = Hash::make($password); 

      $user = new User();

      $user->username = $input['username'];
      $user->password = $encrypted;
      $user->first_name = $input['first_name'];
      $user->last_name = $input['last_name'];
      $user->birth_date = $input['birth_date']; 

      $user->save();

      Auth::attempt(array('username' => $user->username, 'password' => $password));

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
    $user = User::with('posts.comments')->orderBy('created_at', 'desc')->find($id);
          
    if(Auth::check())
    {
        $ids = array('profileid' => $id, 'logedinid' => Auth::user()->id);
            $s = Post::where('user_id', '=', $id)->where(function($q) use($ids)
                                                   {
                                                     $q->where('status', '=', 'public')
                                                       ->orWhere(function($q) use($ids)
                                                                 {
                                                                   $q->where('status', '=', 'friends')
                                                                     ->whereHas('user', function($q) use($ids)
                                                                                {
                                                                                  $q->whereHas('friend', function($q) use ($ids)
                                                                                               {
                                                                                                 $q->where('user_id', '=', $ids['profileid']);
                                                                                               });
                                                                                });
                                                                 })->orWhere(function($q) use($ids)
                                                                            {
                                                                              $q->where('status', '=', 'private')
                                                                                ->whereHas('user', function($q) use($ids)
                                                                                          {
                                                                                            $q->where('id', '=', $ids['logedinid']);
                                                                                          });
                                                                            });
                                                   })->orderBy('created_at', 'desc')->get();
    }
    else
    {
      $s = Post::where('user_id', '=', $id)->where(function($q) use($id) { $q->where('status', '=', 'public'); })->get();
    }

    $name = $user->first_name . " " . $user->last_name;
    foreach($s as $post)
    {
      $post->user = $name;
      $count = count($post->comments()->get());
      $post->count = $count;
    } 
    if(Auth::check())
    {
      $friends = $user->friend;
      if($user->friend->contains(Auth::user()->id))
        $user->friends = true;
    }
    //date in mm/dd/yyyy format; or it can be in other formats as well
    $birthDate = $user->birth_date;
    //explode the date to get month, day and year
    $birthDate = explode("/", $birthDate);
    //get age from date or birthdate
    $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

    $user->age = $age; 

    return View::make('user.profile')->withUser($user)->withPosts($s);
  }


  /**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function edit($id)
  {
    $user = User::find($id);
    return View::make('user.update_details')->withUser($user);
  }


  /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function update($id)
  {
    $user = User::find($id);
    $input = Input::all();
    $v = Validator::make($input, UserController::$rules);

    if ($v->passes())
    {
      $user->username = $input['username'];
      $user->first_name = $input['first_name'];
      $user->last_name = $input['last_name'];

      $user->save();
      $name = $user->first_name . " " . $user->last_name;
      $comments = $user->comments()->get();
      foreach($comments as $comment)
      {
        $comment->name = $name; 
        $comment->save();
      }

      return Redirect::to(URL::previous());
    }
    return Redirect::to(URL::previous())->withErrors($v);
  }


  /**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
  public function destroy($id)
  {
    //
  }

  public function login_form() 
  {
    return View::make('user.login_user');
  }

  public function login()
  {
    $input = Input::all();

    $password = $input['password'];
    $username = $input['username'];

    if(Auth::attempt(array('username' => $username, 'password' => $password)))
    {
      return Redirect::to('post');
    }
    sleep(3);
    return Redirect::to(URL::previous())->withErrors(array('invalid' => 'Username or Password Invalid'))->withInput(Input::except('password'));;
  }
  //Logs user out
  public function logout()
  {
    Auth::logout();  
    return Redirect::to(URL::previous());
  }
  //lists all users
  public function listAll()
  {
    $input = Input::all();
    $search = $input['search'];

    $users = User::where('username', 'like', "%$search%")
      ->orWhere('first_name', 'like', "%$search%")
      ->orWhere('last_name', 'like', "%$search%")
      ->get();

    return View::make('user.search_users')->withUsers($users)->withSearch($search);
  }
  //adds a friend to user friend table
  public function add_friend($id)
  {
    $user = User::find($id);
    Auth::user()->addFriend($user);
    $user->addFriend(Auth::user());

    return Redirect::to(URL::previous());
  }
  //gets all friend belonging to a user
  public function get_friends($id) 
  {
    $user = User::find($id);
    $user = $user->friend()->get();

    return View::make('user.friends')->withUsers($user);
  }

  //removes a friend from user by id
  public function remove_friend($id)
  {
    $user = User::find($id);
    Auth::user()->removeFriend($user);
    $user->removeFriend(Auth::user());
    return Redirect::to(URL::previous());
  }

  public function doc()
  {
    return View::make('page.doc');
  }
}
