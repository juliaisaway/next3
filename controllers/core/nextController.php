<?php
require_once(realpath(dirname(__FILE__)) . '/../../models/core/nextModel.php');
require_once(realpath(dirname(__FILE__)) . '/../../libraries/database/dbAccess.php');

abstract class nextController extends nextModel {

    const   parent = 'posts',
            fk_parent = 'fk_category';

    /**
     * nextController constructor.
     */
    public function __construct(){
        $this->lastInsertedId = false;
        $this->db = new dbAccess();
    }

    /**
     * Retorna todas as linhas do banco de dados numa array
     * @param array $options
     * @return array|bool|string
     */
    public function get($options = []){
        if(!is_array($options)) $options = [];
        return parent::get($options);
    }

    /**
     * Checa se existe algum item na tabela selecionada
     * @param int $id
     * @return bool|string
     */
    function checkIfExists($id) {
        $res = $this->db->selectSingleByField(static::parent, static::fk_parent, $id);
        if(is_string($res)){
            return $res;
        }
        return (count($res) != 0);
    }

    /**
     * Retorna todas as IDs de uma determinada tabela
     * @return array
     */
    function getAllValues() {
        $q = "SELECT DISTINCT ".static::key." FROM ".static::table;
        $res = $this->db->query($q);
        $retorno = array();
        while ($list = $res->fetch_assoc()) {
            $retorno[] = $list[static::key];
        }
        return $retorno;
    }

    /**
     * Pega os valores do formulário e salva/edita/deleta no banco de dados.
     * @param $class - classe a ser chamada
     */
    public function databaseEdit($class) {

        require_once(realpath(dirname(__FILE__)).'/../../models/'.static::dataT.'Model.php');

        $db = $class;
        $opt = $_POST;

        unset($opt[static::dataT.'_edit'], $opt[static::dataT.'_new'], $opt[static::dataT.'_delete'], $opt[static::dataT.'_realpath']);

        if(isset($opt[static::dataT.'_password']) && $opt[static::dataT.'_password'] != '')
            $opt[static::dataT.'_password'] = password_hash($opt[static::dataT.'_password'], PASSWORD_DEFAULT);
        else
            unset($opt[static::dataT.'_password']);

        if(isset($_FILES[static::dataT.'_file']) && $_FILES[static::dataT.'_file']['size'] > 0)
            $opt[static::dataT . '_file'] = $_FILES[static::dataT.'_file'];

        if(isset($_POST[static::dataT.'_delete']))
            $r = $db->delete($opt);
        else
            $r = $db->set($opt);
        echo $r;

    }

}