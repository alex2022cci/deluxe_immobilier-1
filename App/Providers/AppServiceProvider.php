<?php




    namespace App\Providers;

    // Importation de mes class
    use App\Providers\Provider;
    use System\View\Composer;
    use App\Ads;
    use App\Post;
    use App\User;


    class AppServiceProvider extends Provider
    {
        public function boot()
        {
            Composer::view("app.index", function()
            {
                // Gestion dans la base de données
                $ads = Ads::all();
                $sumArea = 0;
                foreach ($ads as $advertise)
                {
                    $sumArea += (int) $advertise->area;
                }
                $usersCount = count(User::all());
                $postsCount = count(Post::all());
                return [
                    "sumArea" => $sumArea,
                    "usersCount" => $usersCount,
                    "addCount" => count($ads),
                    "postsCount" => $postsCount
                ];                     
            });
        }
    }