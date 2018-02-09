<?php
require_once(realpath(dirname(__FILE__))."/../controllers/core/nextController.php");

class galleryModel extends nextController{

    const   key = 'gallery_id',
            table = 'galleries',
            desc = 'a galeria',
            dataT = 'gallery',
            parent = 'galleries_img',
            fk_parent = 'fk_gallery';

    function delete($ids){
        $retorno = true;
        foreach ($ids as $id){
            if($this->checkIfExists($id)) {
                return 'Esta galeria possui imagens vinculados a ela';
                break;
            } else {
                $identity[self::key] = $id;
                $retorno = $this->db->delete(self::table, $identity);
                if($retorno != true)
                    break;
            }
        }
        if($retorno === true)
            return "OK";
        else
            return "Erro ao deletar ".static::desc.": ".$retorno;
    }

}