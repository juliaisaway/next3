<?php
require_once(realpath(dirname(__FILE__))."/../controllers/core/nextController.php");
require_once(realpath(dirname(__FILE__))."/../controllers/traits/traitSlugify.php");
require_once(realpath(dirname(__FILE__))."/../controllers/traits/traitBreadcrumb.php");

class postModel extends nextController {
    use traitSlugify;
    use traitBreadcrumb;

    const   key = 'post_id',
            table = 'posts',
            desc = 'a publicação',
            dataT = 'post',
            cat = 'categories',
            folder = '../uploads/posts/';


    function get($options = []){
        $this->lastInsertedId = false;
        $k = 'strval';
        $q = 'SELECT *, cat.* FROM '.self::table.' INNER JOIN '.self::cat.' AS cat ON fk_category = cat.category_id';
        if(!empty($options['id']) && ((is_int($options['id'])) || (is_string($options['id']))))
            $q .= $this->db->whereAnd() . " `{$k(static::key)}` = {$options['id']}";
        if(isset($options['order']) && is_string($options['order']) && $options['order'] != '') {
            $q .= ' ORDER BY ' . $options['order'];
            if(isset($options['desc']) && $options['desc'] === true)
                $q .= ' DESC ';
            if(isset($options['asc']) && $options['asc'] === true)
                $q .= ' ASC ';
        }
        if(isset($options['limit']) && is_int($options['limit']) && $options['limit'] > 0)
            $q .= ' LIMIT '.$options['limit'];
        return $this->db->fetch($q);
    }

    /**
     * Retorna a categoria específica baseada no Slug
     * @param string $slug
     * @return array|bool
     */
    function getSingleBySlug($slug) {
        $res = $this->db->selectSingleByField(self::table,self::dataT.'_slug',$slug);
        if(!is_array($res))
            return false;
        else
            return $res;
    }

    function set($array){

        if(isset($array[self::dataT.'_title']))
            $array[self::dataT.'_slug'] = $this->slugify($array[self::dataT.'_title']);

        $file = '';
        if(isset($array[self::dataT.'_file'])) {
            $file = $array[self::dataT.'_file'];
            $array[self::dataT.'_file'] = $file['name'];

            if(!is_dir(self::folder)) {
                mkdir(self::folder,0777, true);
            }
            $uploaddir = self::folder;
            $uploadfile = $uploaddir.trim($array[self::dataT.'_file']);
            move_uploaded_file($file['tmp_name'], $uploadfile);
        }
        return parent::set($array);

    }

}