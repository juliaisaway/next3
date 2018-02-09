<?php
require_once(realpath(dirname(__FILE__)) . '/../../libraries/database/databaseConfig.php');

abstract class nextModel {
    public $lastInsertedId;
    protected $db;
    const   key = 'pkfield',
            table = 'tblname',
            desc = 'the thing',
            dataT = 'dtype',
            cat = 'category';

    /**
     * wmClass constructor.
     */
    function __construct(){
        $this->db = new databaseConfig();
        $this->lastInsertedId = false;
    }

    /**
     * Cria um novo registro na tabela ou edita um existente caso o id do registro seja fornecido
     * @param $array array Vetor para ser registrado no banco na estrutura campo=>valor
     * @return string Resultado ou mensagem de erro da operação
     */
    public function set($array){
        $this->lastInsertedId = false;
        if(isset($array[static::key])){
            $modo = 'alterar';
            $id[static::key] = $array[static::key];
            unset($array[static::key]);
            $retorno = $this->db->update(static::table, $array, $id);
        }
        else{
            $modo = 'inserir';
            $retorno = $this->db->insert(static::table, $array);
            if($retorno === true)
                $this->lastInsertedId = $this->db->lastId();

        }
        if($retorno === true)
            return "OK";
        else
            return "Erro ao ".$modo." ".static::desc.": ".$retorno;
    }

    /**
     * Retorna todas as linhas do banco de dados numa array
     * @param array $options
     * @return array|bool|string
     */
    public function get($options){
        $this->lastInsertedId = false;
        $k = 'strval';
        $q = 'SELECT * FROM '.static::table;
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
     * Deleta (um ou) múltiplos registros
     * @param array|int $ids Ids que seram excluídos
     * @return string Resultado ou mensagem de erro da operação
     */
    public function delete($ids){
        $this->lastInsertedId = false;
        $retorno = true;
        if(is_numeric($ids))
            $ids = [$ids+0];
        foreach ($ids as $id){
            $identity[static::key] = $id;
            $retorno = $this->db->delete(static::table, $identity);
            if($retorno != true)
                break;
        }
        if($retorno === true)
            return "OK";
        else
            return "Erro ao deletar ".static::desc.": ".$retorno;
    }

}