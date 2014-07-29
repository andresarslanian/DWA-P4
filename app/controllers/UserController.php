<?php

class UserController extends \BaseController {

	# Maximum entries per form
	private $maxEntries = 10;


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		# Get the sorting parameters
	    $sortby = Input::get('sort');
	    $order = Input::get('order');

	    # Check if the value passed corresponds to a column of the table
	    if ("exists:users,$sortby")
	        $sortby = "company_id";
	    if (!$order)
	        $order = "desc";

	    # Get the companies for the dropdown meny
	    $companies[]="All";
	    foreach (Company::all() as $c) {
	        $companies[$c->name] = $c->name;
	    }

	    # Check if it has to be filtered by company
	    $company = Input::get('company');

	    $users = [];

	    if ($company){
	    	# Filter by company
	        $selectedCompany = Company::where('name','LIKE', $company)->get()->first();
	        if ($selectedCompany)
	            $users = User::orderBy($sortby, $order)->with('company')->where('company_id',  $selectedCompany->id)->paginate($this->maxEntries);
	    } else {
	    	# All the results
	        $users = User::orderBy($sortby, $order)->with('company')->paginate($this->maxEntries);
	    }

	    return View::make('user/list')->with("users",  $users)->with("sort",  $sortby)->with("order",  $order)->with('companies', $companies);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
	    $companies[]="Select a company";
	    foreach (Company::all() as $c) {
	        $companies[$c->id] = $c->name;
	    }
	    return View::make('user/create')->with("companies",$companies);
		
	}

	public function postCreate()
	{
		$u = new User();
		if (!$u->validate(Input::all())){
			return Redirect::to('/create-user')
			            ->with('flash_message', 'User creation failed; please try again.')->withErrors($u->errors())
			            ->withInput();
		}

	    $user = new User;
	    $user->email        = Input::get('email');
	    $user->password     = Hash::make(Input::get('password'));
	    $user->firstname    = Input::get('firstname');
	    $user->lastname     = Input::get('lastname');
	    $user->phone        = Input::get('phone');
	    $user->company_id   = Input::get('company_id');    
	    
	    try {
	        $user->save();
	        $user_role = new UserRole;
	        $user_role->user_id =  $user->id;      
	        $user_role->role_id = Role::where('role', '=', 'user')->first()->id;
	        $user_role->save();

			return Redirect::to('/create-user')
				            ->with('flash_message', 'User creation failed; please try again.')->withErrors($u->errors())
				            ->withInput();
	
	    }
	    catch (Exception $e) {
	        return Redirect::to('/create-user')
	            ->with('flash_message', 'User creation failed; please try again.')->withErrors($u->errors())
	            ->withInput();
	    }
	    
	    # Log in
	   	// Auth::login($user);
	    
	    return Redirect::to('/list-users')->with('flash_message', "User $user->firstname created.");
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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


}
