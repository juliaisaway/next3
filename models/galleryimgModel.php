<?php
require_once(realpath(dirname(__FILE__))."/core/imageModel.php");

class galleryimgModel extends imageModel {
    const   key = 'galleryimg_id',
            table = 'galleries_img',
            desc = 'a imagem',
            dataT = 'galleryimg',
            folder = '../uploads/galleries/',
            filefield = 'galleryimg_file',
            order = 'galleryimg_order';

    function get($options = array()){
        $this->db->whereAnd(true);
        $this->lastInsertedId = false;
        $q = 'SELECT i.* FROM '.static::table.' AS i INNER JOIN galleries AS g ON g.gallery_id = i.fk_gallery ';
        if(!empty($options['gallery']) && is_string($options['gallery']))
        $q .= $this->db->whereAnd()." i.fk_gallery = '{$options['gallery']}'";
        if(!empty($options['slug']) && is_string($options['slug']))
            $q .= $this->db->whereAnd()." g.gallery_slug = '{$options['slug']}'";
        if(isset($options['order']) && is_string($options['order']) && $options['order'] != '') {
            $q .= ' ORDER BY i.' . $options['order'];
            if(isset($options['desc']) && $options['desc'] === true)
                $q .= ' DESC ';
            if(isset($options['asc']) && $options['asc'] === true)
                $q .= ' ASC ';
        }
        if(isset($options['limit']) && is_int($options['limit']) && $options['limit'] > 0)
            $q .= ' LIMIT '.$options['limit'];
        return $this->db->fetch($q);
    }

}