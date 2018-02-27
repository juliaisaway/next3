<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/userController.php');

    //Cria a Instância dos controladores Next
    $main_controller = new userController();

    // Verifica as permissões do usuário
    if (isset($user_id)) {
        $perm_root      = $role->hasPermission('root', $user_id);
        $perm_delete    = $role->hasPermission('user_delete', $user_id);
        $perm_edit      = $role->hasPermission('user_edit', $user_id);
        $perm_view      = $role->hasPermission('user_view', $user_id);
    }

    // Verifica a permissão do usuário e puxa os valores do banco de dados de acordo com o mesmo
    if(!$perm_edit)
        $posts = $main_controller->get(['id' => $user_id]);
    else
        $posts = $main_controller->get(['order' => 'user_id = '.$user_id, 'desc' => true]);

    // Verifica os valores de descrição e tipo do Controlador
    $dataType = $main_controller::dataT;
    $desc = $main_controller::desc;

?>
<div class="row">

    <div class="col-md-12">

        <?php require_once(realpath(dirname(__FILE__)) . '/../includes/notification.php'); ?>

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <?php if($perm_edit) { ?>
            <div class="buttons-row">
                <a href="?page=<?= $_GET['page'] ?>&action=new"><div class="active_button">Adicionar usuário</div></a>
            </div>
        <?php } ?>


        <div class="content-block">
            <div class="table" data-type="<?= $dataType ?>" data-desc="<?= $desc?>" data-action="<?= $config->paths->controller."/userController.php" ?>">
                <div class="table-header">
                    <div class="thumb"></div>
                    <div class="title">Nome</div>
                    <div class="date">E-mail</div>
                    <div class="date">Função</div>
                    <div class="action"></div>
                </div>
                <?php
                    if(!isset($posts))
                        echo '<div class="nada-encontrado" >Nenhum valor encontrado</div>';
                    else
                        foreach ($posts AS $row){
                            $user_role = $role->Roles->getTitle($row[$dataType.'_id']);
                            $children = array_column($role->Roles->descendants($row[$dataType.'_id']), 'ID');

                            if(in_array($user_id, $children))
                                continue;


                ?>
                    <div class="table-row" data-id="<?= $row[$dataType.'_id'] ?>">
                        <div class="table_thumb" title="Edite seu avatar em http://gravatar.com" style="background-image: url('<?= $main_controller->get_gravatar($row[$dataType.'_email']) ?>')"></div>
                        <div class="table_label">
                            <a href="?page=<?= $_GET['page'] ?>&action=edit&id=<?= $row[$dataType.'_id'] ?>"><?= $row[$dataType.'_name'] ?></a>
                        </div>
                        <div class="table_mail"><?= $row[$dataType.'_email'] ?></div>
                        <div class="table_role"><?= ucfirst($user_role) ?></div>
                        <div class="options_buttons">
                            <?php
                                // Cria os botões de Edição e Exclusão
                                $edit_btn = '<a href="?page='.$_GET['page'].'&action=edit&id='.$row[$dataType.'_id'].'" class="action_button edit"><i class="fas fa-pencil-alt"></i></a>';
                                $delete_btn = '<a href="?page='.$_GET['page'].'&action=delete&id='.$row[$dataType.'_id'].'" class="action_button delete"><i class="fa fa-times"></i></a>';

                                // Caso o usuário possua a permissão para a ação, exibe o mesmo
                                if($perm_view)
                                    echo $edit_btn;
                                if($perm_delete)
                                    echo $delete_btn;
                            ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</div>

<script src="<?= $config->paths->js.'/admin/delete-overlay.js' ?>"></script>