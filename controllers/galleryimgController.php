<?php
require_once(realpath(dirname(__FILE__)) . "/../models/galleryimgModel.php");

class galleryimgController extends galleryimgModel {

}

$save = new galleryimgController();

if(isset($_POST['galleryimg_edit']) || isset($_POST['galleryimg_new']) || isset($_POST['galleryimg_delete'])) {
    $dataModel = new galleryimgModel();
    $save->databaseEdit($dataModel);
}

else if(!empty($_POST['do']) && $_POST['do'] == "order"){
    $obimg = new galleryimgController();
    $opt = $_POST['galleryimg_order'];

    echo $obimg->setOrdem($opt);
}