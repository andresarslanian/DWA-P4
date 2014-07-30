<?php

class ReplacementController extends \BaseController {

	# Maximum entries per form
	private $maxEntries = 10;

	public function __construct(){
		
		parent::__construct();
		$this->beforeFilter('permission:view_replacements');
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
	    if ("exists:replacements,$sortby")
	        $sortby = "replacements.created_at";
	    if (!$order || $order != 'asc')
	        $order = "desc";

	    # Get the companies for the dropdown meny
	    $companies[]="All";
	    foreach (Company::all() as $c) {
	        $companies[$c->name] = $c->name;
	    }

	    # Check if it has to be filtered by company
	    $company = Input::get('company');

	    $replacements = [];

	    if ($company){
	    	# Filter by company
	        $selectedCompany = Company::where('name','LIKE', $company)->get()->first();
	        if ($selectedCompany){
	            $replacements = Replacement::orderBy($sortby, 'replacements'.$order)
	            								->with('user.company', 'user', 'lamp.type')
	            								->join('users', 'user_id', '=', 'users.id')
	            								->join('companies', 'users.company_id', '=', 'companies.id')
	            								->where('companies.id','=', $selectedCompany->id)
	            								->paginate($this->maxEntries);
	        }
	    } else {
	    	# All the results
	        $replacements = Replacement::orderBy($sortby, $order)->with('user.company', 'lamp.type')->paginate($this->maxEntries);
	    }

	    return View::make('replacement/list')->with("replacements",  $replacements)->with("sort",  $sortby)->with("order",  $order)->with('companies', $companies);

	}



	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->beforeFilter('permission:create_replacement');
		$incident_id = Input::get('incident_id');
		if (!$incident_id){
			$incident_id = Session::get('incident_id');
			if (!$incident_id)
				return Redirect::to('/list-incidents');
		}

	    $lamps [] = "";
	    $newLamps = LampState::where('description','=','New')->first();
	    foreach (Lamp::where('state_id','=',"$newLamps->id")->get() as $lamp) {
	        $lamps[$lamp->id] = $lamp->serial;
	    }
	    	    	    	    
	    return View::make('replacement/create')
	    	->with("lamps",$lamps)
	    	->with("incident_id", $incident_id);
		
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$this->beforeFilter('permission:create_replacement');
		$r = new Replacement();
		$incident_id = Input::get('incident_id');
		if (!$r->validate(Input::all())){
			return Redirect::action('ReplacementController@create')
			            ->with('flash_message', 'Replacement not created; please try again.')
			            ->withErrors($r->errors())
			            ->with("incident_id", $incident_id)
			            ->withInput();
		}

		
		if (!$incident_id){
			return Redirect::to('/list-incidents');
		}

	    $replacement = new Replacement;
	    $replacement->comments   = Input::get('comments');
	    $replacement->incident_id   = Input::get('incident_id');
	    $l = Input::get('lamp_id');
	    if ($l != '0'){
	  		$replacement->lamp_id = $l;   
	    }
	    $lamp = Lamp::where('id','LIKE',"$l")->first();
	    $lamp->state_id = LampState::where('description','=',"In Use")->first()->id;

	    $replacement->user_id    = Auth::id();    

	    
	    try {
	        $replacement->save();
	        $lamp->save();
	    }
	    catch (Exception $e) {
	    	echo $e;
	    	return;
	        return Redirect::to('/create-replacement')
	            ->with('flash_message', 'Replacement not created; please try again.')
	            ->withInput();
	    }
	    
    
	    return Redirect::to("/edit-incident/$incident_id")->with('flash_message', 'Replacement created.');
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
