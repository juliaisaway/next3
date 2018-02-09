<?php

require_once(realpath(dirname(__FILE__)).'/../libraries/PhpRbac/src/PhpRbac/Rbac.php');

class rolesModel extends \PhpRbac\Rbac {

    /**
     * Adiciona um novo papel ao banco de dados
     * @param $title - Nome do Papel
     * @param $desc - Descrição do papel
     * @return int|string
     */
    function roleAdd($title, $desc) {
        if(is_array($desc)) {
            try {
                $result = $this->Roles->addPath($title, $desc);
            } catch (Exception $e) {
                $result = 'Não foi possível adicionar o papel selecionada';
            }
        } else
            $result = $this->Roles->add($title, $desc);
        return $result;
    }

    /**
     * Adiciona uma nova permissão ao banco de dados
     * @param $title - Nome da permissão
     * @param $desc - Descrição da permissão
     * @return int|string
     */
    function permissionAdd($title, $desc) {
        if(is_array($desc)) {
            try {
                $result = $this->Permissions->addPath($title, $desc);
            } catch (Exception $e) {
                $result = 'Não foi possível adicionar a permissão selecionada';
            }
        } else
            $result = $this->Permissions->add($title, $desc);
        return $result;
    }

    /**
     * Associa uma Permissão a um Papel
     * @param $role_id - ID do Papel
     * @param $perm_id - ID da permissão
     * @return bool
     */
    function assignPermToRole($role_id, $perm_id) {
        return $this->assign($role_id, $perm_id);
    }

    /**
     * Associa um Papel a um Usuário
     * @param $role_id - ID do Papel
     * @param $user_id - ID do Usuário
     * @return bool|string
     */
    function assignRoleToUser($role_id, $user_id) {
        try {
            $assign = $this->Users->assign($role_id, $user_id);
        } catch (RbacUserNotProvidedException $e) {
            $assign = 'Não foi possível associar este papel a este usuário';
        }
        return $assign;
    }

    function hasPermission($permission, $user_id){
        return $this->check($permission, $user_id);
    }

}