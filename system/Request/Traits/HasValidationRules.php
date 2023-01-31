<?php

namespace system\Request\Traits;

trait HasValidationRules
{
    public function normalValidation($name, $ruleArray)
    {

    }

    public function numberValidation($name, $ruleArray){}
    protected function maxStr($name, $count){}
    protected function minStr($name, $count){}
    protected function maxNumber($name, $count){}
    protected function minNumber($name, $count){}
    protected function required($name){}
    protected function number($name){}
    protected function date($name){}
    protected function email($name){}
    public function existsIn($name, $table, $field='id'){}
    public function unique($name, $table, $field='id'){}
    protected function confirm($name)
    {
        if($this->checkFieldExist($name))
        {
            $fieldName = 'confirm_' . $name;
            if(!isset($this->$fieldName))
            {
                $this->setError($name, " $name $fieldName not exist");
            } 
            elseif($this->$fieldName != $this->$name)
            {
                $this->setError($name, " $name confirmation doesn't match");
            }
        }
    }


}