<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/emailController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new emailController();

    // Puxa os valores do banco de dados
    $posts = $main_controller->get();

    // Verifica os valores de descrição e tipo do Controlador
    $dataType = $main_controller::dataT;
    $desc = $main_controller::desc;

    // Verifica as permissões do usuário
    if (isset($user_id))
        $perm_view = $role->hasPermission('mail_view', $user_id);

    // Verifica se o usuário possui permissão para visualizar a página
    if (!$perm_view)
        echo '<script>window.location.replace("?page=home");</script>';

?>
<div class="row">

    <div class="col-md-12">

        <?php require_once(realpath(dirname(__FILE__)) . '/../includes/notification.php'); ?>

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <div class="content-block">
            <div class="table" data-type="<?= $dataType ?>">
                <div class="table-header">
                    <div class="thumb"></div>
                    <div class="title">Nome</div>
                    <div class="date">E-mail</div>
                    <div class="date">Categoria</div>
                    <div class="date">Data</div>
                    <div class="action"></div>
                </div>
                <?php
                    if(!isset($posts) || !is_array($posts) || !is_object($posts))
                        echo '<div class="nada-encontrado" >Nenhum valor encontrado</div>';
                    else
                        foreach ($posts AS $row){

                    $post_date = new DateTime($row[$dataType.'_date']);
                    $date = $post_date->format('d/m/Y');
                ?>
                        <div class="table-row">
                            <div class="table_thumb" style="background-image: url('<?= $main_controller->get_gravatar($row[$dataType.'_email']) ?>')"></div>
                            <div class="table_label">
                                <a href="?page=<?= $_GET['page'] ?>&action=view&id=<?= $row[$dataType.'_id'] ?>" ><?= $row[$dataType.'_name'] ?></a>
                            </div>
                            <div class="table_mail"><?= $row[$dataType.'_email'] ?></div>
                            <div class="table_category"><?= $row[$dataType.'_category'] ?></div>
                            <div class="table_date"><?= $date ?></div>
                            <div class="options_buttons">
                                <a href="?page=<?= $_GET['page'] ?>&action=view&id=<?= $row[$dataType.'_id'] ?>" class="action_button"><i class="fa fa-eye"></i></a>
                            </div>
                        </div>
                    <?php } ?>
            </div>
        </div>

    </div>

</div>