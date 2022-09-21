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

    public static function insert($dadosPost)
    {
        if (empty($dadosPost['titulo'] || empty($dadosPost['conteudo']))) {
            
            throw new Exception("Preencha todos os campos");

            return false;
        }

        $conn = Connection::getConn();
        $sql = "INSERT INTO postagem (titulo, conteudo) VALUES (:titulo, :conteudo)";
        $sql = $conn->prepare($sql);
        $sql->bindvalue(":titulo", $dadosPost['titulo']);
        $sql->bindvalue(":conteudo", $dadosPost['conteudo']);
        $res = $sql->execute();

        if (!$res) {
            throw new Exception("Erro ao inserir publicação!");

            return false;
        }

        return true;
    }


    public static function update($dadosUpdate)
    {
        $conn = Connection::getConn();
        $sql = "UPDATE postagem SET titulo=:titulo, conteudo=:conteudo WHERE id=:id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(":titulo", $dadosUpdate['titulo']);
        $sql->bindValue(":conteudo", $dadosUpdate['conteudo']);
        $sql->bindValue(":id", $dadosUpdate['id']);
        $resultado = $sql->execute();

        if($resultado == false){

            throw new Exception("Falha ao alterar publicação");
            return false;
            
        }

        return true;

    }

    public static function delete($id)
    {
        $conn = Connection::getConn();
        $sql = "DELETE FROM postagem WHERE id=:id";
        $sql = $conn->prepare($sql);
        $sql->bindValue(":id", $id);
        $resultado = $sql->execute();

        if($resultado == false){

            throw new Exception("Falha ao deletar publicação");
            return false;
            
        }

        return true;
    }

}