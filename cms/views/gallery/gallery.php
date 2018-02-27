<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/galleryController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new galleryController();

    // Puxa os valores do banco de dados
    $cat = $main_controller->get();

    // Verifica os valores de descrição e tipo do Controlador
    $dataType   = $main_controller::dataT;
    $desc       = $main_controller::desc;

    // Verifica as permissões do usuário
    if (isset($user_id)) {
        $perm_delete    = $role->hasPermission('gallery_delete', $user_id);
        $perm_edit      = $role->hasPermission('gallery_edit', $user_id);
        $perm_view      = $role->hasPermission('gallery_view', $user_id);
    }

?>
<div class="row">

    <div class="col-md-12">

        <?php require_once(realpath(dirname(__FILE__)) . '/../includes/notification.php'); ?>

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <?php if($perm_edit) { ?>
            <div class="buttons-row">
                <a href="?page=<?= $_GET['page'] ?>&action=new"><div class="active_button">Adicionar galeria</div></a>
            </div>
        <?php } ?>


        <div class="content-block">
            <div class="table" data-type="<?= $dataType ?>" data-desc="<?= $desc ?>" data-action="<?= $config->paths->controller."/galleryController.php" ?>">
                <div class="table-header">
                    <div class="title">Nome do banner</div>
                    <div class="action"></div>
                </div>
                <?php
                    if(!isset($cat) || !is_array($cat) || !is_object($cat))
                        echo '<div class="nada-encontrado">Nenhum valor encontrado</div>';
                    else
                        foreach ($cat AS $row){
                ?>
                    <div class="table-row" data-id="<?= $row[$dataType.'_id'] ?>">
                        <div class="table_label">
                            <a href="?page=<?= $_GET['page'] ?>&action=edit&id=<?= $row[$dataType.'_id'] ?>" ><?= $row[$dataType.'_title'] ?></a>
                        </div>
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