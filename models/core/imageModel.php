<?php
    require_once(realpath(dirname(__FILE__)) . '/../../controllers/core/nextController.php');
    require_once(realpath(dirname(__FILE__))."/../../controllers/traits/traitSlugify.php");

abstract class imageModel extends nextController {
    use traitSlugify;
    /**
     * @var string folder Pasta para upload do(s) arquivos
     * @var string|array filefield Campo/Campos de Imagem
     */
    const   folder = '../assets/uploads/',
            filefield = 'file',
            order = 'order';
    /**
     * @var bool multi Não preencha, deve ser calculado em runtime
     * @todo Quando estivermos usando PHP 7.1+, descomentar o private
     */
    /*private */const multi = false;

    /**
     * Sobe a imagem e salva as informações no banco de dados
     * @param $array
     * @return string
     */
    function set($array){
        $this->lastInsertedId = false;
        $this->multi = is_array(static::filefield);

        if($this->multi){
            foreach (static::filefield as $field)
                if(isset($array[$field])){
                    $image[$field] = $array[$field];
                    unset($array[$field]);
                }
        }
        else if(isset($array[static::filefield])){
            $image = $array[static::filefield];
            unset($array[static::filefield]);
        }
        else
            $image = null;

        $set = parent::set($array);
        if($set != "OK")
            return $set;

        $id = (isset($array[static::key]))? $array[static::key]:$this->lastInsertedId;

        $folder = static::folder.$id.'/';
        if(!is_dir($folder)) {
            mkdir($folder,0777, true);
        }

        if($this->multi && is_array($image)){
            foreach ($image AS $img){
                if(isset($img, $img['error']) && $img['error'] == UPLOAD_ERR_OK){
                    $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
                    $filename = static::slugify(pathinfo($img['name'], PATHINFO_FILENAME)).".".$ext;
                    $move = move_uploaded_file($img['tmp_name'], $folder.$filename);
                    if($move !== false){
                        $set = parent::set([static::key=>$id, static::filefield=>$filename]);
                        if($set != "OK")
                            return $set;
                    }
                    else
                        return "Erro ao subir a Imagem ({$img['name']})";
                }
            }
        }
        else if(isset($image, $image['error']) && $image['error'] == UPLOAD_ERR_OK){
            $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
            $filename = static::slugify(pathinfo($image['name'], PATHINFO_FILENAME)).".".$ext;
            $move = move_uploaded_file($image['tmp_name'], $folder.$filename);
            if($move !== false){
                $set = parent::set([static::key=>$id, static::filefield=>$filename]);
                if($set != "OK")
                    return $set;
            }
            else
                return "Erro ao subir a Imagem ({$image['name']})";
        }

        return "OK";
    }

    /**
     * @param array $ordem
     * @return string|array
     */
    function setOrdem($ordem = array()){
        $r = "Nenhuma ordem enviada";
        foreach ($ordem as $i=>$id){
            $r = $this->set(array(static::key=>$id, static::order=>$i));
            if($r !== "OK")
                return $r;
        }
        return $r;
    }

    /**
     * @param array|int $ids
     * @return string
     */
    function delete($ids){
        if(is_numeric($ids))
            $ids = [$ids+0];
        foreach ($ids as $id){
            $r = parent::delete($id);
            if($r != "OK")
                return $r;

            array_map('unlink', glob(static::folder."{$id}/*.*"));
            if(!rmdir(static::folder.$id))
                return "Falha ao remover diretório \"".static::folder."{$id}\"";

        }
        return "OK";
    }
}