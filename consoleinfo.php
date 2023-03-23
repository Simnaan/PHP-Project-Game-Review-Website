<?php 
//----INCLUDE APIS------------------------------------
include("api/api.inc.php");

//----PAGE GENERATION LOGIC---------------------------

function createPage()
{
    //Get the Data we need for this page
    $tcitems = dalfactoryCreateConsoleCarousel();
    $ttabs   = dalfactoryCreateConsoleTabs();
    $tconsole = dalfactoryCreateConsole();
    
    //Build the UI Components
    $tcarouselhtml = renderCarousel($tcitems,"img");
    $ttabhtml = renderTabs($ttabs,"myTabContent");
    $tconsolehtml = renderConsoleOverview($tconsole);

$tcontent = <<<PAGE
    {$tcarouselhtml}
    <section class="row details" id="Console-overview">
    {$tconsolehtml}
    </section>
    <section class="row details" id="Console-info">
    {$ttabhtml}
    </section>
PAGE;

return $tcontent;
}

//----BUSINESS LOGIC---------------------------------
//Start up a PHP Session for this user.
session_start();

//Build up our Dynamic Content Items. 
$tpagetitle = "About Console";
$tpagelead  = "";
$tpagecontent = createPage();
$tpagefooter = "";

//----BUILD OUR HTML PAGE----------------------------
//Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
//Set the Three Dynamic Areas (1 and 3 have defaults)
if(!empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if(!empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
//Return the Dynamic Page to the user.    
$tpage->renderPage();
?>