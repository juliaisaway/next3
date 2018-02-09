<header>
    <div class="grid-row fluid">
        <div class="col-3 menu-holder">
            <div class="menu-toggle"><span></span></div>
            <a href="#"><img class="logo" src="<?= $config->paths->img.'/logo.svg' ?>" alt=""></a>
        </div>
    </div>
</header>

<script>
    $('.menu-toggle').click(function(){
        $('.main-sidebar').toggleClass('collapsed');
        $('.main').toggleClass('collapsed');
    });
</script>