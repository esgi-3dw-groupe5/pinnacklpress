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
require(__DIR__ . '/../../sophwork/autoloader.php');

use sophwork\core\Sophwork;

use controller\utils\Users;


Users::startSession();
$user = new Users();

if (!file_exists("../../data/articles/temp/".$user->id)){
    mkdir("../../data/articles/temp/".$user->id);
}
/**
 * Upload directory
 */
define("UPLOADDIR", "../../data/articles/temp/".$user->id.'/');

function imageCreateFromAny($filepath) {
    $type = exif_imagetype($filepath); // [] if you don't have exif you could use getImageSize()
    $allowedTypes = array(
        1,  // [] gif
        2,  // [] jpg
        3,  // [] png
        6   // [] bmp
    );
    if (!in_array($type, $allowedTypes)) {
        return false;
    }
    switch ($type) {
        case 1 :
            $im = imageCreateFromGif($filepath);
        break;
        case 2 :
            $im = imageCreateFromJpeg($filepath);
        break;
        case 3 :
            $im = imageCreateFromPng($filepath);
        break;
        case 6 :
            $im = imageCreateFromBmp($filepath);
        break;
    }   
    return $im; 
} 

// Detect if it is an AJAX request
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    $file = array_shift($_FILES);

    if(move_uploaded_file($file['tmp_name'], UPLOADDIR . basename($file['name']))) {
        $file = Sophwork::getUrl() . str_replace('//','/',str_replace('../', '/', UPLOADDIR)) . $file['name'];

        $extension = explode('.', $file);
        $extension = strtolower($extension[count($extension)-1]);

        $size = getImageSize($file);
        $image1 = imageCreateFromAny($file);
        $image2 = imageCreateFromAny($file);

        $width1 = 350; 
        $height1 = 350;

        $width2 = 450; 
        $height2 = 450;

        $newImage1 = imagecreatetruecolor($width1 , $height1) or die ("Erreur");
        $newImage2 = imagecreatetruecolor($width2 , $height2) or die ("Erreur");

        imagecopyresampled($newImage1 , $image1  , 0,0, 0,0, $width1, $height1, $size[0],$size[1]);
        imagecopyresampled($newImage2 , $image2  , 0,0, 0,0, $width2, $height2, $size[0],$size[1]);

        $newName1 = '350-'.time();
        $newName2 = '450-'.time();                                        
        

        imagejpeg($newImage1 , '../../data/articles/temp/'.$user->id.'/'.$newName1.'.'.$extension, 100);
        imagejpeg($newImage2 , '../../data/articles/temp/'.$user->id.'/'.$newName2.'.'.$extension, 100);

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