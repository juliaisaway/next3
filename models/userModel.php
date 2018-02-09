<?php
require_once(realpath(dirname(__FILE__))."/../controllers/core/nextController.php");
require_once(realpath(dirname(__FILE__))."/../controllers/traits/traitGravatar.php");

class userModel extends nextController{
    use Gravatar;

    const   key = 'user_id',
            table = 'users',
            desc = 'o usuário',
            dataT = 'user';
}