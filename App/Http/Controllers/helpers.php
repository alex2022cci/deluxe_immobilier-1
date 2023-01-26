<?php 

    function sidebarActive($url, $contain = true)
    {
        // On va aficher notre bannière(slider)

        //Pour vérifier si la contrainte = true
        if($contain)
        return (strpos(currentUrl(), $url) === 0) ? 'active' : '';
        else
        return $url === current() ? 'active' : '';

    }

    function errorClass($name)
    {
        return errorExist($name) ? 'is_invalid' : '';
    }

    function errorText($name)
    {
        return errorExist($name) ? '<div><small class="text-danger">'.error($name).'</small></div>"' : '';
    }

    function oldOrValue($name, $value)
    {
        return empty(old($name)) ? $values : old($name);
    }

    function paginate($data, $perPage)
    {
        // On va calculer le nombre de ligne que nous avons depuis notre base de données
        $totalRow = count($data);
        
        // On verifie sur quel page nous sommes
        $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

        // On doit aller calculer le nombre de page que nous devons avoir 
        $totalPages = ceil($totalRow / $perPage);
        $currentPage = min($currentPage, $totalPages);
        $currentPage = max($currentPage, 1);

        $currentRow = ($currentPage -1) * $perPage;
        $data = array_slice($data, $currentRow, $perPage);

        return $data;
    }

    // On va faire l'affichage de notre HTML pour les pages suivantes

    function paginateView($data, $perPage)
    {
          // On va calculer le nombre de ligne que nous avons depuis notre base de données
          $totalRow = count($data);
        
          // On verifie sur quel page nous sommes
          $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
  
          // On doit aller calculer le nombre de page que nous devons avoir 
          $totalPages = ceil($totalRow / $perPage);
          $currentPage = min($currentPage, $totalPages);
          $currentPage = max($currentPage, 1);

          $paginateView = '';

          // Pour faire la fleche vers la gauche (quand je suis sur la page 1)  1 2 3 >
          $paginateView .= ($currentPage != 1) ? '<li><a href="'.paginateUrl(1).'">&lt;</a></li>' : '';

          // Pour faire la fleche vers la droite et la gauche (quand je suis sur la page 2) < 1 2 3 >
          $paginateView .= (($currentPage -2) >=1) ? '<li><a href="'.paginateUrl($currentPage -2).'">'.($currentPage-2).'</a></li>' : '';
          
          // Pour faire la fleche vers la gauche (quand je suis sur la page 1) < 1 2 3 
          $paginateView .= (($currentPage -1) >=1) ? '<li><a href="'.paginateUrl($currentPage -1).'">'.($currentPage-1).'</a></li>' : '';
          $paginateView .= '<li class="active"><a href="'.paginateUrl($currentPage).'"</li>';

          // Pour passer aux numeros de pages au click 
          $paginateView .= (($currentPage +1) <=$totalPages) ? '<li><a href="'.paginateUrl($currentPage +1).'">'.($currentPage+1).'</a></li>' : '';
          $paginateView .= (($currentPage +2) <=$totalPages) ? '<li><a href="'.paginateUrl($currentPage +2).'">'.($currentPage+2).'</a></li>' : '';
          $paginateView .= (($currentPage +1) <=$totalPages) ? '<li><a href="'.paginateUrl($currentPage +1).'">'.($currentPage+1).'</a></li>' : '';
          $paginateView .= ($currentPage != $totalPages) ? '<li><a href="'.paginateUrl($totalPages).'">&gt;</a></li>' : '';

        //  Pour afficher les numeros de page en li
          return '
                <div class="row mt-5">
                    <div class="row text-center">
                        <div class="block-27">
                            <ul>
                                '.$paginateView.'
                            </ul>
                        </div>
                    </div>
                </div>
          ';
    }

    function paginateUrl()
    {
        // On va chercher dans notre tableau tout ce que nous avons apres notre '?'
        $urlArray = explode('?', currentUrl());
        if(isset($urlArray[1]))
        {
            $_GET[$page] = $page;
            $getVariable = array_map(
                function($value, $key)
                {
                    return $key.'='.$value;
                }, 
                $_GET, array_keys($_GET)
            );
            return $urlArray[0].'?'.implode('', $getVariable);
        }
        else
        {
            return currentUrl().'?page='.$page;
        }
    }

    
    


