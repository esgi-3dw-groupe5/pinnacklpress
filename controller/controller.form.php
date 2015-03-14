<?php 
//FIXME every cases (dbb)
array_key_exists('db_submit',$_POST);
$form = new Core();
$action = $form->setAction($_POST);
$form -> sendAction($action,$_POST);
?>