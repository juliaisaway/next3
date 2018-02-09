<?php
require_once(realpath(dirname(__FILE__)) . "/../models/settingsModel.php");

class settingsController extends settingsModel {

}

$save = new settingsController();

if(isset($_POST['settings_edit']) || isset($_POST['settings_new']) || isset($_POST['settings_delete'])) {
    $dataModel = new settingsModel();
    $save->databaseEdit($dataModel);
}