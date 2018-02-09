<header>
    <div class="grid-row fluid">
        <div class="col-md-3 menu-holder">
            <div class="menu-toggle"><span></span></div>
            <a href="?page=home"><img class="logo" src="<?= $config->paths->img.'/logo.svg' ?>" alt=""></a>
        </div>
        <div class="col-md-3 offset-md-6 hidden-mobile menu-opt">
            <div class="drop-menu">
                <span><?= $_SESSION['auth']['name'] ?> <i class="fa fa-angle-down"></i></span>
                <ul>
                    <li><a href="../"><i class="fa fa-link"></i> Visualizar site</a></li>
                    <li><a href="?page=user&action=edit&id=<?= $_SESSION['auth']['id']?>"><i class="fa fa-user"></i> Perfil</a></li>
                    <li><a href="?action=logout"><i class="fa fa-sign-out"></i> Sair</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>

<script>
    $('.menu-toggle').click(function(){
        $('.main-sidebar').toggleClass('collapsed');
        $('.main').toggleClass('collapsed');
    });
</script>