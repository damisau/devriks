<?php

/**
 * arrangement actions.
 *
 * @package    riks_sym
 * @subpackage arrangement
 * @author     Birger Fühne
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class newsActions extends sfActions
{
    public function executeIndex(sfWebRequest $request)
    {
        $this->redirect('news/google');
    }

    public function executeGoogle(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_news')." > Google News";
        $language = $request->getParameter('newsLanguages');
        //feed to parse depending on selected language
        if($language =="en"){
            $url = 'http://news.google.com/news?hl=en&ned=us&ie=UTF-8&q=%22regional+integration%22&output=rss';
        } else if ($language =="fr"){
            $url = 'http://news.google.com/news?hl=fr&ned=fr_ca&q=int%C3%A9gration+r%C3%A9gionale&ie=UTF-8&output=rss';
        } else if ($language == "es"){
            $url = 'http://news.google.com/news?hl=es&ned=es&q=integraci%C3%B3n+regional&ie=UTF-8&output=rss';
        }
        else {
            $url = 'http://news.google.com/news?hl=en&ned=us&ie=UTF-8&q=%22regional+integration%22&output=rss';
        }
        //parsing feed

        try{
            $this->feed = sfFeedPeer::createFromWeb($url);

        }
        catch(Exception $e){
            echo "error fetching feed ".$url.": ".$e."\n";
        }

        $this->posts = array();
        $this->postCount = 0;
        foreach($this->feed->getItems() as $post){
            $this->{"post".$this->postCount} = $post;
            $this->postCount++;
        }
    }

    public function executeProviders(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
        sfConfig::get('app_news')." > News Providers";
    }
    
    public function executeZei(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
            sfConfig::get('app_news')." > ZEI observer";
    }

    public function executeLatn(sfWebRequest $request){
        $this->breadcrumb = "You are here: ".sfConfig::get('app_home')." > ".
            sfConfig::get('app_news')." > LATN newsletter";
    }
}
