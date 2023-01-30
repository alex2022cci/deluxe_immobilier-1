<!DOCTYPE html>
<html lang="fr">
<head>

    <!-- l'import de tous les scripts css -->
    @include('app.layouts.head-tag')
    @yield('head-tag')

</head>
<body class="text-right">

    <!-- On va decouper notre template  -->
    
    <!-- On va y mettre notre navbar -->
    @include('app.layouts.navbar')

    <!-- Contenus -->
    @yield('content')

    <!-- footer -->
    @include('app.layouts.footer')

    <!-- on va y mettre son loader -->
    <div class="ftco-loader show fullscreen">
        <svg class="circular" width="48" height="48" >
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee">
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"stroke-miterlimit="10" stroke="#f96d00">
        </svg>
    </div>

    <!-- Nous allons importer nos fichiers en Javascript -->
    @include('app.layouts.scripts')
    @yield('script')

</body>

</html>