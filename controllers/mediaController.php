<?php
require_once(realpath(dirname(__FILE__))."/../models/mediaModel.php");

class mediaController extends mediaModel {

}

$save = new mediaController();

if(isset($_POST['media_edit']) || isset($_POST['media_new']) || isset($_POST['media_delete'])) {
    $dataModel = new mediaModel();
    $save->databaseEdit($dataModel);
}