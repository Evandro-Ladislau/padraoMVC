<?php

require_once 'app/core/Core.php';

//classe conexao
require_once 'lib/Database/Connection.php';

//classes controller
require_once 'app/controller/HomeController.php';
require_once 'app/controller/ErroController.php';

//Model
require_once 'app/model/Postagem.php';

require_once 'vendor/autoload.php';

$tamplate = file_get_contents('app/template/estrutura.html');

ob_start();

//ob_start() serve para pegar todo o conteudo que esta apos ele

    $core = new Core();
    $core->start($_GET);

    //com essa funcao eu peguei o conteudo da chamada do objeto core->start e coloquei na variavel saida
    $saida = ob_get_contents();

    //fecha a funcao ob_start
ob_end_clean();   

//função str_replaca substitui uma string pela outra, no caso onde tiver o primeiro parametro é trocado pelo segundo
//e carregar o terceiro

$template_pronto = str_replace('{{area dinamica}}', $saida, $tamplate);

echo $template_pronto;