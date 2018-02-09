<?php
require_once(realpath(dirname(__FILE__)).'/../../config.php');
require_once(realpath(dirname(__FILE__)) . '/databaseConfig.php');

class dbAccess extends databaseConfig{

    static $userTab = 'users';

    /**
     * dbAccess constructor.
     * @param null $host
     * @param null $user
     * @param null $pswd
     * @param null $db
     */
    function __construct($host = null, $user = null, $pswd = null, $db = null){
        $config = include(realpath(dirname(__FILE__)).'/../../config.php');
        if(isset($host, $user, $pswd, $db))
            parent::__construct($host, $user, $pswd, $db);
        else if($config->mode == 'local')
            parent::__construct($config->local_db->host, $config->local_db->username, $config->local_db->password, $config->local_db->database);
        else
            parent::__construct($config->db->host, $config->db->username, $config->db->password, $config->db->database);
    }

    /**
     * Verifica se o usuário é válido e monta a sessão do mesmo
     * @param $user
     * @param $pswd
     * @return bool|string
     */
    function login($user, $pswd){
        $user = $this->con->escape_string($user);
        $pswd = $this->con->escape_string($pswd);
        $res = $this->con->query('SELECT * FROM `'.self::$userTab.'` WHERE (`user_email` = "'.$user.'" OR `user_login` = "'.$user.'")');

        $return = "";
        if($res->num_rows > 0){
            $row = $res->fetch_assoc();
            if(password_verify($pswd, $row['user_password'])) {
                @session_start();

                // Informações Básicas de Autenticação
                $_SESSION['auth']['mail'] = $row['user_email'];
                $_SESSION['auth']['name'] = $row['user_name'];
                $_SESSION['auth']['username'] = $row['user_login'];
                $_SESSION['auth']['id'] = $row['user_id'];

                // Informações de Relatório
                $log_name = $_SESSION['log']['name'] = $row['user_name'];
                $log_ip = $_SESSION['log']['ip'] = $_SERVER['REMOTE_ADDR'];
                $log_date = $_SESSION['log']['datetime'] = date("Y-m-d H:i:s");

                $conn = "INSERT INTO log VALUES ('$log_date','$log_ip','$log_name')";

                $this->con->real_query($conn);

                $return = true;
            }
        }
        else {
            session_destroy();
            $return = false;
        }
        return $return;
    }

}