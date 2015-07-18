<?php
/* ===========================================================
 * trumbowyg.upload.php
 * Upload plugin for Trumbowyg
 * http://alex-d.github.com/Trumbowyg
 * ===========================================================
 * Author : Alexandre Demode (Alex-D)
 *          Twitter : @AlexandreDemode
 *          Website : alex-d.fr
 * ===========================================================
 * /!\ This file was make just for tests. Do not use it in
 *     production because it is not secure.
 */

// $uri = $_SERVER['REQUEST_URI'];
// $parts = parse_url($uri);

// $root = parse_str($parts['path']);
// var_dump($root);
// var_dump($_SERVER['DOCUMENT_ROOT']);die;
use sophwork\core\Sophwork;

/**
 * Upload directory
 */
define("UPLOADDIR", Sophwork::getUrl()."data/articles");



// Detect if it is an AJAX request
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $file = array_shift($_FILES);

    if(move_uploaded_file($file['tmp_name'], UPLOADDIR . basename($file['name']))) {
        $file = dirname($_SERVER['PHP_SELF']) . str_replace('./', '/', UPLOADDIR) . $file['name'];
        $data = array(
            'message' => 'uploadSuccess',
            'file'    => $file,
        );
    } else {
        $error = true;
        $data = array(
            'message' => 'uploadError',
        );
    }
} else {
    $data = array(
        'message' => 'uploadNotAjax',
        'formData' => $_POST
    );
}



echo json_encode($data);