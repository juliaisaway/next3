<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body>

<section id="404" class="mainpage">
    <div class="message-box">
        <div class="message">
            <h2>Ops.. :(</h2>
            <p>Página não encontrada</p>
            <p>Desculpe mas a página que você estava tentando visualizar não existe.</p>
            <p>Mas não se preocupe, te levaremos de volta a página inicial do nosso site em
                5 segundos.</p>
        </div>
    </div>
</section>

<script>
    $(function(){
        setTimeout(function() {
            location.replace("<?= $config->path ?>");
        }, 5000);
    });
</script>