<?php

namespace system\Request\Traits;

use System\Database\DBConnection\DBConnection;

trait HasValidationRules
{
    public function normalValidation($name, $ruleArray)
    {
        foreach ($ruleArray as $rule) {
            if ($rule == 'required') {
                $this->required($name);
            } elseif (strpos($rule, "max:") === 0) {
                $rule = str_replace('max:', "", $rule);
                $this->maxStr($name, $rule);
            } elseif (strpos($rule, "min:") === 0) {
                $rule = str_replace('min:', "", $rule);
                $this->minStr($name, $rule);
            } elseif (strpos($rule, "exists:") === 0) {
                $rule = str_replace('exists:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);
            }
            elseif (strpos($rule, "unique:") === 0) {
                $rule = str_replace('unique:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->unique($name, $rule[0], $key);
            }
            elseif ($rule == 'confirmed') {
                $this->confirm($name);
            }
            elseif ($rule == 'email') {
                $this->email($name);
            }
            elseif ($rule == 'date') {
                $this->date($name);
            }
        }
    }

    public function numberValidation($name, $ruleArray)
    {
        foreach($ruleArray as $rule){
            if($rule == 'required')
                $this->required($name);
            elseif(strpos($rule, "max:") === 0)
            {
                $rule = str_replace('max:', "", $rule);
                $this->maxNumber($name, $rule);
            }
            elseif(strpos($rule, "min:") === 0)
            {
                $rule = str_replace('min:', "", $rule);
                $this->minNumber($name, $rule);
            }
            elseif(strpos($rule, "exists:") === 0)
            {
                $rule = str_replace('exists:', "", $rule);
                $rule = explode(',', $rule);
                $key = isset($rule[1]) == false ? null : $rule[1];
                $this->existsIn($name, $rule[0], $key);
            }
            elseif($rule == 'number')
            {
                $this->number($name);
            }
        }
    }
    protected function maxStr($name, $count)
    {
        if($this->checkFieldExist($name))
        {
            if(strlen($this->request[$name] >= $count && $this->firstError($name)))
            {
                $this->setError($name, "$name max number equal or higher".$count."counter");
            }
        }
    }
    protected function minStr($name, $count)
    {
        if($this->checkFieldExist($name))
        {
            if(strlen($this->request[$name] <= $count && $this->firstError($name)))
            {
                $this->setError($name, "$name min number equal or higher".$count."counter");
            }
        }
    }
    protected function maxNumber($name, $count)
    {
        if($this->checkFieldExist($name))
        {
            if($this->request['name'] >= $count && $this->firstError($name))
            {
                $this->setError($name, "$name max number equal or higher".$count."counter");
            }
        }
    }
    protected function minNumber($name, $count)
    {
        if($this->checkFieldExist($name))
        {
            if($this->request['name'] <= $count && $this->firstError($name))
            {
                $this->setError($name, "$name min number equal or lower".$count."counter");
            }
        }
    }
    protected function required($name)
    {
        {
            if((!isset($this->request[$name]) || $this->request[$name] === '') && $this->checkFirstError($name)){
                $this->setError($name,"$name is required");
            }
        }
    }
    protected function number($name)
    {
        if($this->checkFieldExist($name))
        {
            if(!is_numeric($this->request($name)) && $this->checkFirstError($name))
            {
                $this->setError($name, "$name name is required");
            }
        }
    }
    protected function date($name)
    {
        if($this->checkFieldExist($name))
        {
            if (!preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|1[0-9]|3[0-1]) / ",
             $this->request[$name]) && $this->checkFirstError($name))
                {
                $this->setError($name, "$name must be in date format");
                }
        }
    }
    protected function email($name)
    {
        if($this->checkFieldxist($name))
        {
            if(!filter_var($this->request[$name],FILTER_VALIDATE_EMAIL) && $this->checkFirstError($name))
            {
                $this->setError($name, "$name need to be in email format !");
            }
        }
    }
    public function existsIn($name, $table, $field='id')
    {
        if($this->checkFieldExist($name))
        {
            if($this->checkFirstError($name))
            {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?  ";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetchColumn();
                if($result == 0 || $result === false)
                {
                    $this->setError($name, "$name not already exist");
                }
            }
        } 
    }
    public function unique($name, $table, $field='id')
    {
        if($this->checkFieldExist($name))
        {
            if($this->checkFirstError($name))
            {
                $value = $this->$name;
                $sql = "SELECT COUNT(*) FROM $table WHERE $field = ?  ";
                $statement = DBConnection::getDBConnectionInstance()->prepare($sql);
                $statement->execute([$value]);
                $result = $statement->fetchColumn();
                if($result !=0 )
                {
                    $this->setError($name, "$name is already used");
                }
            }
        }
    }
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