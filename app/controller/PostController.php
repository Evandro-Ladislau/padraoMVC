<?php

class PostController {
    
    public function index($params)
    {

        
        try {

            $postagem = Postagem::selecionarPorId($params);
            

            //twig
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parametros = array();
            //esse codigo foi um teste, o valor recuperado no array pode ser usado  no html do site usando a seguinte sintaxe {{nome}}
           // $parametros['nome'] = 'Evandro';

            $parametros['titulo'] = $postagem->titulo;
            $parametros['conteudo'] = $postagem->conteudo;

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