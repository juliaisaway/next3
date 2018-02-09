<?php

    // Requisição dos Controladores Next
    require_once(realpath(dirname(__FILE__)) . '/../../../controllers/emailController.php');

    // Cria a Instância dos controladores Next
    $main_controller = new emailController();

    // Verifica se existe uma ID no endereço e puxa os valores do banco de dados
    if(isset($_GET['id']) && $_GET['id'] != '') {
        $single = $main_controller->get(['id' => $_GET['id']])[0];
        $ids = $main_controller->getAllValues();
    }

    // Inicia a sessão
    @session_start();

    // Verifica os valores de descrição e tipo do Controlador
    $dataType = $main_controller::dataT;
    $desc = $main_controller::desc;

    // Verifica as permissões do usuário
    if (isset($user_id))
        $perm_view = $role->hasPermission('mail_view', $user_id);

    // Verifica se a página é válida, existente ou se o usuário possui permissão para acessá-la
    if(isset($_GET['action'])) {
        $action= $_GET['action'];
        $verify_post  = (isset($_GET['id']))?!in_array($_GET['id'],$ids):'';
        if ($action != 'view' || !isset($_GET['id']) || !$perm_view || $verify_post)
            echo '<script>window.location.replace("?page='.$_GET['page'].'");</script>';
    }

?>
<div class="row">

    <div class="col-md-12">

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <div class="content-block">
            <h3>Visualizar E-mail</h3>

            <div class="content">

                <form id='form-<?= $dataType ?>' data-mode='<?= $_GET['action'] ?>'>

                    <div class="row">

                        <div class="col-md-5">
                            <label>Nome: </label>
                            <input type="text" name="<?= $dataType.'_title' ?>" value="<?= $single[$dataType.'_name'] ?>" placeholder="Nome" readonly/>

                            <label>E-mail: </label>
                            <input type="text" name="<?= $dataType.'_email' ?>" value="<?= $single[$dataType.'_email'] ?>" placeholder="E-mail" readonly/>

                            <label>Telefone: </label>
                            <input type="text" name="<?= $dataType.'_phone' ?>" value="<?= $single[$dataType.'_phone'] ?>" placeholder="Telefone" readonly/>

                            <label>Categoria: </label>
                            <input type="text" name="<?= $dataType.'_category' ?>" value="<?= $single[$dataType.'_category'] ?>" placeholder="Assunto" readonly/>

                            <label>Assunto: </label>
                            <input type="text" name="<?= $dataType.'_subject' ?>" value="<?= $single[$dataType.'_subject'] ?>" placeholder="Assunto" readonly/>
                        </div>

                        <div class="col-md-7">
                            <label>Mensagem: </label>
                            <textarea name="<?= $dataType.'_message' ?>" rows="12" placeholder="Mensagem" readonly><?= $single[$dataType.'_message'] ?></textarea>
                        </div>

                        <div class="col-md-12">
                            <div class="options-form">
                                <a href="?page=<?= $_GET['page'] ?>"><div class="light_button">Voltar</div></a>
                            </div>
                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>