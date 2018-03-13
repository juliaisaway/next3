<?php

trait traitBreadcrumb {

    /**
     * Inserção dinâmica de Breadcrumbs baseado em  uma array
     * @param array $array
     * @return string
     */
    public function breadcrumb($array = []) {

        $config = include(realpath(dirname(__FILE__)).'/../../config.php');

        $return = '<section id="breadcrumb" class="breadcrumb">';
        $return .= '<div class="container">';
        $return .= '<div class="row">';
        $return .= '<div class="col-md-12"><ul>';
        $return .= '<li><a href="'.$config->path.'">Home</a></li>';

        foreach($array as $name => $key)
            $return .= '<li><a href="'.$config->path.$key.'">'.$name.'</a></li>';

        $return .= '</ul></div></div</div></section>';

        return $return;
    }

}