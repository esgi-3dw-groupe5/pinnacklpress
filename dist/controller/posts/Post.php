<?php

namespace controller\posts;

class Post extends \sophwork\app\controller\AppController {
    
    protected $post = [];
    protected $categoriesRs;
    protected $title;
    protected $content;
    
    public function __construct(){
        parent::__construct();
        $this->post = $this->KDM->create('pp_page');
        $this->categoriesRs = $this->KDM->create('pp_pagemeta');
    }

    public function createPost($POST){
        $this->post->setPostTitle($POST['title']);
        $this->post->setPostContent($POST['content']);
        $this->post->save();
    } 

    public function getPosts($ids = null){

        $aIds = $ids;
        $user = $this->KDM->create('pp_user');

        if(is_null($ids)){
            $this->post
                ->filterPageType('post')
                ->__and()
                ->filterPageStatus('publish')
                ->querySelect();
            $posts = $this->post->getData();

            $aIds = $posts['page_id'];
        }
        
        if(is_null($aIds))
            $aIds  = [];
        
        $pageMeta = $this->KDM->create('pp_pagemeta');
        $nbPost = 0;
        $aPosts = [];
 
        foreach ($aIds as $key => $value) {
            $pageMeta->findPageId($aIds[$key]);
            $arrayContents = $pageMeta->getData();

            foreach ($arrayContents['pmeta_value'] as $k => $val) {
                if($arrayContents['pmeta_name'][$k] == 'content' && $arrayContents['page_id'][$k] == $aIds[$key]){
                    if(!is_null($ids)){
                        $this->post->findPageId($aIds[$key]);
                        if($this->post->getPageStatus()[0] != 'publish')
                            continue;
                        $posts = $this->post->getData();

                        $aPosts['title'][$nbPost]  = $posts['page_name'][0];
                        $aPosts['date'][$nbPost]   = $posts['page_date'][0];
                        $aPosts['tag'][$nbPost]    = $posts['page_tag'][0];
                        $user->findUserId($posts['page_author'][0]);
                        $aPosts['author'][$nbPost] = $user->getUserPseudo()[0];
                        $aPosts['category'][$nbPost] = [];
                        $aPosts['catLink'][$nbPost] = [];
                    }
                    else{
                        $aPosts['title'][$nbPost]  = $posts['page_name'][$key];
                        $aPosts['date'][$nbPost]   = $posts['page_date'][$key];
                        $user->findUserId($posts['page_author'][$key]);
                        $aPosts['author'][$nbPost] = $user->getUserPseudo()[0];
                        $aPosts['tag'][$nbPost]    = $posts['page_tag'][$key];
                        $aPosts['category'][$nbPost] = [];
                        $aPosts['catLink'][$nbPost] = [];
                    }
                    $aPosts['content'][$nbPost] = $val;
                    
                    $this->categoriesRs
                        ->filterPageId($aIds[$key])
                        ->__and()
                        ->filterPmetaName('category')
                        ->querySelect();
                    $linkedPage = $this->categoriesRs->getPmetaValue();
                    if(is_null($linkedPage)){
                        $linkedPage = [];
                    }
                    foreach ($linkedPage as $key => $value) {
                        $this->post->findPageId($value);
                        $aPosts['category'][$nbPost][] = $this->post->getPageName()[0];
                        $aPosts['catLink'][$nbPost][] = $this->post->getPageTag()[0];
                    }
                }
            }
            $nbPost++;
        }
        return $aPosts;
    }

    public function getPostsByCateg($cat){
        $pageMeta = $this->KDM->create('pp_pagemeta');
        $pageMeta->find();
        $posts = $pageMeta->getData();
        $aIds   = [];
        foreach ($posts['pmeta_value'] as $key => $value) {
            if($posts['pmeta_value'][$key] == $cat){
                $aIds[] = $posts['page_id'][$key];
            }
        }

        $aPosts = Post::getPosts($aIds);

        return $aPosts;
    }   
}
