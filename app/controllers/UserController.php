<?php

class UserController extends \BaseController {

	# Maximum entries per form
	private $maxEntries = 10;

	public function __construct(){
		
		parent::__construct();
		$this->beforeFilter('permission:view_users_for_company');
	}


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

		if ($company && Auth::user()->worksFor('Philips')){
	    	# Filter by company
			$selectedCompany = Company::where('name','LIKE', $company)->get()->first();
			if ($selectedCompany)
				$users = User::orderBy($sortby, $order)->with('company')->where('company_id',  $selectedCompany->id)->paginate($this->maxEntries);
		} else {
	    	# All the results
			if ( Auth::user()->worksFor('Philips') && Auth::user()->can('view_all_users') ){
	    		#View all incidents
				$users = User::orderBy($sortby, $order)->with('company')->paginate($this->maxEntries);
			} else {
				$users = User::orderBy($sortby, $order)->with('company')
				->whereHas('company', function($q) { 
					$q->where('id', '=', Auth::user()->company->id);
				})
				->paginate($this->maxEntries);
			}
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
		$this->beforeFilter('permission:create_users_for_company');

		$companies[]="Select a company";
		foreach (Company::all() as $c) {
			$companies[$c->id] = $c->name;
		}

		return View::make('user/create')->with("companies",$companies)->with("roles",Role::getIdNamePair());
		
	}

	public function postCreate()
	{
		$this->beforeFilter('permission:create_users_for_company');


		if ( !Auth::user()->can('create_all_users') ){
			if ( Auth::user()->company->id != Input::get('company_id')){
				return Redirect::to('/create-user')
				->with('flash_message', 'User creation failed; please try again.')
				->withInput();	
			}
		}

		$u = new User();
		if (!$u->validate(Input::all())){
			return Redirect::to('/create-user')
			->with('flash_message', 'User creation failed; please try again.')->withErrors($u->errors())
			->withInput();
		}
		
		$r = new UserRole();
		if (!$r->validate( array('role' => Input::get('role')))){
			return Redirect::to('/create-user')
			->with('flash_message', 'User creation failed; please try again.')->withErrors($r->errors())
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
			$user->roles()->attach( Input::get('role') );
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
		if ($id == 0){
			return Redirect::to('/list-users');
		}

		$user = User::with('company','roles.role')->find($id);

		return View::make('user/show')
		->with('user', $user);
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
