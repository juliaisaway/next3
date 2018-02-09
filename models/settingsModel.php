<?php
require_once(realpath(dirname(__FILE__))."/../controllers/core/nextController.php");
require_once(realpath(dirname(__FILE__))."/../controllers/traits/traitSlugify.php");

class settingsModel extends nextController {
    use traitSlugify;

    const   key = 'settings_id',
            table = 'settings',
            desc = 'a configuração',
            dataT = 'settings',
            cat = 'settings_cat';

    /**
     * Gera a listagem das configurações da categoria selecionada no painel CMS
     * @param array $options
     * @return array|string|bool
     */
    function get($options = []){
        if (!isset($options['categoria']) || !is_int($options['categoria']+0))
            return 'Parâmetro categoria deve ser fornecido!';
        $q = 'SELECT conf.*, cat.cat_id FROM '.self::table.' AS conf INNER JOIN '.self::cat.' AS cat ON conf.settings_category = cat.cat_id ';
        if(!empty($options['categoria']) && (is_int($options['categoria']+0)))
            $q .= $this->db->whereAnd() . " cat.cat_id = '{$options['categoria']}'";
        return $this->db->fetch($q);
    }

    /**
     * @param $id
     * @return array|bool|object|string
     */
    function selectSingle($id) {
        $res = $this->db->selectSingle(self::table, $id);
        if(!is_array($res))
            return false;
        else
            return $res;
    }

    /**
     * Gera a listagem de todas as categorias no painel CMS
     * @return array|string|bool
     */
    function getConfigCat($options = []){
        $this->db->whereAnd(true);
        $this->lastInsertedId = false;
        $q = 'SELECT * FROM '.self::cat;
        if(!empty($options['slug']) && (is_string($options['slug'])))
            $q .= $this->db->whereAnd() . " cat_slug = '{$options['slug']}'";
        return $this->db->fetch($q);
    }

    /**
     * Retorna os valores das configurações salvas no banco de dados
     * @return object
     */
    function getConfigs() {
        $q = 'SELECT * FROM '.self::table;
        $res = $this->db->query($q);
        $configs = (object) array();
        while ($row = $res->fetch_object()){
            $configs->{$row->settings_key} = $row->settings_value;
        }
        return $configs;
    }
}