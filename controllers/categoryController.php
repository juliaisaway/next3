<?php
require_once(realpath(dirname(__FILE__)) . "/../models/categoryModel.php");

class categoryController extends categoryModel {

}

$save = new categoryController();

if(isset($_POST['category_edit']) || isset($_POST['category_new']) || isset($_POST['category_delete'])) {
    $dataModel = new categoryModel();
    $save->databaseEdit($dataModel);
}