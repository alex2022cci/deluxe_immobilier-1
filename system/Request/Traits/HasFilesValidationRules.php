<?php

namespace system\Request\Traits;

trait HasFilesValidationRules
{
    //fonction qui permet de refuser les tailles maximum 
    protected function maxFile($name, $size)
    {
       $size = $size * 1024 ;
       if($this->checkFirstError($name) && $this->checkFileExist($name))
       {
        if($this->files[$name]['size'] > $size)
        {
            $this->setError($name, "$name size must be lower than ".($size / 1024 )."kb");
        }
       }
    }

      //fonction qui permet de refuser les tailles minimum 
      protected function minFile($name, $size)
      {
        $size = $size * 1024 ;
        if($this->checkFirstError($name) && $this->checkFileExist($name))
        {
         if($this->files[$name]['size'] < $size)
         {
             $this->setError($name, "$name size must be greater than ".($size / 1024 )."kb");
         }
        }
      }

      // return type of file
      private function fileType($name,$typesArray)
      {
        if($this->checkFirstError($name) && $this->checkFileExist($name))
        {
            $currentTypeFile = explode('/', $this->file[$name]['type'])[1];
            if(!in_array($currentTypeFile, $typesArray))
            {
                $this->setError($name, "$name type must be" . implode(',', $typesArray));
            }
        }
      }
      //img must be nammed
      protected function fileRequired($name)
      {
        if(!isset($this->files[$name]['name'])|| empty($files[$name]['name']) && $this->checkFirstError($name))
        {
            $this->setError($name, '$name is required');
        }
      }

      protected function fileValidation($name,$ruleArray)
      {
        foreach($ruleArray as $rule)
        {
            if($rule === 'required')
            {
                $this->fileRequired($name);
            }
            elseif( strpos($rule, "mimes: ") === 0 )
            {
                $rule = str_replace("mimes:", "", $rule);
                $rule = explode(',', $rule);
                $this->fileType($name, $rule);
            }
            elseif(strpos($rule, "max:") === 0)
            {
                //taille max photo
                $rule = str_replace("max:", "", $rule);
                $this->maxFile($name, $rule);
            }
            elseif(strpos($rule, "min:") === 0)
            {
                //taille min photo
                $rule = str_replace("min:", "", $rule);
                $this->minFile($name, $rule);
            }
        }
      }
}
