<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/mediaController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new mediaController();

    // Verifica se existe uma ID no endereço e puxa os valores do banco de dados
    if(isset($_GET['id']) && $_GET['id'] != '') {
        $single = $main_controller->get(['id' => $_GET['id']])[0];
        $ids = $main_controller->getAllValues();
    }

    // Inicia a sessão
    @session_start();

    // Verifica os valores de descrição e tipo do Controlador
    $dataType   = $main_controller::dataT;
    $desc       = $main_controller::desc;

    // Verifica as permissões do usuário
    if (isset($user_id)) {
        $perm_delete    = $role->hasPermission('media_delete', $user_id);
        $perm_edit      = $role->hasPermission('media_edit', $user_id);
        $perm_view      = $role->hasPermission('media_view', $user_id);
    }

    // Verifica se a página é válida, existente ou se o usuário possui permissão para acessá-la
    if(isset($_GET['action'])) {
        $action= $_GET['action'];
        $verify_post  = (isset($_GET['id']))?!in_array($_GET['id'],$ids):'';
        if (($action == 'new' && !$perm_edit) || $action == 'edit' && !isset($_GET['id']) || $verify_post)
            echo '<script>window.location.replace("?page='.$_GET['page'].'");</script>';
    }

    // Verifica o modo ativo e retorna os valores de caminho e imagem
    if($_GET['action'] == 'edit') {
         // Pega a URL da imagem e o caminho absoluto para a mesma.
        $image = $main_controller::folder.$single[$dataType.'_id'].'/'.$single[$dataType.'_file'];
        $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$config->path.str_replace('../','',$image);

        // Calcula o tamanho original da imagem e proporciona o mesmo.
        list($width, $height) = getimagesize($image);
        $ratio = 1 / ($width / $height) * 100;
    }

?>
<div class="col-md-12">

    <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

    <div class="content-block">
        <h3><?= (($_GET['action'] == 'edit')?'Editar '.$single[$dataType.'_title']:'Adicionar novo') ?></h3>

        <div class="content">

            <form id='form-<?= $dataType ?>' method='post' enctype="multipart/form-data" data-mode='<?= $_GET['action'] ?>' action="<?= $config->paths->controller."/mediaController.php" ?>">

                <?php if($_GET['action'] == 'edit'){ ?>
                    <input type="hidden" name="<?= $dataType.'_id' ?>" value="<?= $single[$dataType.'_id'] ?>" />
                <?php } ?>

                <label>Título: </label>
                <input type="text" name="<?= $dataType.'_title' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_title']:'') ?>" maxlength="120" placeholder="<?= 'Nome d'.$desc ?>" <?= ($perm_edit)?'required':'readonly' ?>/>

                <?php if($perm_edit){ ?>
                    <label>Imagem: </label>
                    <input type="file" name="<?= $dataType.'_file' ?>" id="<?= $dataType.'_file' ?>"  accept="image/*" required />
                <?php } ?>

                <?php if($_GET['action'] == 'edit'){ ?>
                    <label>Caminho da imagem: </label>
                    <input type="text" name="<?= $dataType.'_realpath' ?>" value="<?= $actual_link ?>" placeholder="Caminho da Imagem" onClick="this.setSelectionRange(0, this.value.length)" readonly/>
                <?php } ?>

                <div class='options-form'>
                    <?php if($perm_edit) echo '<input type="submit" name="'.$dataType.'_'.$_GET['action'].'" value=" Salvar "/>' ?>
                    <a href="?page=<?= $_GET['page'] ?>" class='light_button cancel' >Voltar</a>
                </div>
            </form>

        </div>

    </div>

    <?php if($_GET['action'] == 'edit'){ ?>
    <div class="content-block">
        <h3>Preview</h3>
        <div class="content media_preview">
            <div class="image_holder" style="width: <?= $width.'px' ?>">
                <div class="image" style="background-image: url(<?= $image ?>); padding-top: <?= $ratio.'%' ?>"></div>
            </div>
        </div>
    </div>
    <?php } ?>

</div>

<script src="<?= $config->paths->js.'/admin/formdata.js' ?>" ></script>