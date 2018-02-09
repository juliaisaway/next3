<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/categoryController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new categoryController();

    // Verifica se existe uma ID no endereço e puxa os valores do banco de dados
    if(isset($_GET['id']) && $_GET['id'] != '') {
        $single = $main_controller->get(['id' => $_GET['id']])[0];
        $ids = $main_controller->getAllValues();
    }

    // Verifica os valores de descrição e tipo do Controlador
    $dataType   = $main_controller::dataT;
    $desc       = $main_controller::desc;

    // Verifica as permissões do usuário
    if (isset($user_id)) {
        $perm_root      = $role->hasPermission('root', $user_id);
        $perm_delete    = $role->hasPermission('post_delete', $user_id);
        $perm_edit      = $role->hasPermission('post_edit', $user_id);
        $perm_view      = $role->hasPermission('post_view', $user_id);
    }

    // Verifica se a página é válida, existente ou se o usuário possui permissão para acessá-la
    if(isset($_GET['action'])) {
        $action= $_GET['action'];
        $verify_post  = (isset($_GET['id']))?!in_array($_GET['id'],$ids):'';
        if (($action == 'new' && !$perm_edit) || $action == 'edit' && !isset($_GET['id']) || $verify_post)
            echo '<script>window.location.replace("?page='.$_GET['page'].'");</script>';
    }

?>
<div class="row">

    <div class="col-md-12">

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <div class="content-block">
            <h3><?= (($_GET['action'] == 'edit')?'Editar '.$single[$dataType.'_title']:'Adicionar novo') ?></h3>

            <div class="content">

                <form id='form-<?= $dataType ?>' method='post' data-mode='<?= $_GET['action'] ?>' action="<?= $config->paths->controller."/categoryController.php" ?>">

                    <?php if($_GET['action'] == 'edit'){ ?>
                        <input type="hidden" name="<?= $dataType.'_id' ?>" value="<?= $single[$dataType.'_id'] ?>" />
                    <?php } ?>

                    <label>Título: </label>
                    <input type="text" name="<?= $dataType.'_title' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_title']:'') ?>" maxlength="120" placeholder="<?= 'Nome d'.$desc ?>" <?= ($perm_edit)?'required':'readonly' ?>/>

                    <label>Slug: </label>
                    <input type="text" name="<?= $dataType.'_slug' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_slug']:'') ?>" placeholder="Slug" <?= ($perm_edit)?'required':'readonly' ?>>

                    <label><?= 'Cor d'.$desc ?>: </label>
                    <input type="text" name="<?= $dataType.'_color' ?>" class="jscolor {hash:true}" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_color']:'') ?>" maxlength="120" placeholder="<?= 'Cor d'.$desc ?>" <?= ($perm_edit)?'required':'readonly' ?>/>

                    <div class='options-form'>
                        <?php if($perm_edit) echo '<input type="submit" name="'.$dataType.'_'.$_GET['action'].'" value=" Salvar "/>' ?>
                        <a href="?page=<?= $_GET['page'] ?>" class='light_button cancel' >Voltar</a>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

<script src="<?= $config->paths->js.'/vendor/jscolor.min.js' ?>" ></script>
<script src="<?= $config->paths->js.'/admin/formdata.js' ?>" ></script>
<script src="<?= $config->paths->js.'/admin/slugify.js' ?>" ></script>