<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/postController.php');
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/categoryController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new postController();
    $category_controller = new categoryController();

    // Puxa todos os valores das categorias do banco de dados
    $category = $category_controller->get();

    // Verifica se existe uma ID no endereço e puxa os valores do banco de dados
    if(isset($_GET['id']) && $_GET['id'] != '') {
        $single = $main_controller->get(['id' => $_GET['id']])[0];
        $ids    = $main_controller->getAllValues();
    }

    // Verifica os valores de descrição e tipo do Controlador
    $dataType = $main_controller::dataT;
    $desc = $main_controller::desc;

    // Verifica as permissões do usuário
    if (isset($user_id)) {
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
    </div>
</div>

<form id='form-<?= $dataType ?>' method='post' enctype="multipart/form-data" data-mode='<?= $_GET['action'] ?>' action="<?= $config->paths->controller."/postController.php" ?>">

    <div class="row">

        <div class="col-md-8 col-lg-9">

            <input type="text" name="<?= $dataType.'_title' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_title']:'') ?>" maxlength="120" style="margin: 0" placeholder="Título da publicação" <?= ($perm_edit)?'required':'readonly' ?>/>

            <?php if($_GET['action'] == 'edit'){ ?>
                <input type="hidden" name="<?= $dataType.'_id' ?>" value="<?= $single[$dataType.'_id'] ?>" />
            <?php } ?>

            <div class="content-block">
                <textarea name="<?= $dataType.'_content' ?>" class="tinymce" title="Conteúdo" placeholder="Digite aqui..." <?= ($perm_edit)?'':'readonly' ?>><?= (($_GET['action'] == 'edit')?$single[$dataType.'_content']:'') ?></textarea>
            </div>

            <div class="content-block">
                <h3>Descrição <span>Pequena descrição com até 160 caracteres, para uso dos buscadores</span></h3>
                <div class="content">
                    <textarea name="<?= $dataType.'_desc' ?>" title="Descrição" maxlength="160" <?= ($perm_edit)?'required':'readonly' ?>><?= (($_GET['action'] == 'edit')?$single[$dataType.'_desc']:'') ?></textarea>
                </div>
            </div>

        </div>

        <div class="col-md-4 col-lg-3">

            <?php if($perm_edit){ ?>
                <input type='submit' name='<?= $dataType.'_'.$_GET['action'] ?>' class="post-submit" value='<?= (($_GET['action'] == 'edit')?'Atualizar':'Publicar') ?>'/>
            <?php } ?>

            <a href="?page=<?= $_GET['page'] ?>" class='light_button d-block d-sm-none' style="margin-top: 10px">Voltar</a>

            <div class="content-block">
                <h3>Status</h3>
                <div class="content">
                    <select name="<?= $dataType.'_active' ?>" id="<?= $dataType.'_active' ?>" title="Status" required>
                        <option value="y" selected>Ativo</option>
                        <option value="n">Inativo</option>
                    </select>
                </div>
            </div>

            <div class="content-block">
                <h3>Categoria</h3>
                <div class="content">
                    <select name="fk_category" id="<?= $dataType.'_cat' ?>" title="Categoria" required>
                        <option value="disabled" disabled selected>Selecione uma categoria</option>
                        <?php foreach ($category AS $row){ ?>
                            <option value="<?= $row['category_id']; ?>"><?= $row['category_title']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="content-block">
                <h3>Imagem destacada <span>Tamanho permitido: Até 2MB</span></h3>
                <div class="content">

                    <?php if($_GET['action'] == 'edit'){ ?>
                        <div id="thumbnail" class="thumb_wide" style="background-image: url(<?= $main_controller::folder.$single[$dataType.'_file'] ?>)" data-image="<?= $single[$dataType.'_file'] ?>" data-id="<?= $single[$dataType.'_id'] ?>">
                            <div class="thumb_hover">Clique aqui para visualizar</div>
                        </div>
                    <?php } ?>

                    <?php if($perm_edit){ ?>
                        <input type="file" name="<?= $dataType.'_file' ?>" id="<?= $dataType.'_file' ?>"  accept="image/*" />
                    <?php } ?>

                </div>
            </div>

        </div>

    </div>

</form>

<script src="<?= $config->paths->js.'/admin/tinymceupdate.js' ?>"></script>
<script src="<?= $config->paths->js.'/admin/formdata.js' ?>" ></script>

<script>

    // Inicializa o TinyMCE
    tinyMceUpdate({$init: '.tinymce'});

    $(document).ready(function(){

        <?php if($_GET['action'] == 'edit'){ ?>
            // Muda os valores ativos no Dropdown
            $('#<?= $dataType.'_cat' ?> > option').each(function(){
                if($(this).val() === '<?= $single['fk_category'] ?>'){
                    $(this).prop('selected', true);
                }
            });
            $('#<?= $dataType.'_active' ?> > option').each(function(){
                if($(this).val() === '<?= $single[$dataType.'_active'] ?>'){
                    $(this).prop('selected', true);
                }
            });

            // Abre o Overlay com a Imagem de Preview
            $('.thumb_hover').click(function () {
                var data = $(this).parent().attr('data-image'),
                    close = '<div class="close"><i class="fa fa-close"></i></div>';
                o.overlayOpen(close + '<img src="<?= $main_controller::folder ?>' + data + '">')
            });
        <?php } ?>

    });

</script>