<?php

    // Verifica os valores de descrição e tipo do Controlador
    $dataType   = $image_controller::dataT;
    $desc       = $image_controller::desc;

?>

<?php if($perm_edit) { ?>
<div class="content-block">
    <h3>Adicionar imagem</h3>

    <div class="content">

        <form id='form-<?= $dataType ?>' method='post' enctype="multipart/form-data" data-mode='<?= $_GET['action'] ?>' action="<?= $config->paths->controller."/galleryimgController.php" ?>">

            <input type="hidden" name="<?= 'fk_gallery' ?>" value="<?= $single['gallery_id'] ?>" />

            <label>Título: </label>
            <input type="text" name="<?= $dataType.'_title' ?>" maxlength="120" placeholder="<?= 'Nome d'.$desc ?>" required/>

            <label>Imagem: </label>
            <input type="file" name="<?= $dataType.'_file' ?>" id="<?= $dataType.'_file' ?>"  accept="image/*" />

            <input type='submit' name='<?= $dataType.'_'.$_GET['action'] ?>' value=' Salvar '/>
        </form>
    </div>

</div>
<?php } ?>


<div class="content-block">
    <h3>Galeria de Imagens <?php if($perm_edit) echo '<span>Arraste as imagens para mudar a ordenação</span>' ?></h3>

    <div class="content">
        <div id="gallery" class="row sortable" data-desc="<?= $desc ?>" data-action="<?= $config->paths->controller."/galleryimgController.php" ?>" data-type="<?= $dataType ?>">

            <?php
                if(isset($galeria) && !is_array($galeria))
                    echo '<div class="nada-encontrado" >Nenhuma imagem encontrada</div>';
                else
                    foreach ($galeria AS $row){
            ?>
                <div class="col-md-2">
                    <div class="gallery_item" data-id="<?= $row[$dataType.'_id'] ?>" data-image="<?= $row[$dataType.'_file'] ?>">
                        <div class="thumb" style="background-image: url(<?= $image_controller::folder.$row[$dataType.'_id'].'/'.$row[$dataType.'_file'] ?>)">
                            <?php if($perm_delete)
                                echo '<a href="?page=gallery&action=delete&id=<?='.$row[$dataType.'_id'].'" class="close" title="Excluir imagem"><i class="fa fa-trash-alt"></i></a>' ?>
                            <div class="thumb_hover">Clique para visualizar</div>
                        </div>
                        <h3 class="table_label"><?= $row[$dataType.'_title'] ?></h3>
                    </div>
                </div>
            <?php } ?>

        </div>

    </div>

</div>
<?php if($perm_edit) echo '<script src="'.$config->paths->js.'/admin/sortable-update.js"></script>'; ?>

<script src="<?= $config->paths->js.'/admin/delete-overlay.js' ?>"></script>
<script>

    // Abrir overlay com a imagem da galeria
    $('.thumb_hover').each(function(){

        var el = $(this),
            data = el.parent().parent(),
            image   = data.attr('data-image'),
            id      = data.attr('data-id'),
            close = '<div class="close"><i class="fa fa-times"></i></div>';

        el  .css('cursor', 'pointer')
            .click(function (e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                o.overlayOpen(close + '<img src="<?= $image_controller::folder ?>' + id + '/' + image + '">')
        });
    })

</script>