<?php

class PLQuote
{
    //-------CLASS FIELDS------------------
    public $quote;
    public $person;
    public $pub;
    public $source;

    //-------CONSTRUCTOR--------------------
    public function __construct($pperson,$psource,$ppub)
    {
        $this->person = $pperson;
        $this->source = $psource;
        $this->pub = $ppub;
        $this->quote = "";
    }
}

class PLHomeArticle
{
    //-------CLASS FIELDS------------------
    public $heading;
    public $tagline;
    public $storyimg;
    public $content;
    public $summary;
    public $link;
    public $linktitle;
    
    //-------CONSTRUCTOR--------------------
    public function __construct($pheading,$ptag,$pimg,$plink,$plt)
    {
        $this->heading = $pheading;
        $this->tagline = $ptag;
        $this->storyimg = $pimg;
        $this->link     = $plink;
        $this->linktitle = $plt;
        $this->content  = "";
        $this->summary  = "";
    }
}

class PLNewsItem
{
    //-------CLASS FIELDS------------------
    public $heading;
    public $summary;
    public $linktext;
    public $link;

    //-------CONSTRUCTOR--------------------
    public function __construct($pheading = "Default Heading",$psummary = "Default Summary",
                                $plink="#",$plinktext = "More..")
    {
        $this->heading  = $pheading;
        $this->summary  = $psummary;
        $this->link     = $plink;
        $this->linktext = $plinktext;
    }
}




class PLNewsList
{
    //-------CLASS FIELDS------------------
    public $newsitems; 
    
    //-------CONSTRUCTOR--------------------
    public function __construct()
    {
        $this->newsitems = [];
    }
}

class PLCarouselImage
{
    //-------CLASS FIELDS------------------
    public $imgref;
    public $title;
    public $lead;
    
    //-------CONSTRUCTOR--------------------
    public function __construct($pimgref,$ptitle,$plead)
    {
        $this->imgref = $pimgref;
        $this->title  = $ptitle;
        $this->lead   = $plead;
    }
}

class PLKeyPlayerItem
{
    //-------CLASS FIELDS------------------
    public $name;
    public $ref;
    public $desc;
    
    //-------CONSTRUCTOR--------------------
    public function __construct($pname,$pref,$pdesc)
    {
        $this->name = $pname;
        $this->ref  = $pref;
        $this->desc = $pdesc;
    }
}

class PLTab
{
    //-------CLASS FIELDS------------------
    public $tabid;
    public $tabname;
    public $content;
    
    //-------CONSTRUCTOR--------------------
    public function __construct($ptabid,$ptabname)
    {
        $this->tabid = $ptabid;
        $this->tabname = $ptabname;
    }    
}

class PLStatistic
{
    //-------CLASS FIELDS------------------
    public $stat;
    public $value;
    public $holder;
    public $ref;
    
    //-------CONSTRUCTOR--------------------
    function __construct($pstat,$pval,$ph,$pref)
    {
        $this->stat = $pstat;
        $this->value = $pval;
        $this->holder = $ph;
        $this->ref    = $pref;
    }
}


?>