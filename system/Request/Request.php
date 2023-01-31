<?php

namespace system\Request;

use system\Request\Traits\HasRunValidations;
use system\Request\Traits\HasValidationRules;
use system\Request\Traits\HasFilesValidationRules;

class Request 
{
    use HasValidationRules, HasFilesValidationRules, HasRunValidations;

    protected $errorExist = false;
    protected $request;
    protected $files = null;
    protected $errorVariblesName = [];

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
        
        empty($rules) ?  : $this->run($rules);

        $this->errorRedirect();
    }
        protected function rules()
        {
            return [];
        }

        protected function run($rules)
        {
            //POUR LES IMG
            foreach ($rules as $att => $values) {
                //démonter le tableau dans un autre à cause du ||
                $ruleArray = explode('|',$values );
                if(in_array('files', $ruleArray))
                {
                    //nous allons détruire les él_ts ds le tableau
                    unset($ruleArray[array_search('files', $ruleArray)]);

                    //nous allons passer dans une nouvelle fonction la validation
                    $this->fileValidation($att, $ruleArray);


                }
                elseif(in_array('number', $ruleArray))
                {
                    $this->numberValidation($att, $ruleArray);
                }
                else 
                {
                    //validation normale
                    $this->normalValidation($att, $ruleArray);
                }
            }
        }

        protected function file($name)
        {
            return isset($this->files[$name]) ? $this->files[$name] : false ;
        }

        protected function postAttributes()
        {
            foreach($_POST as $key => $value)
            {
                $this->$key = htmlentities($value);
                $this->request[$key] = htmlentities($value);
            }
        }

        public function all()
        {
            return $this->request;
        }
    }
