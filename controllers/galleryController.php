<?php
require_once(realpath(dirname(__FILE__)) . "/../models/galleryModel.php");

class galleryController extends galleryModel {

}

$save = new galleryController();

if(isset($_POST['gallery_edit']) || isset($_POST['gallery_new']) || isset($_POST['gallery_delete'])) {
    $dataModel = new galleryModel();
    $save->databaseEdit($dataModel);
}