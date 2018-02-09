<?php
require_once(realpath(dirname(__FILE__))."/../models/userModel.php");

class userController extends userModel {

    function getUserId(){
        $user_id = '';
    }

}

$save = new userController();

if(isset($_POST['user_edit']) || isset($_POST['user_new']) || isset($_POST['user_delete'])) {
    $dataModel = new userModel();
    $save->databaseEdit($dataModel);
}

else if(isset($_POST['login']) || isset($_GET['login'])){
    @session_start();
    if(isset($_POST['adm-user']) && isset($_POST['adm-pswd'])) {
        require_once(realpath(dirname(__FILE__))."/../libraries/database/dbAccess.php");
        $db = new dbAccess();
        if($db->login($_POST['adm-user'], $_POST['adm-pswd']))
            echo 'OK';
        else
            echo 'Usuário e/ou senha inválidos!';
    }
    else {
        session_destroy();
        header("location:../cms/", true, 302);
        exit;
    }
} else if(isset($_GET['action']) && $_GET['action'] == "logout"){
    session_destroy();
    echo '<script> location.replace("../cms/"); </script>';
    exit;
}