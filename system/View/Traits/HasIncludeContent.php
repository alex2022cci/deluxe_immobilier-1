<?php 

namespace System\View\Traits;

trait HasIncludeContent
{
    private function checkIncludesContent()
    {
        while(1){
            $includesNamesArray = $this->findIncludesNames();
            if(!empty($includesNamesArray))
            {
                foreach($includesNamesArray as $includeNAme)
                {
                    $this->initialIncludes($includeNAme);
                }
            }
            else
            {
                break;
            }
        }
    }
    private function findIncludesNames()
    {
        $includesNamesArray = [];
        preg_match("/s*@includes+\('([^)]+)'\)/", $this->content, $includesNamesArray, PREG_UNMATCHED_AS_NULL);
        return isset($includesNamesArray[1]) ? $includesNamesArray : false;
    }

    private function initialIncludes($includeNAme)
    {
        $this->content =  str_replace("@include('$includeName')", $this->viewloader($includeNAme), $this->content);
    }

}