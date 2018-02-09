<?php
require_once(realpath(dirname(__FILE__))."/core/imageModel.php");

class mediaModel extends imageModel {
    const   key = 'media_id',
            table = 'media',
            desc = 'a imagem',
            dataT = 'media',
            folder = '../uploads/media/',
            filefield = 'media_file';

}