<div class="col-md-6">
    <div class="content-block">
        <h3>Contate nosso suporte</h3>
        <div class="content">

            <form id='cms_suporte' method='post' enctype="multipart/form-data" action="<?= $config->paths->libraries."/mailform/mailform.php?mail=cms_suporte" ?>">

                <input type="hidden" name="suporte_name" value="<?= $_SESSION['auth']['name'] ?>"/>
                <input type="hidden" name="suporte_mail" value="<?= $_SESSION['auth']['mail'] ?>"/>

                <select id="suporte_cat" name="suporte_cat" title="Categoria" required>
                    <option value="Selecione uma categoria" selected disabled>Selecione uma categoria</option>
                    <option value="Problemas com o site">Problemas com o site</option>
                    <option value="Problemas com o CMS">Problemas com o CMS</option>
                    <option value="Problemas com e-mail">Problemas com e-mail</option>
                    <option value="Outros assuntos">Outros assuntos</option>
                </select>
                <textarea name="suporte_msg" id="suporte_msg" rows="4" placeholder="Sua mensagem" required></textarea>

                <input type='submit' name='suporte_new' value='Enviar'/>
            </form>

        </div>
    </div>
</div>