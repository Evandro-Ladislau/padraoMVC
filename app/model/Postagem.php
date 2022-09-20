<?php

class Postagem 
{
    
    //metodo static permite ser chamado sem a necessidade de instanciar a classe
    public static function selecionaTodos()
    {
        //aqui eu recebo o metodo estatico da classe connection, como a classe connection é abstrac não pode ser 
        //instanciada. Sendo assim foi possivel chamar o metodo getConn com :: pois ele é static.
        $conn = Connection::getConn();

        //pegar todas as postagem do banco de dados;
        $sql = "SELECT * FROM postagem ORDER BY id DESC ";
        $sql = $conn->prepare($sql);
        $sql->execute();

        //trazer os resultado em forma de objeto e armazenar dentro do array
        $resultado = array();
        while ($row = $sql->fetchObject('Postagem')) {
            $resultado[] = $row;
        }

        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco de dados");   
        }

        return $resultado;
    }

    public static function selecionarPorId($idPost)
    {
        $conn = Connection::getConn();

        $sql = "SELECT * FROM postagem WHERE id=:id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(':id', $idPost, PDO::PARAM_INT);
        $sql->execute();
        $resultado = $sql->fetchObject('Postagem');

        if (!$resultado) {
            throw new Exception("Não foi encontrado nenhum registro no banco de dados"); 
        }else{
            $resultado->comentarios = Comentario::selecionarComentarios($resultado->id);
        }

        return $resultado;
    }
}