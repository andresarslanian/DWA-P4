<?php

class LampController extends \BaseController {

	# Maximum entries per form
	private $maxEntries = 10;

	public function __construct(){
		
		parent::__construct();
		$this->beforeFilter('permission:upload_lamps');
		$this->beforeFilter('auth');
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

	    # Get the states for the dropdown menu
	    $states[]="All states";
	    foreach (LampState::all() as $c) {
	        $states[$c->id] = $c->description;
	    }
	    $types[]="All types";
	    foreach (LampType::all() as $c) {
	        $types[$c->id] = $c->description;
	    }

	    # Check if the value passed corresponds to a column of the table
	    if ("exists:lamps,$sortby")
	        $sortby = "lamps.created_at";
	    if (!$order || $order != 'asc')
	        $order = "desc";

    	# Check if it has to be filtered by company
	    $state = Input::get('state');
	    $type = Input::get('type');

	    $lamps = [];

	    if ($state && $type){
	    	# Filter by company
            $lamps = Lamp::orderBy($sortby, $order)->with('state', 'type')->where('state_id',  $state)->where('type_id',  $type)->paginate($this->maxEntries);
	    } else if ($type){
	    	# Filter by company
            $lamps = Lamp::orderBy($sortby, $order)->with('state', 'type')->where('type_id',  $type)->paginate($this->maxEntries);
	    } else if ($state){
	    	# Filter by company
            $lamps = Lamp::orderBy($sortby, $order)->with('state', 'type')->where('state_id',  $state)->paginate($this->maxEntries);
	    } else {
	    	# All the results
	        $lamps = Lamp::orderBy($sortby, $order)->with('state', 'type')->paginate($this->maxEntries);
	    }

	    return View::make('lamp/list')
	    	->with("lamps",  $lamps)
	    	->with("sort",   $sortby)
	    	->with("order",  $order)
	    	->with("states", $states)
	    	->with("types",  $types);

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


}
