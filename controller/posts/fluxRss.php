<?php

use controller\posts\Post;
use sophwork\core\Sophwork;

function update_fluxRSS(){
        
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<rss version="2.0">';
        $xml .= '<channel>';
        $xml .= ' <title>Pinnackl</title>';
        $xml .= ' <link>http://localhost</link>';
        $xml .= ' <description>Pinnackl ! Agrégateur d\'actualités</description>';
        $xml .= ' <language>fr</language>';
        $xml .= ' <copyright>Pinnackl.eu</copyright>';
        $xml .= ' <managingEditor>rss@monsite-craym.eu</managingEditor>';
        $xml .= ' <category>Flux RSS</category>';
        $xml .= ' <generator>PHP/MySQL</generator>';
        $xml .= ' <docs>http://www.rssboard.org</docs>';

        $index_selection = 0;
        $limitation = 1;

        $posts = new Post();
        $data = $posts->getPosts();

        if(!empty($data)){
               foreach ($data['title'] as $k => $value) {

                        $title   = $data['title'][$k];
                        $content = substr($data['content'][$k], 0,100);
                        $author  = $data['author'][$k];
                        $tag     = $data['tag'][$k];
                        $date    = $data['date'][$k];

                        $xml .= '<item>';
                        $xml .= '<title>'.'['.$data['category'][$k][0].']'.stripcslashes($title).'</title>';
                        $xml .= '<link>'.Sophwork::getUrl($tag).'</link>';
                        $xml .= '<guid isPermaLink="true">'.Sophwork::getUrl($tag).'</guid>';
                        $xml .= '<pubDate>'.(date("D, d M Y H:i:s O", strtotime($date))).'</pubDate>';
                        $xml .= '<author>'.stripcslashes($author).'</author>';
                        $xml .= '</item>'; 
                } 
        }

        

        $xml .= '</channel>';
        $xml .= '</rss>';

        $fp = fopen($_SERVER['DOCUMENT_ROOT']."pinnacklpress/flux_rss.xml", 'w+');
 
        //On écrit notre flux RSS
        fputs($fp, $xml);
         
        //Puis on referme le fichier
        fclose($fp);
}
?>