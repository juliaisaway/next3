<?php
    // Verifica se existe alguma ação do $_GET e seta um padrão
    (isset($_GET['section'])?$_GET['section']:$_GET['section'] = 'general');

    // Puxa todos os valores das categorias do banco de dados
    $category = $class_configs->getConfigCat(['slug'=>$_GET['section']]);

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

    // Lista as sessões sem permissão de acesso para usuários
    $prohibited_sections = ['general', 'mail'];

    // Verifica se o usuário possui permissão para visualizar a página
    if (!$perm_view)
        echo '<script>window.location.replace("?page=home");</script>';

?>
<div class="row">

    <div class="col-md-12">

        <?php require_once(realpath(dirname(__FILE__)) . '/../includes/notification.php'); ?>

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <?php if($perm_root) { ?>
            <div class="buttons-row">
                <a href="?page=<?= $_GET['page'] ?>&action=new"><div class="active_button">Adicionar campo</div></a>
            </div>
        <?php } ?>

    <?php
        if(!$category)
            echo '<div class="content-block"><div class="nada-encontrado" >Nenhum valor encontrado</div></div>';
        else
            foreach ($category AS $cat){
    ?>
        <div class="content-block">
            <?php
                if(!$perm_root && in_array($cat['cat_slug'],$prohibited_sections)) {
                    echo '<div class="nada-encontrado" >Nenhum valor encontrado</div>';
                } else {
            ?>
            <h3><i class="fa <?= $cat['cat_icon'] ?>"></i>  <?= $cat['cat_title'] ?></h3>
            <div class="table" data-type="<?= $dataType ?>" data-desc="<?= $desc ?>" data-action="<?= $config->paths->controller."/settingsController.php" ?>">
                <?php
                $settings = $class_configs->get(['categoria'=>$cat['cat_id']]);
                    if(!isset($settings))
                        echo '<div class="nada-encontrado" >Nenhum valor encontrado</div>';
                    else
                        foreach ($settings AS $row){
                ?>
                <div class="table-row" data-id="<?= $row[$dataType.'_id'] ?>">
                    <div class="table_label">
                        <a href="?page=<?= $_GET['page'] ?>&action=edit&id=<?= $row[$dataType.'_id'] ?>"><?= $row[$dataType.'_label'] ?></a>
                    </div>
                    <div class="table_value"><?= $row[$dataType.'_value'] ?></div>
                    <div class="options_buttons">
                        <?php
                            // Cria os botões de Edição e Exclusão
                            $edit_btn = '<a href="?page='.$_GET['page'].'&action=edit&id='.$row[$dataType.'_id'].'" class="action_button edit"><i class="fa fa-pencil"></i></a>';
                            $delete_btn = '<a href="?page='.$_GET['page'].'&action=delete&id='.$row[$dataType.'_id'].'" class="action_button delete"><i class="fa fa-close"></i></a>';

                            // Caso o usuário possua a permissão para a ação, exibe o mesmo
                            if($perm_edit)
                                echo $edit_btn;
                            if($perm_delete)
                                echo $delete_btn;
                        ?>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    <?php } ?>

    </div>

</div>

<script src="<?= $config->paths->js.'/admin/delete-overlay.js' ?>"></script>