<?php
/**
 * Index - Next
 * --------------------------------------------------
 *
 * Início do CMS Next e chamada das principais requisições do Front-end
 *
 */

// Requisição das configurações do CMS
$config = include_once('config.php');

// Requisição das rotas do Front-end
require_once('routes.php');

// Requisição das Bibliotecas Next
require_once(realpath(dirname(__FILE__)).'/libraries/database/dbAccess.php');
require_once(realpath(dirname(__FILE__)).'/libraries/kint/kint.php');

// Requisição dos Controladores Next
require_once(realpath(dirname(__FILE__)) . '/controllers/settingsController.php');

// Instancia os controladores principais Next
$class_configs = new settingsController();

// Chama as classes principais de uso Next
$configs = $class_configs->getConfigs();

global $dataType,
       $user_id;

?>

<!DOCTYPE html>
<html lang="pt-br">
<?php
    include($pagina);
    require_once('views/includes/functions.php');
?>
</body>
</html>