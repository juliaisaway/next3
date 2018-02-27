<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/mediaController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new mediaController();

    // Puxa os valores do banco de dados
    $media = $main_controller->get();

    // Verifica os valores de descrição e tipo do Controlador
    $dataType   = $main_controller::dataT;
    $desc       = $main_controller::desc;

    // Verifica as permissões do usuário
    if (isset($user_id)) {
        $perm_delete    = $role->hasPermission('media_delete', $user_id);
        $perm_edit      = $role->hasPermission('media_edit', $user_id);
        $perm_view      = $role->hasPermission('media_view', $user_id);
    }

?>
<div class="col-md-12">

    <?php require_once(realpath(dirname(__FILE__)) . '/../includes/notification.php'); ?>

    <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

    <?php if($perm_edit) { ?>
        <div class="buttons-row">
            <a href="?page=<?= $_GET['page'] ?>&action=new"><div class="active_button">Adicionar mídia</div></a>
        </div>
    <?php } ?>

    <div class="gallery_content">
        <div class="row" data-type="<?= $dataType ?>" data-desc="<?= $desc ?>" data-action="<?= $config->paths->controller."/mediaController.php" ?>">
            <?php
                if(isset($media) && !is_array($media))
                    echo '<div class="nada-encontrado" >Nenhum valor encontrado</div>';
                else
                    foreach ($media AS $row){
            ?>

                <div class="col-md-2">
                    <div class="gallery_item" data-id="<?= $row[$dataType.'_id'] ?>">
                        <div class="thumb" style="background-image: url(<?= $main_controller::folder.$row[$dataType.'_id'].'/'.$row[$dataType.'_file']; ?>)" data-image="<?= $row[$dataType.'_file'] ?>">

                            <?php if($perm_delete)
                                echo '<a href="?page='.$_GET['page'].'&action=delete&id='.$row[$dataType.'_id'].'" class="close" title="Excluir imagem"><i class="fa fa-trash-alt"></i></a>' ?>

                            <a href="?page=<?= $_GET['page'] ?>&action=edit&id=<?= $row[$dataType.'_id'] ?>"><div class="thumb_hover">Clique para visualizar</div></a>
                        </div>
                            <h3 class="table_label"><?= $row[$dataType.'_title'] ?></h3>
                    </div>
                </div>

            <?php } ?>
            <div class="clearfix"></div>
        </div>
    </div>

</div>

<script src="<?= $config->paths->js.'/admin/delete-overlay.js' ?>"></script>