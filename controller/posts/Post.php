<?php

namespace controller\posts;

use sophwork\modules\kdm\SophworkDM;
use sophwork\modules\kdm\SophworkDMEntities;

class Post extends \sophwork\app\controller\AppController {
    
    protected $post = [];
    protected $title;
    protected $content;
    
    public function __construct(){
        parent::__construct();
        $this->post = $this->KDM->create('pp_post');
    }

    public function createPost($POST){
        $this->post->setPostTitle($POST['title']);
        $this->post->setPostContent($POST['content']);
        $this->post->save();
    }    
}
