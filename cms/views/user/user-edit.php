<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/userController.php');

    //Cria a Instância dos controladores Next
    $main_controller = new userController();

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
        $perm_delete    = $role->hasPermission('post_delete', $user_id);
        $perm_edit      = $role->hasPermission('post_edit', $user_id);
        $perm_view      = $role->hasPermission('post_view', $user_id);
    }

    // Verifica se a página é válida, existente ou se o usuário possui permissão para acessá-la
    if(isset($_GET['action'])) {
        $action= $_GET['action'];
        $verify_post  = (isset($_GET['id']))?!in_array($_GET['id'],$ids):'';
        $permission = ((!$perm_edit)?$_GET['id'] == $user_id:'true');
        if (($action == 'new' && !$perm_edit) || $action == 'edit' && !isset($_GET['id']) || $verify_post || $permission == false)
            echo '<script>window.location.replace("?page='.$_GET['page'].'");</script>';
    }

?>
<div class="row">

    <div class="col-md-12">

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <div class="content-block">
            <h3><?= (($_GET['action'] == 'edit')?'Editar '.$single[$dataType.'_name']:'Adicionar novo') ?></h3>

            <div class="content">

                <form id='form-<?= $dataType ?>' method='post' data-mode='<?= $_GET['action'] ?>' action="<?= $config->paths->controller."/userController.php" ?>">

                    <?php if($_GET['action'] == 'edit'){ ?>
                        <input type="hidden" name="<?= $dataType.'_id' ?>" value="<?= $single[$dataType.'_id'] ?>" />
                    <?php } ?>

                    <label>Nome: </label>
                    <input type="text" name="<?= $dataType.'_name' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_name']:'') ?>" placeholder="<?= 'Nome d'.$desc ?>" required/>

                    <label>Login: </label>
                    <input type="text" name="<?= $dataType.'_login' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_login']:'') ?>" maxlength="60" placeholder="<?= 'Login d'.$desc ?>" required/>

                    <label>E-mail: </label>
                    <input type="email" name="<?= $dataType.'_email' ?>" value="<?= (($_GET['action'] == 'edit')?$single[$dataType.'_email']:'') ?>" placeholder="E-mail" required>

                    <label>Senha: </label>
                    <input type="password" name="<?= $dataType.'_password' ?>" placeholder="******">

                    <?php /*<label>Nível de acesso: </label>
                    <select name="<?= $dataType.'_role' ?>" id="<?= $dataType.'_role' ?>" required>
                        <option value="Desativado" disabled >Selecione uma opção</option>
                        <option value="1" selected>Administrador</option>
                        <option value="2">Editor</option>
                        <option value="3">Colaborador</option>
                        <option value="4">Usuário</option>
                    </select>*/ ?>

                    <div class='options-form'>
                        <input type='submit' name='<?= $dataType.'_'.$_GET['action'] ?>' value=' Salvar '/>
                        <a href="?page=<?= $_GET['page'] ?>" class='light_button cancel' >Voltar</a>
                    </div>
                </form>

            </div>

        </div>

    </div>

</div>

<script src="<?= $config->paths->js.'/admin/formdata.js' ?>" ></script>
<script>
    $('#<?= $dataType.'_role' ?> > option').each(function(){
        if($(this).val() == <?= $single[$dataType.'_role'] ?>){
            $(this).prop('selected', true);
        }
    });
</script>