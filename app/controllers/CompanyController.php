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
        $companies = Company::orderBy("name", "asc")->where('companies.enabled','=', true)->paginate($this->maxEntries);

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
		if ($id == 0){
			return Redirect::to('/list-companies');
		}

		$company = Company::find($id);

		return View::make('company/show')
		->with('company', $company);
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
		$this->beforeFilter('permission:modify_companies');
		if ($id == 0){
			return Redirect::to('/list-companies');
		}

		$company = Company::find($id);

		return View::make('company/edit')
		->with('company', $company);


	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{
		$this->beforeFilter('permission:modify_companies');

		$company_id = Input::get('company_id');
		$c = new Company();
		if (!$c->validate(Input::all())){
			return Redirect::to("/edit-company/$company_id")
			            ->with('flash_message', 'Company could not be updated; please try again.')->withErrors($c->errors())
			            ->withInput();
		}

	    $company = Company::find($company_id);
	    $company->email = Input::get('email');
	    $company->name  = Input::get('name');
	    $company->phone = Input::get('phone');
	    
	    try {
	        $company->save();
	    }
	    catch (Exception $e) {
	        return Redirect::to("/edit-company/$company_id")
	            ->with('flash_message', 'Company could not be updated; please try again.')->withErrors($c->errors())
	            ->withInput();
	    }
	    
	    # Log in
	   	// Auth::login($user);
	    
	    return Redirect::to("/edit-company/$company_id")->with('flash_message', "Company $company->name updated.");
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{
		//
		$this->beforeFilter('permission:modify_companies');

		$company_id = Input::get('company_id');

		if ($company_id == 0){
			return Redirect::to('/list-companies');
		}

		$company = Company::find($company_id);
		#Delete the company
		$company->enabled = false;

		$users = User::where('company_id','=', $company_id)->get();

		#And delete all the users of the company
		foreach ($users as $user) {
			$user->enabled = false;
			$user->save();
		}
	    
	    try {
	        $company->save();
	    }
	    catch (Exception $e) {
	        return Redirect::to("/edit-company/$company_id")
	            ->with('flash_message', 'Company could not be deleted; please try again.')
	            ->withInput();
	    }

		return Redirect::to("/list-companies")->with('flash_message', "Company $company->name deleted.");
	}


}
