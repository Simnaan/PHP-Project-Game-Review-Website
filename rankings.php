<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

function renderBreadCrumb()
{
    $tbread = <<<BREAD
    <ul class="breadcrumb">
    <li><a href="index.php">Home</a></li>
    <li class="active">Game Rankings</li>
    </ul>
BREAD;
    return $tbread;
}

function createPage($pimgdir,$pcurrpage)
{  
    //Get the Data we need for this page
    $tci    = dalfactoryCreategameCarousel();
    $tgames = dalfactoryCreateGameList();

    $tgamestable = renderGameTable($tgames);
   
    //Use the Presentation Layer to build the UI Elements
    $tcarousel   = renderCarousel($tci,$pimgdir);
    $tbc         = renderBreadCrumb();
    
    
$tcontent = <<<PAGE
        {$tcarousel}
        {$tbc}
		<div class="row">
			<div class="panel panel-primary">
				<h2>Top Game Rankings</h2>
				<p>List of the top games on PlayStation 4</p>
			    {$tgamestable}
			</div>
		</div>
PAGE;

return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

$tpagetitle = "Game Rankings";
$tpage = new MasterPage($tpagetitle);
$timgdir = $tpage->getPage()->getDirImages();

//Build up our Dynamic Content Items. 
$tpagelead  = "";
$tcurrpage = "";
$tpagecontent = createPage($timgdir,$tcurrpage);
$tpagefooter = "";

//----BUILD OUR HTML PAGE----------------------------
//Set the Three Dynamic Areas (1 and 3 have defaults)
if(!empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if(!empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
//Return the Dynamic Page to the user.    
$tpage->renderPage();
?>