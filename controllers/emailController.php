<?php
require_once(realpath(dirname(__FILE__))."/../models/emailModel.php");
require_once(realpath(dirname(__FILE__))."/../controllers/traits/traitGravatar.php");
require_once(realpath(dirname(__FILE__)) . "/../libraries/PHPMailer/PHPMailerAutoload.php");

class emailController extends emailModel {

    use Gravatar;

}

$save = new emailController();

if(isset($_POST['media_edit']) || isset($_POST['media_new']) || isset($_POST['media_delete'])) {
    $dataModel = new emailModel();
    $save->databaseEdit($dataModel);
}