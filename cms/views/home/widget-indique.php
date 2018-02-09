<div class="col-md-4">
    <div class="content-block">
        <h3>Indique a Kombi</h3>
        <div class="content">

            <form id='cms-indique' method='post' enctype="multipart/form-data" action="<?= $config->paths->libraries."/mailform/mailform.php?mail=cms_indique" ?>">

                <input type="hidden" name="indique_name" value="<?= $_SESSION['auth']['name'] ?>"/>
                <input type="hidden" name="indique_mail" value="<?= $_SESSION['auth']['mail'] ?>"/>

                <input type="text" name="indique_parceiro" placeholder="Nome do parceiro" required>
                <input type="email" name="indique_destino" placeholder="E-mail do parceiro" required>

                <input type='submit' name='suporte_new' value='Enviar'/>

            </form>

        </div>
    </div>
</div>
