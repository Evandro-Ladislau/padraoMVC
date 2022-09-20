<?php

class SobreController {
    
    public function index()
    {

        
       
            //twig
            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('sobre.html');

            $parametros = array();
            //esse codigo foi um teste, o valor recuperado no array pode ser usado  no html do site usando a seguinte sintaxe {{nome}}
           // $parametros['nome'] = 'Evandro';

            $conteudo = $template->render($parametros);
            echo $conteudo;
           
    }
}