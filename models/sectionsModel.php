<?php
require_once(realpath(dirname(__FILE__))."/../controllers/core/nextController.php");

class sectionsModel extends nextController {

    const   key = 'id_section',
            table = 'sections',
            desc = 'a sessão',
            sub_table = 'sections_sub';

    /**
     * Gera a listagem das publicações no painel CMS
     * @param array $options
     * @return string
     */
    function get($options = ['order'=>'section_order']){
        if(!is_array($options)) $options = ['order'=>'section_order'];
        return parent::get($options);
    }

    /**
     * @param $slug
     * @return array|string|bool
     */
    function getSingle($slug) {
        $res = $this->db->selectSingleByField(self::table, 'section_slug', $slug);
        if(is_string($res))
            return $res;
        else if(count($res) == 0)
            return false;
        else
            return $res;
    }

    function getSub($options = []){
        $this->db->whereAnd(true);
        $this->lastInsertedId = false;
        $q = 'SELECT sub.* FROM '.static::sub_table.' AS sub INNER JOIN '.static::table.' AS sec ON sec.id_section = sub.fk_section ';
        if(!empty($options['cat']) && ((is_int($options['cat'])) || (is_string($options['cat']))))
            $q .= $this->db->whereAnd() . " sub.fk_section = '{$options['cat']}'";
        if(isset($options['order']) && is_string($options['order']) && $options['order'] != '') {
            $q .= ' ORDER BY sub.' . $options['order'];
            if(isset($options['desc']) && $options['desc'] === true)
                $q .= ' DESC ';
            if(isset($options['asc']) && $options['asc'] === true)
                $q .= ' ASC ';
        }
        return $this->db->fetch($q);
    }

}