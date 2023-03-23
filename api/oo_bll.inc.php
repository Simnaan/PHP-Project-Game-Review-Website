<?php

class BLLGame
{

    // -------CLASS FIELDS------------------
    public $gamerank;

    public $name;

    public $rating;

    public $genre;

    // -------CONSTRUCTOR--------------------
    public function __construct($pgr, $pname, $prating, $pgenre)
    {
        $this->gamerank = $pgr;
        $this->name = $pname;
        $this->rating = $prating;
        $this->genre = $pgenre;
    }
}

class BLLGamet
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $gamerank;

    public $name;

    public $rating;

    public $genre;

    public $releasedate;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLGamedesc
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $gamerank;

    public $name;

    public $summary;

    public $link;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLUserData
{
    
    // -------CLASS FIELDS------------------
    public $id = null;
    
    public $email;
    
    public $password;
    
    public $fname;
    
    public $lname;
    
    public $phonenumber;
    
    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLGameretailinfo
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $gamerank;

    public $name;

    public $link1;

    public $link1price;

    public $link2;

    public $link2price;

    public $link3;

    public $link3price;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLOfficialgamereview
{

    // -------CLASS FIELDS------------------
    public $id = null;

    public $gamerank;

    public $name;

    public $reviewsite1;

    public $review1;

    public $rating1;

    public $link1;

    public $reviewsite2;

    public $review2;

    public $rating2;

    public $link2;

    public $reviewsite3;

    public $review3;

    public $rating3;

    public $link3;
    
    public $editorialreview;

    public function fromArray(stdClass $passoc)
    {
        foreach ($passoc as $tkey => $tvalue) {
            $this->{$tkey} = $tvalue;
        }
    }
}

class BLLGamelist
{

    // -------CLASS FIELDS------------------
    public $gamerank;

    public $gamelistname;

    public function __construct()
    {
        $this->gamelist = array();
        $this->gamelistname = "";
    }
}


class BLLConsole
{

    public $fname;

    public $lname;

    public $developer;

    public $manufacturer;

    public $product_family;

    public $release_date;

    public $units_sold;

    // -------CONSTRUCTOR--------------------
    public function __construct($pfn, $pln)
    {
        $this->fname = $pfn;
        $this->lname = $pln;
        $this->developer = "";
        $this->manufacturer = "";
        $this->product_family = "";
        $this->release_date = "";
        $this->units_sold = "";
    }
}



?>