<?php

class IncidentController extends \BaseController {

	# Maximum entries per form
	private $maxEntries = 10;

	public function __construct(){
		
		parent::__construct();
		$this->beforeFilter('permission:view_incidents');
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
		if ("exists:incidents,$sortby")
			$sortby = "updated_at";
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

		if ($company && Auth::user()->worksFor('Philips')){
	    	# Filter by company
			$selectedCompany = Company::where('name','LIKE', $company)->get()->first();
			if ($selectedCompany)
				$incidents = Incident::orderBy($sortby, $order)->with('owner', 'reporter', 'action', 'state', 'type', 'lamp_type')->where('owner_id',  $selectedCompany->id)->paginate($this->maxEntries);
		} else {
	    	# All the results

			if ( Auth::user()->worksFor('Philips') && Auth::user()->can('view_all_incidents') ){
	    		#View all incidents
				$incidents = Incident::orderBy($sortby, $order)->with('owner', 'reporter', 'action', 'state', 'type', 'lamp_type')->paginate($this->maxEntries);
			} else {
				#Show the incidents of the company of the logged user or the incidents reported by a member of the users company
				$incidents = Incident::orderBy($sortby, $order)->with('owner', 'reporter', 'action', 'state', 'type', 'lamp_type')
				->whereHas('owner', function($q) { 
					$q->where('id', '=', Auth::user()->company->id);
				})
				->orWhereHas('reporter', function($q) {
					$q
					->join('companies', 'users.company_id', '=', 'companies.id')
					->where('companies.id', '=', Auth::user()->company->id);
				})
				->paginate($this->maxEntries);
			}
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
		$this->beforeFilter('permission:create_incident');
		
		return View::make('incident/create')->with("companies",Company::getOwnerIdNamePair())
		->with("lamp_types",LampType::getIdNamePair())
		->with("incidents",IncidentType::getIdNamePair());
	}

	public function postCreate()
	{
		$this->beforeFilter('permission:create_incident');
		$i = new Incident();
		if (!$i->validate(Input::all())){
			return Redirect::to('/create-incident')
			->with('flash_message', 'Incident not created; please try again.')->withErrors($i->errors())
			->withInput();
		}

		if ( !array_key_exists(Input::get('owner_id'), Company::getOwnerIdNamePair()) ){
			return Redirect::to('/create-incident')
			->with('flash_message', 'Incident not created; please try again.')
			->withInput();			
		}

		$incident = new Incident;
		$incident->address        = Input::get('address');
		$incident->house_number   = Input::get('house_number');
		$lt = Input::get('lamp_type_id');
		if ($lt != '0'){
			$incident->lamp_type_id = $lt;   
		}

		$incident->hw_address     = Input::get('hw_address');
		$incident->description    = Input::get('description');
		$incident->picket_number  = Input::get('picket_number');
		$incident->house_number   = Input::get('house_number');
		$incident->type_id        = Input::get('type_id');    
		$incident->owner_id   	  = Input::get('owner_id');    
		$incident->state_id   	  = State::where('description', '=', 'open')->first()->id;   
		$incident->reporter_id    = Auth::id();    

		try {
			$incident->save();
		}
		catch (Exception $e) {
			return Redirect::to('/create-incident')
			->with('flash_message', 'Incident not created; please try again.')
			->withInput();
		}


		return Redirect::to('/list-incidents')->with('flash_message', "Incident created with id $incident->id.");
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
		if ($id == 0){
			return Redirect::to('/list-incidents');
		}
		$incident = Incident::with('lamp_type', 'owner', 'type', 'reporter.company')->find($id);
		$replacements = Replacement::where('incident_id','=',$incident->id)->get();
		return View::make('incident/show')
		->with('incident', $incident)
		->with('replacements', $replacements);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		if ($id == 0){
			return Redirect::to('/list-incidents');
		}
		$incident = Incident::with('lamp_type', 'owner', 'type', 'reporter.company')->find($id);
		$replacements = Replacement::where('incident_id','=',$incident->id)->get();

		return View::make('incident/edit')
		->with('incident', $incident)
		->with('states', State::getIdNamePair())
		->with('incidents', IncidentType::getIdNamePair())
		->with('lamp_types', LampType::getIdNamePair())
		->with('actions', Action::getIdNamePair())
		->with('replacements', $replacements);			

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$this->beforeFilter('permission:modify_incident');
		$incident =  Incident::find(Input::get('incident_id'));
		$lt = Input::get('lamp_type_id');
		if ($lt != '0'){
			$incident->lamp_type_id = $lt;   
		}
		$incident->type_id        = Input::get('type_id');  
		$incident->hw_address     = Input::get('hw_address');    
		$incident->state_id   	  = Input::get('state_id');   
		$action = Input::get('action_id');
		if ($action != '0'){
			$incident->action_id = $action;   
		}

		try {
			$incident->save();
		}
		catch (Exception $e) {
			return Redirect::to("/edit-incident/$incident->id")
			->with('flash_message', 'Incident not updated; please try again.')
			->withInput();
		}


		return Redirect::to("/edit-incident/$incident->id")->with('flash_message', 'Incident updated.');

	}


}
