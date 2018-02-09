<?php
    if(isset($_GET['notification']) && $_GET['notification'] != ''){
        switch($_GET['notification']){
            case 'new': $action = 'adicionado'; break;
            case 'edit': $action = 'editado'; break;
            case 'delete': $action = 'deletado'; break;
        }
?>
    <div id="notification" class="alert-warning">Item <?= $action ?> com sucesso</div>
<?php } ?>