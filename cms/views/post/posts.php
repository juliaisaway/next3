<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/postController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new postController();

    // Puxa os valores do banco de dados
    $posts = $main_controller->get(['order' => 'post_id', 'desc' => true]);

    // Verifica os valores de descrição e tipo do Controlador
    $dataType = $main_controller::dataT;
    $desc = $main_controller::desc;

    // Verifica se existe alguma ação do $_GET e seta um padrão
    (isset($_GET['section'])?$_GET['section']:$_GET['section'] = 'manage');

    // Verifica as permissões do usuário
    if (isset($user_id)) {
        $perm_delete    = $role->hasPermission('post_delete', $user_id);
        $perm_edit      = $role->hasPermission('post_edit', $user_id);
        $perm_view      = $role->hasPermission('post_view', $user_id);
    }

?>
<div class="row">

    <div class="col-md-12">

        <?php require_once(realpath(dirname(__FILE__)) . '/../includes/notification.php'); ?>

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <?php if($perm_edit) { ?>
            <div class="buttons-row">
                <a href="?page=<?= $_GET['page'] ?>&action=new"><div class="active_button">Adicionar publicação</div></a>
            </div>
        <?php } ?>


        <div class="content-block">
            <div class="table" data-type="<?= $dataType ?>" data-desc="<?= $desc ?>" data-action="<?= $config->paths->controller."/postController.php" ?>">
                <div class="table-header">
                    <div class="thumb"></div>
                    <div class="title">Nome da publicação</div>
                    <div class="category hidden-mobile">Categoria</div>
                    <div class="date hidden-mobile">Data</div>
                    <div class="date hidden-mobile">Status</div>
                    <div class="action hidden-mobile"></div>
                </div>
                <?php
                if(!isset($posts) || !is_array($posts) || !is_object($posts))
                    echo '<div class="nada-encontrado" >Nenhum valor encontrado</div>';
                else
                    foreach ($posts AS $row){

                        if(isset($row[$dataType.'_active']) && $row[$dataType.'_active'] == 'y')
                            $post_status = 'Ativo';
                        else
                            $post_status = 'Inativo';

                        $post_date = new DateTime($row[$dataType.'_date']);
                        $date = $post_date->format('d/m/Y');
                        ?>
                        <div class="table-row" data-id="<?= $row[$dataType.'_id'] ?>">
                            <div class="table_thumb" style="background-image: url(<?= $main_controller::folder.$row[$dataType.'_file'] ?>)"></div>
                            <div class="table_label"><a href="?page=<?= $_GET['page'] ?>&action=edit&id=<?= $row[$dataType.'_id'] ?>"><?= $row[$dataType.'_title'] ?></a></div>
                            <div class="table_category"><?= $row['category_title'] ?></div>
                            <div class="table_date"><?= $date ?></div>
                            <div class="config_active"><?= $post_status ?></div>
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