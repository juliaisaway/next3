<div class="main-sidebar">
    <div class="toggle"></div>
    <ul>
        <?php
            if(!is_array($pages))
                echo '<div class="nada-encontrado" >Nenhum valor encontrado</div>';
            else
                foreach($pages as $row){
                    $permission = $role->hasPermission($row['section_perm'], $user_id);
                if($row['section_menu'] == 'y' && $permission){
        ?>
            <li>
                <a href="?page=<?= $row['section_slug'] ?>" <?= (isset($row['section_sub']) && $row['section_sub'] == 'y')?'class="submenu"':'' ?>>
                    <i class="fa <?= $row['section_icon'] ?>"></i> <?= $row['section_title'] ?>
                </a>
                <?php if(isset($row['section_sub']) && $row['section_sub'] == 'y'){ ?>
                    <ul class="dropdown" style="<?= ($row['section_slug'] == $_GET['page'])?'':'display: none' ?>">
                        <?php
                            foreach($sec->getSub(['cat'=>$row['id_section'], 'order'=>'sub_order']) as $item){
                                $subperm = $role->hasPermission($item['sub_perm'], $user_id);
                                if($subperm){
                        ?>
                            <li><a href="<?= '?page='.$item['sub_slug'] ?>"><i class="fa <?= $item['sub_icon'] ?>"></i> <?= $item['sub_title'] ?></a></li>
                        <?php } } ?>
                    </ul>
                <?php } ?>
            </li>
            <?php } ?>
        <?php } ?>
    </ul>
</div>

<script>
    $('.submenu').click(function(e){
        var drop = $(this).next('.dropdown');
        e.preventDefault();
        e.stopImmediatePropagation();
        drop.slideToggle();
    });
</script>