<?php
require_once(realpath(dirname(__FILE__))."/../models/postModel.php");

class postController extends postModel {

}

$save = new postController();

if(isset($_POST['post_edit']) || isset($_POST['post_new']) || isset($_POST['post_delete'])) {
    $dataModel = new postModel();
    $save->databaseEdit($dataModel);
}