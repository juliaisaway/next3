<?php

    $sidebar = [
            ['name' => 'Home', 'icon' => 'fa-home', 'link' => '/#', 'submenu' => ''],
            ['name' => 'Banners', 'icon' => 'fa-tv', 'link' => '/#', 'submenu' => ''],
            ['name' => 'Publicações', 'icon' => 'fa_newspaper-o', 'link' => '/#', 'submenu' => [
                    ['name' => 'Nova Publicação', 'icon' => 'fa-plus', 'link' => '/#'],
                    ['name' => 'Gerenciar', 'icon' => 'fa-files-o', 'link' => '/#'],
                    ['name' => 'Categorias', 'icon' => 'fa-tags', 'link' => '/#'],
                ]
            ],
            ['name' => 'Páginas', 'icon' => 'fa-files-o', 'link' => '/#', 'submenu' => ''],
            ['name' => 'E-mails', 'icon' => 'fa-envelope', 'link' => '/#', 'submenu' => ''],
            ['name' => 'Configurações', 'icon' => 'fa-gear', 'link' => '/#', 'submenu' => ''],
    ]

?>

<div class="main-sidebar">
    <div class="toggle"></div>
    <ul>
        <?php foreach($sidebar as $row): ?>
            <li>
                <a href="<?= $row['link'] ?>" <?= (isset($row['submenu']) && $row['submenu'] != '')?'class="submenu"':'' ?>>
                    <i class="fa <?= $row['icon'] ?>"></i> <?= $row['name'] ?>
                </a>
                <?php if(isset($row['submenu']) && $row['submenu'] != ''): ?>
                    <ul class="dropdown" style="display: none">
                        <?php foreach($row['submenu'] as $item): ?>
                            <li><a href="<?= $item['link'] ?>"><i class="fa <?= $item['icon'] ?>"></i> <?= $item['name'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif ?>
            </li>
        <?php endforeach ?>
    </ul>
</div>

<script>
    $('.submenu').click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();
        $('.dropdown').slideToggle();
    });
</script>