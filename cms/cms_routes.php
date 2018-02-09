<?php
    /**
     * Rotas das páginas - Next
     * --------------------------------------------------
     *
     * Aqui ficam todas as rotas relacionadas ao CMS
     *
     */

    // Inclusão da blioteca principal de rotas
    include_once('../libraries/routes/routesConfig.php');

    // Define os valores iniciais de $_GET
    (isset($_GET['page'])?$_GET['page']:$_GET['page'] = '');

    // Início das rotas
    switch($_GET['page']){

        case 'gallery':
            if(isset($_GET['action']))
                switch ($_GET['action']) {
                    case 'edit': case 'new': $page = "views/gallery/gallery-edit.php"; break;
                    default: $page = "views/gallery/gallery.php"; break;
                }
            else
                $page = "views/gallery/gallery.php";
            break;

        case 'media':
            if(isset($_GET['action']))
                switch ($_GET['action']) {
                    case 'edit': case 'new': $page = "views/media/media-edit.php"; break;
                    default: $page = "views/media/media.php"; break;
                }
            else
                $page = "views/media/media.php";
            break;

        case 'post':
            if(isset($_GET['action']))
                switch ($_GET['action']) {
                    case 'edit': case 'new': $page = "views/post/posts-edit.php"; break;
                    default: $page = "views/post/posts.php"; break;
                }
            else
                $page = "views/post/posts.php";
            break;

        case 'category':
            if(isset($_GET['action']))
                switch ($_GET['action']) {
                    case 'edit': case 'new': $page = "views/category/categories-edit.php"; break;
                    default: $page = "views/category/categories.php"; break;
                }
            else
                $page = "views/category/categories.php";
            break;

        case 'emails':
            if(isset($_GET['action']))
                switch ($_GET['action']) {
                    case 'view': $page = "views/email/email-view.php"; break;
                    default: $page = "views/email/email.php"; break;
                }
            else
                $page = "views/email/email.php";
            break;

        case 'user':
            if(isset($_GET['action']))
                switch ($_GET['action']) {
                    case 'edit': case 'new': $page = "views/user/user-edit.php"; break;
                    default: $page = "views/user/user.php"; break;
                }
            else
                $page = "views/user/user.php";
            break;

        case 'settings':
            if(isset($_GET['action']))
                switch ($_GET['action']) {
                    case 'edit': case 'new': $page = "views/settings/settings-edit.php"; break;
                    default: $page = "views/settings/settings.php"; break;
                }
            else
                $page = "views/settings/settings.php";
            break;

        case 'home':
        case 'dashboard':
        case '':
            if(isset($_GET['action']) && $_GET['action'] == 'logout'){
                $page = "/../controllers/userController.php";
            } else {
                $_GET['page'] = 'home';
                $page = "views/home.php";
            }
            break;
        default:
            $page = "views/home.php";
            break;
    }