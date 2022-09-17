<?php

//abstract não permite que a classe seja instanciada diretamente
abstract  class Connection 
{
    private static $conn;

    //metodo static permite ser chamdo sem a necessidade de instanciar a classe
    public static function getConn()
    {
        //if verifica se já existe a instancia classe pdo
        if (self::$conn == null) {
            //aqui o self foi usado porque esse metodo é statico, se não fosse, seria necessario usar a variavel $this->
            self::$conn = new PDO('mysql: host=localhost; dbname=mvc-site;', 'root', '');
            return self::$conn;
        }
        

        
    }
}