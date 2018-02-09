<?php
date_default_timezone_set('America/Sao_Paulo');

class databaseConfig{

    /**
     * @var mysqli $con Conexão com o banco de dados
     * @var bool $whand Controlador de WHERE/AND
     */
    protected $con, $whand;

    /**
     * wmdbAccess constructor.
     * Ativa a conexão com banco de dados usando MySQLi
     * @param string $host  Can be either a host name or an IP address. Passing the NULL value or the string "localhost" to this parameter, the local host is assumed. When possible, pipes will be used instead of the TCP/IP protocol. Prepending host by p: opens a persistent connection. mysqli_change_user() is automatically called on connections opened from the connection pool. Defaults to ini_get("mysqli.default_host")
     * @param string $user  The MySQL user name. Defaults to ini_get("mysqli.default_user")
     * @param string $pswd  If not provided or NULL, the MySQL server will attempt to authenticate the user against those user records which have no password only. This allows one username to be used with different permissions (depending on if a password as provided or not). Defaults to ini_get("mysqli.default_pw")
     * @param string $db    If provided will specify the default database to be used when performing queries. Defaults to ""
     */
    function __construct($host, $user, $pswd, $db){

        $con = new mysqli($host, $user, $pswd, $db);
        if ($con->connect_errno) {
            echo "Falha ao conectar-se ao banco de dados: (" . $con->connect_errno . ") " . $con->connect_error;
            $this->con = false;
        }
        else{
            $this->whand = false;
            $con->set_charset('utf8');
            $this->con = $con;
        }

    }

    /**
     * Fecha a conexão com o banco de dados
     */
    function __destruct(){
        $this->con->close();
    }

    /**
     * Resolve uma query SQL
     * @param string $query A query SQL a ser executada
     * @param int $resultmode
     * @return mysqli_result|string Retorna o objeto mysqli_result  resultado do query ou então o erro mysql em string
     */
    function query($query, $resultmode = MYSQLI_STORE_RESULT){
        $this->whand = false;
        $res = $this->con->query($query, $resultmode);
        if($res === false)
            return $this->con->error;
        return $res;
    }

    /**
     * Cria e executa uma query de inserção no banco de dados, com os valores de um array
     * @param string $table Nome da tabela
     * @param array $data Array de dados a serem inseridos, onde a chave deve ser o nome do campo
     * @return bool|string Retorna true caso a inserção suceda, caso contrário, retorna o erro em string
     */
    function insert($table, $data){
        $table = $this->sanitize($table);
        $data = $this->sanitize($data);
        $fields = $values = '';
        foreach ($data as $key=>$value){
            $fields.= '`'.$key.'`,';
            if(is_array($value))
                $value = json_encode($value);
            $values.= "'".$value."',";
        }
        $fields = rtrim($fields,',');
        $values = rtrim($values,',');
        $query = "INSERT INTO `".$table."` (".$fields.") VALUES (".$values.")";
        if($this->con->query($query) == true)
            return true;
        else
            return $this->con->error;
    }

    /**
     * Cria e executa uma query de atualização de linha no banco de dados, com os valores de um array
     * @param string $table Nome da tabela
     * @param array $data Campo=>Valor; Array de dados a serem inseridos, onde a chave deve ser o nome do campo
     * @param array $id Campo=>Valor; Array de identificação, onde a chave deve ser o nome do campo chave primária
     * @return bool|string Retorna true caso a edição suceda, caso contrário, retorna o erro em string
     */
    function update($table, $data, $id){
        $table = $this->sanitize($table);
        $data = $this->sanitize($data);
        $id = $this->sanitize($id);
        $changes = '';
        foreach ($data as $key=>$value){
            if(isset($value) && $value === '')
                return "Valor inválido na chave {$key}!";
            $changes.= '`'.$key.'` = \''.$value.'\',';
        }
        $changes = rtrim($changes,',');
        $key = array_keys($id);
        $identity = '`'.$key[0].'` = "'.$id[$key[0]].'"';
        $query = "UPDATE `".$table."` SET  ".$changes." WHERE ".$identity;
        if($this->con->query($query) == true)
            return true;
        else
            return $this->con->error;
    }

    /**
     * Cria e executa uma query de exclusão de uma linha no banco de dados
     * @param string $table Nome da tabela
     * @param array $id Array de identificação, onde a chave deve ser o nome do campo chave primária
     * @return bool|string Retorna true caso a exclusão suceda, caso contrário, retorna o erro em string
     */
    function delete($table, $id){
        $table = $this->sanitize($table);
        $id = $this->sanitize($id);
        $identity = [];
        foreach ($id as $key=>$val)
            $identity[] = '`'.$key.'` = "'.$val.'"';
        $query = "DELETE FROM `".$table."` WHERE ".implode(' AND ', $identity);
        if($this->con->query($query) == true)
            return true;
        else
            return $this->con->error;
    }

    /**
     * Resolve a query, já retornando o array de valores, ou false caso falhe
     * @param string $query
     * @param bool $object Se true, a array retornada será uma array de objetos
     * @return array|string|bool
     */
    function fetch($query, $object = false){
        $res = $this->query($query);
        if(is_string($res))
            return $res." - Query: \"{$query}\"";
        else if($res->num_rows == 0)
            return false;
        else
            return $this->fetch_all($res, $object);
    }


    /**
     * Obtém todas as tabelas da base de dados atual, se $search for passado,
     * busca tabelas com o nome parecido com $search
     * @param string $search
     * @return array|bool
     */
    function selectTables($search = ''){
        $q = "SHOW TABLES";
        if(is_string($search) && $search != ''){
            $search = $this->sanitize($search);
            $q .= " LIKE '%{$search}%'";
        }
        $res = $this->query($q);
        if($res->num_rows == 0)
            return false;
        else{
            $retorno = [];
            while ($row = $res->fetch_row()){
                $retorno[] = $row[0];
            }
            return $retorno;
        }
    }

