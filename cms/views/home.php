<div class="row">

    <div class="col-md-12">

        <h2><i class="fa <?= $pagina['section_icon'] ?>"></i> <?= $pagina['section_title'] ?></h2>

        <div class="alert-basic">
            <h2>Olá, <?= $_SESSION['auth']['name'] ?></h2>
            Seja bem vindo ao <?= $configs->site_name ?>.
        </div>

    </div>

    <?php
        include_once('home/widget-acessos.php');
        include_once('home/widget-suporte.php');
        include_once('home/widget-dicas.php');
        include_once('home/widget-indique.php');
        include_once('home/widget-links.php');
    ?>

</div>

<script src="<?= $config->paths->js.'/sendmail.js' ?>"></script>
