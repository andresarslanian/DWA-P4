<?php

class IncidentController extends \BaseController {

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
	    if ("exists:incidents,$sortby")
	        $sortby = "owner_id";
	    if (!$order)
	        $order = "desc";

	    # Get the companies for the dropdown meny
	    $companies[]="All";
	    foreach (Company::all() as $c) {
	        $companies[$c->name] = $c->name;
	    }

	    # Check if it has to be filtered by company
	    $company = Input::get('company');

	    $incidents = [];

	    if ($company){
	    	# Filter by company
	        $selectedCompany = Company::where('name','LIKE', $company)->get()->first();
	        if ($selectedCompany)
	            $incidents = Incident::orderBy($sortby, $order)->with('owner', 'reporter', 'action', 'state', 'type')->where('owner_id',  $selectedCompany->id)->paginate($this->maxEntries);
	    } else {
	    	# All the results
	        $incidents = Incident::orderBy($sortby, $order)->with('owner', 'reporter', 'action', 'state', 'type')->paginate($this->maxEntries);
	    }

	    return View::make('incident/list')->with("incidents",  $incidents)->with("sort",  $sortby)->with("order",  $order)->with('companies', $companies);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function getCreate()
	{
	    $companies = [];
	    foreach (Company::all() as $company) {
	        $companies[$company->id] = $company->name;
	    }

	    $states = [];
	    foreach (State::all() as $state) {
	        $states[$state->id] = $state->description;
	    }

	    $actions = [];
	    foreach (Action::all() as $action) {
	        $actions[$action->id] = $action->description;
	    }

	    $incidents = [];
	    foreach (IncidentType::all() as $incident) {
	        $incidents[$incident->id] = $incident->description;
	    }

	    	    	    	    
	    return View::make('incident/create')->with("companies",$companies)
	    	->with("states",$states)
	    	->with("actions",$actions)
	    	->with("incidents",$incidents);
		
	}

	public function postCreate()
	{
	    $incident = new Incident;
	    $incident->address        = Input::get('address');
	    $incident->house_number   = Input::get('house_number');
	    $incident->lamp_type      = Input::get('lamp_type');
	    $incident->hw_address     = Input::get('hw_address');
	    $incident->description    = Input::get('description');
	    $incident->picket_number  = Input::get('picket_number');
	    $incident->house_number   = Input::get('house_number');
	    $incident->type_id        = Input::get('type_id');    
	    $incident->owner_id   	  = Input::get('owner_id');    
	    $incident->action_id      = Input::get('action_id');    
	    $incident->state_id   	  = Input::get('state_id');    
	    $incident->reporter_id    = Auth::id();    
	    
	    try {
	        $incident->save();
	    }
	    catch (Exception $e) {
	        return Redirect::to('/create-incident')
	            ->with('flash_message', 'Incident not created; please try again.')
	            ->withInput();
	    }
	    
    
	    return Redirect::to('/list-incidents')->with('flash_message', 'User created.');
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
	public function show($id = 0)
	{
		return View::make('user/login');
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
