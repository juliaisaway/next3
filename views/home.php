<head>
    <?php require_once('includes/head.php'); ?>
</head>
<body>

<section id="home" class="mainpage">
    <div class="message-box">
            <?php
                $array = [
                    'site_name' => $configs->site_name,
                    'site_url' => $config->path,
                    'logo' => $config->paths->img.'/logo-color.svg',
                    'links' => [
                        ['name' => 'PHP', 'link' => 'http://www.php.net/'],
                        ['name' =>  'SASS', 'link' => 'http://sass-lang.com/'],
                        ['name' => 'JQUERY', 'link' => 'http://jquery.com/'],
                        ['name' => 'MUSTACHE', 'link' => 'http://mustache.github.io/']
                    ]
                ];
                echo $m->render('home', $array);
            ?>
    </div>
</section>