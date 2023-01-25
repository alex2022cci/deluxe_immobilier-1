<?php

    namespace System\Database\Traits;

    use System\Database\DBConnection\DBConnection;
    
    trait HasCRUD
    {
        protected function createMethod(){}
        protected function updateMethod(){}
        protected function deleteMethod(){}
        protected function allMethod(){}
        protected function findMethod(){}
        protected function whereMethod(){}
        protected function whereOrMethod(){}
        protected function whereNullMethod(){}
        protected function whereNotNullMethod(){}
        protected function whereInMethod(){}
        protected function orderByMethod(){}
        protected function limitMethod(){}
        protected function getMethod(){}
        protected function paginateMethod(){}
        protected function saveMethod(){}
        protected function fill(){}
    }