<?php
    /**
     * Index - Next
     * --------------------------------------------------
     *
     * Início do CMS Next e chamada das principais requisições do CMS
     *
     */

    // Requisição das configurações do CMS
    $config = include_once('../config.php');

    // Requisição das rotas do CMS
    require_once('cms_routes.php');

    // Requisição das Bibliotecas Next
    require_once(realpath(dirname(__FILE__)).'/../libraries/database/dbAccess.php');
    require_once(realpath(dirname(__FILE__)).'/../libraries/kint/kint.php');

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../controllers/settingsController.php');
    require_once(realpath(dirname(__FILE__)) . '/../controllers/sectionsController.php');
    require_once(realpath(dirname(__FILE__)) . '/../controllers/rolesController.php');

    // Instancia os controladores principais Next
    $class_configs = new settingsController();
    $sec = new sectionsModel();
    $role = new rolesController();

    // Chama as classes principais de uso Next
    $configs = $class_configs->getConfigs();
    $pages = $sec->get();
    $pagina = (isset($_GET['page']))?$_GET['page']:"home";
    $pagina = $sec->getSingle($pagina);
    global $dataType,
           $user_id;

    // Inicia a sessão e verifica se o usuário está logado no site
    @session_start();
    if(!isset($_SESSION['auth']['mail'])){
        $log = false;
    }
    else {
        $log = true;
        $user_id = $_SESSION['auth']['id'];
        if(!isset($_GET['page']))
            header("location:".$_SERVER['REQUEST_URI'].'?page=home');
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <?php require_once('views/includes/head.php'); ?>
</head>

<body>

<?php
    if(!$log)
        require_once('views/login.php');
    else {
?>

    <?php require_once('views/includes/header.php'); ?>

    <div class="grid-row fluid content-holder">


        <?php require_once('views/includes/sidebar.php') ?>

        <div class="main">

            <div class="container-fluid">

                <?php include($page); ?>

                <?php include_once('views/includes/footer.php') ?>

            </div>

        </div>

    </div>
<?php } ?>

</body>

</html>