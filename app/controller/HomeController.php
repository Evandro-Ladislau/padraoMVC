<?php

class HomeController {
    
    public function index()
    {

        try {

            $colecPostagens = Postagem::selecionaTodos();

            //twig
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parametros = array();
            //esse codigo foi um teste, o valor recuperado no array pode ser usado  no html do site usando a seguinte sintaxe {{nome}}
           // $parametros['nome'] = 'Evandro';

            $parametros['postagens'] = $colecPostagens;

            

            $conteudo = $template->render($parametros);
            echo $conteudo;

            /* 
             echo 'Home';
            echo '<pre>';
            print_r($colecPostagens);
            echo '</pre>';
            **/
           

        }catch (Exception $e){
            echo $e->getMessage();
        }
    }
}