    /**
     * Cria e executa uma query simples de busca, que retorna todos os campos, no banco de dados, baseado no id passado
     * @param string $table Nome da tabela
     * @param int $id Número de id, a função busca o campo de chave primária
     * @param bool $object Retorna um objeto em vem de array
     * @return array|string|object
     */
    function selectSingle($table, $id, $object = false){
        $table = $this->sanitize($table);
        $id = $this->sanitize($id);
        $key = $this->con->query('SHOW KEYS FROM `'.$table.'` WHERE Key_name = "PRIMARY"');
        if(!($key->num_rows>0))
            return 'Tabela "'.$table.'" não encontrada!';
        $key = $key->fetch_assoc();
        $identity = '`'.$key['Column_name'].'` = "'.$id.'"';
        $query = "SELECT * FROM `".$table."` WHERE ".$identity." LIMIT 1";
        $res = $this->con->query($query);
        if($res == false)
            return $this->con->error;
        if($object)
            return $res->fetch_object();
        else
            return $res->fetch_assoc();
    }

    /**
     * @param string $table
     * @param string $field
     * @param int|string $value
     * @return array|string
     */
    function selectSingleByField($table, $field, $value){
        $table = $this->sanitize($table);
        $field = $this->sanitize($field);
        $value = $this->sanitize($value);
        $query = "SELECT * FROM `{$table}` WHERE {$table}.{$field} = '{$value}' LIMIT 1";
        $res = $this->con->query($query);
        if($res == false)
            return $this->con->error;
        else
            return $res->fetch_assoc();
    }

    /**
     * @param string $table
     * @param string $field
     * @param int|string $value
     * @return array|bool|string
     */
    function selectAllByField($table, $field, $value){
        $table = $this->sanitize($table);
        $field = $this->sanitize($field);
        $value = $this->sanitize($value);
        $query = "SELECT * FROM `{$table}` WHERE {$table}.{$field} = '{$value}'";
        return $this->fetch($query);
    }

    /**
     * @param string $table
     * @param string $field
     * @param object $object
     * @param int|string $value
     * @return array|string
     */
    function selectSingleByFields($table, $options, $object= false){
        $table = $this->sanitize($table);
        $options = $this->sanitize($options);
        $where = [];
        foreach ($options as $key=>$val)
            $where[]  = " {$table}.{$key} = '{$val}'";
        $query = "SELECT * FROM `{$table}` WHERE ".implode(" AND ", $where)." LIMIT 1";
        $res = $this->con->query($query);
        if($res == false)
            return $this->con->error;
        else if($object == true)
            return $res->fetch_object();
        else
            return $res->fetch_assoc();
    }

    /**
     * Busca valores de forma randômica
     * @param string $table
     * @param int $limit
     * @param bool $object
     * @return array|bool|string
     */
    function selectRandom($table, $limit = 0, $object = false){
        list($table, $limit) = $this->sanitize([$table, $limit]);
        $query = "SELECT * FROM `{$table}` ORDER BY RAND()";
        if(is_numeric($limit) && $limit > 0)
            $query .= " LIMIT {$limit}";
        return $this->fetch($query, $object);
    }

    /**
     * Retorna a chave primária da última query realizada
     * @return int Chave primária da última query realizada
     */
    function lastId(){
        return $this->con->insert_id;
    }

    /**
     * @param bool $reset
     * @return bool|string
     */
    function whereAnd($reset = false){
        if($reset){
            $this->whand = false;
            return $reset;
        }
        if($this->whand){
            return " AND ";
        }
        else{
            $this->whand = true;
            return " WHERE ";
        }
    }

    /**
     * Quebra uma array associativa em uma nova array que contém no primeiro membro o array de chaves e no segundo
     * membro o array de valores da original
     * @param array $array Matriz associativa a ser separada
     * @return array
     */
    function keyValSplitter($array){
        $keys = [];
        $values = [];
        foreach ($array as $key => $value){
            $keys[] = $key;
            $values[] = $value;
        }
        $retorno = [$keys, $values];
        return $retorno;
    }

    /**
     * Escapa variáveis para utilização em queries, no caso de arrays, faz o loop recursivo para escapar seus valores
     * @param array|string $data
     * @return array|string Variável com valores escapados
     */
    function sanitize($data){
        if(is_string($data))
            $retorno = $this->con->real_escape_string($data);
        else if(is_array($data)){
            $retorno = [];
            foreach ($data as $key => $val)
                $retorno[$this->sanitize($key)] = $this->sanitize($val);
        }
        else
            $retorno = $data;
        return $retorno;
    }

    /**
     * Função semelhante à função padrão mysqli_result::fetch_all, porém feita aqui disponível para versões do PHP
     * anteriores à 5.3
     * @param mysqli_result $res Objeto MySQLi_Result a ser obtido
     * @param bool $object Se o resultado deve ser um objeto
     * @param int $resulttype
     * @return array
     */
    function fetch_all($res, $object = false, $resulttype = MYSQLI_ASSOC){
        if (!$object && method_exists('mysqli_result', 'fetch_all')) # Compatibility layer with PHP < 5.3
            return $res->fetch_all($resulttype);
        else
            if($object)
                for ($retorno = array(); $tmp = $res->fetch_object();) $retorno[] = $tmp;
        else
            for ($retorno = array(); $tmp = $res->fetch_array($resulttype);) $retorno[] = $tmp;

        return $retorno;
    }
}