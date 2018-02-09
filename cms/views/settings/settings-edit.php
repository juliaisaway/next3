<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/categoryController.php');

    // Puxa todos os valores das categorias do banco de dados
    $category = $class_configs->getConfigCat();

// Verifica se existe uma ID no endereço e puxa os valores do banco de dados
    if(isset($_GET['id']) && $_GET['id'] != '') {
        $single = $class_configs->selectSingle($_GET['id']);
        $ids = $class_configs->getAllValues();
    }

    // Verifica os valores de descrição e tipo do Controlador
    $dataType = $class_configs::dataT;
    $desc = $class_configs::desc;

    // Verifica as permissões do usuário
    if (isset($user_id)) {
        $perm_root      = $role->hasPermission('root', $user_id);
        $perm_delete    = $role->hasPermission('settings_delete', $user_id);
        $perm_edit      = $role->hasPermission('settings_edit', $user_id);
        $perm_view      = $role->hasPermission('settings_view', $user_id);
    }

    // Verifica se a página é válida, existente ou se o usuário possui permissão para acessá-la
    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        $verify_post  = (isset($_GET['id']))?!in_array($_GET['id'],$ids):'';
        if (($action == 'new' && !$perm_edit) || $action == 'edit' && !isset($_GET['id']) || $verify_post || !$perm_edit)
            echo '<script>window.location.replace("?page='.$_GET['page'].'");</script>';
    }

?>
<div class="row">

    <div class="col-md-12">

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <div class="content-block">
            <h3><?= (($_GET['action'] == 'edit')?'Editar '.$single[$dataType.'_label']:'Adicionar novo') ?></h3>

            <div class="content">

                <form id='form-<?= $dataType ?>' method='post' data-mode='<?= $_GET['action'] ?>' action="<?= $config->paths->controller."/settingsController.php" ?>">

                    <?php if($_GET['action'] == 'edit'){ ?>
                        <input type="hidden" name="<?= $dataType.'_id' ?>" value="<?= $single[$dataType.'_id'] ?>" />
                    <?php } ?>

                    <label>Título: </label>
                    <input type="text" name="<?= $dataType.'_label' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_label']:'') ?>" maxlength="120" placeholder="Nome d<?= $desc ?>" <?= ($_GET['action'] == 'edit')?(($perm_root)?'required':'disabled'):"required" ?>/>

                    <label>Valor: </label>
                    <input type="text" name="<?= $dataType.'_value' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_value']:'') ?>" placeholder="Valor d<?= $desc ?>" required>

                    <?php if($perm_root){ ?>
                        <label>Chave do banco de dados: </label>
                        <input type="text" name="<?= $dataType.'_key' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_key']:'') ?>" maxlength="120" placeholder="Chave do banco de dados" required/>

                        <label>Categoria: </label>
                        <select name="<?= $dataType.'_category' ?>" id="<?= $dataType.'_category' ?>" required>
                            <option value="disabled" disabled selected>Selecione uma categoria</option>
                            <?php foreach ($category AS $row){ ?>
                                <option value="<?= $row['cat_id']; ?>"><?= $row['cat_title']; ?></option>
                            <?php } ?>
                        </select>
                    <?php } ?>

                    <div class='options-form'>
                        <?php if($perm_edit) echo '<input type="submit" name="'.$dataType.'_'.$_GET['action'].'" value=" Salvar "/>' ?>
                        <a href="?page=<?= $_GET['page'] ?>" class='light_button cancel' >Voltar</a>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

<script src="<?= $config->paths->js.'/admin/formdata.js' ?>" ></script>
<script>
    $(document).ready(function(){
        $('#<?= $dataType.'_category' ?> > option').each(function(){
            if($(this).val() == <?= $single[$dataType.'_category'] ?>){
                $(this).prop('selected', true);
            }
        });
    })
</script>