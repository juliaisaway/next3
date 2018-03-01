<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body>

<section id="404" class="mainpage">
    <div class="message-box">
        <div class="logo-box">
            <a href="#"><img src="<?= $config->paths->img.'/logo-color.svg' ?>" alt=""></a>
        </div>
        <div class="message">
            <?php
                $array = ['site_name' => $configs->site_name];
                echo $m->render('home', $array);
            ?>
            <p><b><a href="http://www.php.net/" target="_blank">PHP</a> | <a href="http://sass-lang.com/" target="_blank">SASS</a> | <a href="https://jquery.com/" target="_blank">JQUERY</a></b></b></p>
        </div>
    </div>
</section>