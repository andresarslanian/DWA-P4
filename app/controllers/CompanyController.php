<?php

class CompanyController extends \BaseController {

	# Maximum entries per form
	private $maxEntries = 10;

	public function __construct(){
		
		parent::__construct();
		$this->beforeFilter('permission:view_companies');
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
    	# All the results
        $companies = Company::orderBy("name", "asc")->paginate($this->maxEntries);

	    return View::make('company/list')->with('companies',$companies);

	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
	    return View::make('company/create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$c = new Company();
		if (!$c->validate(Input::all())){
			return Redirect::to('/create-company')
			            ->with('flash_message', 'Company creation failed; please try again.')->withErrors($c->errors())
			            ->withInput();
		}

	    $company = new Company;
	    $company->email = Input::get('email');
	    $company->name  = Input::get('name');
	    $company->phone = Input::get('phone');
	    
	    try {
	        $company->save();
	    }
	    catch (Exception $e) {
	        return Redirect::to('/create-company')
	            ->with('flash_message', 'Company creation failed; please try again.')->withErrors($c->errors())
	            ->withInput();
	    }
	    
	    # Log in
	   	// Auth::login($user);
	    
	    return Redirect::to('/list-companies')->with('flash_message', "Company $company->name created.");
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
