<?php 


class ValidateableEloquent extends Eloquent { 

    # For extending this class, each class should implement its own rules array
    protected $rules = array();

	# For holding the validation errors
    protected $errors;

	# Function to validate the class
    public function validate($data)
    {
        // make a new validator object
        $v = Validator::make($data, $this->rules);

        // check for failure
        if ($v->fails())
        {

            // set errors and return false
            $this->errors = $v->errors();
            return false;
        }
        var_dump($v);
        // validation pass
        return true;
    }

    # For reading the errors
    public function errors()
    {
        return $this->errors;
    }
    
}