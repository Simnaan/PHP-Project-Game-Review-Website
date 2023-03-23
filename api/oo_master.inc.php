<?php

// Include our HTML Page Class
require_once ("oo_page.inc.php");

class MasterPage
{

    // -------FIELD MEMBERS----------------------------------------
    private $_htmlpage;

    // Holds our Custom Instance of an HTML Page
    private $_dynamic_1;

    // Field Representing our Dynamic Content #1
    private $_dynamic_2;

    // Field Representing our Dynamic Content #2
    private $_dynamic_3;

    // Field Representing our Dynamic Content #3
    private $_player_ids;
    
    //This will be used for the Addtional application page which selects a random game

    // -------CONSTRUCTORS-----------------------------------------
    function __construct($ptitle)
    {
        $this->_htmlpage = new HTMLPage($ptitle);
        $this->setPageDefaults();
        $this->setDynamicDefaults();
        $this->_player_ids = [1,2,3,4,5,6,7,8,9,10];
        //these are the IDs for each of the games i have chosen to represent
    }

    // -------GETTER/SETTER FUNCTIONS------------------------------
    public function getDynamic1()
    {
        return $this->_dynamic_1;
    }

    public function getDynamic2()
    {
        return $this->_dynamic_2;
    }

    public function getDynamic3()
    {
        return $this->_dynamic_3;
    }

    public function setDynamic1($phtml)
    {
        $this->_dynamic_1 = $phtml;
    }

    public function setDynamic2($phtml)
    {
        $this->_dynamic_2 = $phtml;
    }

    public function setDynamic3($phtml)
    {
        $this->_dynamic_3 = $phtml;
    }

    public function getPage(): HTMLPage
    {
        return $this->_htmlpage;
    }

    // -------PUBLIC FUNCTIONS-------------------------------------
    public function createPage()
    {
        // Create our Dynamic Injected Master Page
        $this->setMasterContent();
        // Return the HTML Page..
        return $this->_htmlpage->createPage();
    }

    public function renderPage()
    {
        // Create our Dynamic Injected Master Page
        $this->setMasterContent();
        // Echo the page immediately.
        $this->_htmlpage->renderPage();
    }

    public function addCSSFile($pcssfile)
    {
        $this->_htmlpage->addCSSFile($pcssfile);
    }

    public function addScriptFile($pjsfile)
    {
        $this->_htmlpage->addScriptFile($pjsfile);
    }

    // -------PRIVATE FUNCTIONS-----------------------------------
    private function setPageDefaults()
    {
        $this->_htmlpage->setMediaDirectory("css", "js", "fonts", "img", "");
        $this->addCSSFile("bootstrap.default.css");
        $this->addCSSFile("site.css");
        $this->addScriptFile("jquery-2.2.4.js");
        $this->addScriptFile("bootstrap.js");
        $this->addScriptFile("holder.js");
    }

    private function setDynamicDefaults()
    {
        $tcurryear = date("Y");
        // Set the Three Dynamic Points to Empty By Default.
        $this->_dynamic_1 = <<<JUMBO
        <h1>Simnaan Reviews</h1>
        <p class="lead">Bringing you the top games available for the Playstation 4</p>
        JUMBO;
        $this->_dynamic_2 = "";
        $this->_dynamic_3 = <<<FOOTER
        <p>Mohammed Simnaan Ahmed Chaudry; {$tcurryear}</p>
        FOOTER;
    }

    private function setMasterContent()
    {
        
        $tlogin="app_entry.php";
        $tlogout="app_exit.php";
        $tentryhtml = <<<FORM
        <form id="signin" action="{$tlogin}" method="post"
         class="navbar-form navbar-right" role="form">
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-user"></i>
                </span> 
                <input id="email" type="email" class="form-control" name="myname" value="" placeholder="">
            </div>
            <button type="submit" class="btn btn-primary">Enter</button>
        </form>      
FORM;
        $texithtml = <<<EXIT
        <a class="btn btn-info navbar-right" href="{$tlogout}?action=exit">Exit</a>
EXIT;
        $tauth = isset($_SESSION["myuser"])?$texithtml : $tentryhtml;
        $tid = $this->_player_ids[array_rand($this->_player_ids,1)]; 
        //Here i randomly pick an ID from the player ID array and this will be the random game oage that is going to be loaded
        $tmasterpage = <<<MASTER
        <div class="container">
        	<div class="header clearfix">
        		<nav>
        		    {$tauth}
        			<ul class="nav nav-pills pull-right">
        				<li role="presentation" class="active"><a href="index.php">Home</a></li>
        				<li role="presentation"><a href="consoleinfo.php">About Console</a></li>
        				<li role="presentation"><a href="rankings.php">Game Rankings</a></li>
        				<li role="presentation"><a href="player.php?id={$tid}">Random Game</a></li>
                        <li role="presentation"><a href="datainput.php">Create Account</a></li>
        			</ul>			
        			<h3 class="text-muted">Simnaan Reviews</h3>
        
        		</nav>
        	</div>
        	<div class="jumbotron">
        		{$this->_dynamic_1}
            </div>
        	<div class="row details">
        		{$this->_dynamic_2}
            </div>
            <footer class="footer">
        		{$this->_dynamic_3}
        	</footer>
        </div>        
        MASTER;
        $this->_htmlpage->setBodyContent($tmasterpage);
    }
}

?>