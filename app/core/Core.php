<?php

class Core {

    public function start($urlGet)
    {
        $acao = 'index';

        if (isset($urlGet['pagina'])) {
            $controller = ucfirst($urlGet['pagina'].'Controller');
        } else{
            $controller = 'HomeController';
        }
        
        
        if (!class_exists($controller)) {
            
            $controller = 'ErroController';
        }

        if(isset($urlGet['id']) && $urlGet['id'] != null ){
            $id = $urlGet['id'];
            $array_id[] = $id;
        }else{
            $id = null;
            $array_id[] = $id;
        }
        
        call_user_func_array(array(new $controller, $acao), $array_id); 
        //cria um objeto e chama a função de forma dinamica
    }
}