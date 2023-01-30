<?php

namespace system\Request;

class Request 
{
    use HasValidationRules, HasFilesValidationRules, HasRunValidations;

    protected $errorExist = false;
    protected $request;
    protected $files = null;
    protected $errorVaribleName = [];

    public function __construct()
    {
        if(isset($_POST))
        {
            return $this->getAttributes();
        }
        if (!empty($_FILES))
        {
            $this->files = $_FILES;
        }

        $rules = $this->rules();
        
        empty($rules) ? : $this->run($rules);

        $this->errorRedirect();

        protected function rules()
        {
            return [];
        }
        protected function run($rules)
        {

        }

        protected function file($name)
        {

        }

        protected function postAttributes()
        {

        }

        public function all()
        {
            
        }
    }
}