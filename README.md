# Next Framework

Framework MVC e CMS integrado para desenvolvimento de websites.

## Iniciando

Este guia pretende simplificar a instalação do Next em um servidor com PHP e MySQL simples, para que você possa iniciar os primeiros passos com um Framework PHP.

### Pré requisitos

O Next requer uma versão do **PHP** superior a 5.4, **MySQL** e **Apache** configurados, além do **Ruby** e a gem *Sass* na máquina de desenvolvimento.

### Instalando

Para instalar o Next, basta copiar os arquivos para seu diretório. Após isso, abra primeiramente o arquivo **.htaccess** e edite a seguinte linha

```apache
RewriteBase /sua-pasta/
```

Após isso, abra o arquivo **config.php** e edite as configurações de banco de dados com os valores correspondentes do banco de dados de sua hospedagem

```php
'db'=> (object) array(
        'host'      => 'mysql.seuhost.com.br',
        'username'  => 'nomedeusuario',
        'password'  => 'suasenha',
        'database'  => 'next_database'
    ),
```

Caso trabalhe em servidor local, você pode colocar as configurações em **'local_db'**. O Next já está configurado para detectar seu servidor e alterar conforme o ambiente. 

Após a configuração do banco de dados, você precisa atualizar seu banco de dados com o dump do Next. Para isso, basta enviar o arquivo **next_dump.sql**, localizado em /dump/, em seu banco de dados. Você pode utilizar o *phpMyAdmin* para isso ou com a seguinte linha de comando em um terminal MySQL.

```mysql
mysql -u nomedeusuario -p next_database < next_dump.sql
```

Após essas configurações, o Next já estará pronto para uso.

## Testando

Para verificar se tudo está certo, basta abrir em seu navegador a URL do site. Se aparecer a janela de testes do Next, estará tudo pronto e configurado

### Descobrindo minha versão do PHP

Caso esteja na dúvida de qual versão do PHP você está utilizando, basta digitar o seguinte endereço em seu navegador

```
*seu-endereço-next*/libraries/phpinfo
```

A versão do PHP deverá ser exibida no canto superior esquerdo da tela. As demais informações de configurações do PHP estarão exibidas abaixo.

## Desenvolvimento

O Next é desenvolvido todo em PHP, utilizando o modelo MVC *(Model / View / Controller)* e seguindo os modelos de Programação Orientada a Objetos.

## Bibliotecas utilizadas

* [PHPMailer](https://github.com/PHPMailer/PHPMailer) - Biblioteca de disparo e envio de emails universal feita em PHP.
* [Php-BRac](http://phprbac.net/) - Biblioteca de controle de acessos baseada em permissões.
* [PHP-Info](https://github.com/SynCap/PHP-Info) - Visualizador de informações do PHP de forma organizada e intuitiva.
* [Kint](https://kint-php.github.io/kint/) - Utilizado para simplificar e melhorar a depuração de código PHP.
* [SASS](http://sass-lang.com/) - Pré-compilador CSS com foco em produtividade e interatividade.

## Versionamento

O Next utiliza o padrão de versionamento universal proposto no projeto [Semantic Versioning 2.0.0](http://semver.org/). 

## Autores

* **Ilton Alberto Junior** - *Front-end / Back-end / Documentação*
* **WIlliam Jacinto Venâncio** - *Back-end / Documentação*

Agradecimentos especiais a todos os colaboradores do Projeto Next

> * Anderson Silveira
> * Marcus Felet
> * Mario Mariano
> * Michel Castilho

## Licença

Este projeto está licenciado sobre a Mozilla Public License 2.0 - Para saber mais, acesse a [documentação oficial](https://www.mozilla.org/media/MPL/2.0/index.txt)

## Agradecimentos

Obrigado a todos que nos ajudaram, seja com códigos, ideias ou sugestões para o projeto. Esperamos continuar contribuindo cada dia mais para uma web organizada, segura, estruturada e de fácil acesso para todos.
