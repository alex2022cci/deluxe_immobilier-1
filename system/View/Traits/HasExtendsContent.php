<?php

namespace System\View\Traits;

trait HasExtendsContent
{
    private $extendsContent;

    private function checkExtendsContent()
    {
        $layoutFilePath = $this->fileExtends();
        if($layoutFilePath)
        {   
            // viewloader() sert à aller chercher le fichier dans le répertoire "ressource"
            $this->extendsContent = $this->viewLoader($layoutFilePath); 

            $yieldsNamesArray = $this->findYieldsName();
            if($yieldsNamesArray)
            {
                foreach($yieldsNamesArray as $yieldName)
                {
                    $this->initialYields($yieldName);
                }
            }
            $this->content = $this->extendsContent;
        }
    }
    
    private function fileExtends()
    {
        $filePathArray = [];
        preg_match("/s*@extends+\('([^)]+)'\)/", $this->content, $filePathArray); 
        return isset($filePathArray[1]) ? $filePathArray[1] : false;

    }

    private function findYieldsName()
    {
        $yieldsNamesArray = [];
        preg_match("/s*@yield+\('([^)]+)'\)/", $this->extendsContent, $yieldsNamesArray, PREG_UNMATCHED_AS_NULL); 
        return isset($yieldsNamesArray[1]) ? $yieldsNamesArray[1] : false;
    }

    private function intialYields($yieldName)
    {
        $string = $this->content;
        
        // on va initialiser 
        $startWord = '@section('" . $yieldName ."')';
        $endWord = '@endsection';

        $startPos = strpos($string, $startWord);
        if($startPos === false)
        {
            return $this->extendsContent = str_replace("@yield('$yieldName')", "", $this->extendsContent);
        }
        $startPos += strlen($startWord);
        $endPos = strpos($string, $endWord, $startPos);
        if($endPos === false)
        {
            return $this->extendsContent = str_replace("@yield('$yieldName')", "", $this->extendsContent);
        }
        $length = $endPos - $startPos;
        $sectionContent = substr($string, $startPos, $length);
        
        return $this->extendsContent = str_replace("@yield('$yieldName')", $sectionContent, $this->extendsContent);
    }
}