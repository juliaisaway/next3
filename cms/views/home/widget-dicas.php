<?php

    $feedUrl = "http://kombidesign.com.br/apicms/getCmsDicas.php";
    $curl = curl_init($feedUrl);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $feedContent = curl_exec($curl);
    curl_close($curl);

    $feedDicas = false;

    if($feedContent && !empty($feedContent)){
        $feedDicas = true;
        $feedXml = @simplexml_load_string($feedContent);
    }

    $dicas = $feedXml->channel->item

?>

<div class="col-md-4">
    <div class="content-block">
        <h3>Dicas Úteis</h3>
        <div class="table">
            <?php
            if(is_array($dicas) || is_object($dicas)) {
                foreach($dicas as $item){

                    $post_date = new DateTime($item->pubDate);
                    $date = $post_date->format('d/m/Y');

                    $content = '<div class="close darken"><i class="fa fa-close"></i></div>';
                    $content .= '<div class="content-block blog" style="margin: 0">';
                    $content .= '<h3>'.$item->title.'</h3>';
                    $content .= '<div class="content">';
                    $content .= $item->description[0];
                    $content .= '<p class="date">'.$date.'</p>';
                    $content .= '</div></div>';

                    ?>
                    <div class="table-row">
                        <div class="table_label"><a href="#" class="blog_post" data-link="<?= htmlentities($content) ?>"><?= $item->title ?></a></div>
                    </div>

                <?php }
            } else {
                echo '<div class="nada">Nenhum valor encontrado</div>';
            }
            ?>
        </div>
    </div>
</div>

<script>
    $('.blog_post').click(function(e){
        e.preventDefault();
        e.stopImmediatePropagation();

        var post = $(this).attr('data-link');
        o.overlayOpen(post);
    });
</script>