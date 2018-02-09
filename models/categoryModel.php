<?php
require_once(realpath(dirname(__FILE__))."/../controllers/core/nextController.php");
require_once(realpath(dirname(__FILE__))."/../controllers/traits/traitSlugify.php");

class categoryModel extends nextController {
    use traitSlugify;

    const   key = 'category_id',
            table = 'categories',
            desc = 'a categoria',
            dataT = 'category',
            parent = 'posts',
            fk_parent = 'fk_category';

    /**
     * Deleta a categoria selecionada
     * @param array $ids
     * @return string
     */
    function delete($ids){
        $retorno = true;
        foreach ($ids as $id){
            if($this->checkIfExists($id)) {
                return "Esta categoria possui publicações vinculados a ela";
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

    /**
     * Retorna a categoria específica baseada na slug
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

}