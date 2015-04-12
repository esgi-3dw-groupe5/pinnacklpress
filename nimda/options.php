<?php
require('../sophwork/autoloader.php');

// -- Sophwork --
use sophwork\core\Sophwork;
use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;


echo'<pre>';
var_dump($_POST);
echo'</pre>';
Sophwork::redirect('/nimda/');
exit;