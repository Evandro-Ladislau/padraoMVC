<?php
require_once 'app/core/Core.php';

$tamplate = file_get_contents('app/template/estrutura.html');

$core = new Core();
$core->start($_GET);

echo $tamplate;