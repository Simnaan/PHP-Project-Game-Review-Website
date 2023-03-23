<?php
// ----INCLUDE APIS------------------------------------
include ("api/api.inc.php");

// ----PAGE GENERATION LOGIC---------------------------
function createPage($pgames, $pgamedesc, $pgameretailinfo, $pogamereview)
{
    $tgameprofile = "";
    
    foreach ($pgames as $tp){
        foreach ($pgamedesc as $tg)
            foreach ($pgameretailinfo as $tgr)
                foreach ($pogamereview as $tor)
                $tgameprofile .= renderGameOverview($tp, $tg, $tgr, $tor);
    }

    $tcontent = <<<PAGE
          {$tgameprofile}
    PAGE;
    return $tcontent;
}

// ----BUSINESS LOGIC---------------------------------
// Start up a PHP Session for this user.
session_start();

// Use our Data Access Layer to create our Squad
//$tgames = dalfactoryCreateGameList();

$tgames = [];
$tgameretailinfos = [];
$tofficialreviews = [];
$tgamedescs = [];
$tname = $_REQUEST["name"] ?? "";
$tgamerank = $_REQUEST["gamerank"] ?? -1;
$tid = $_REQUEST["id"] ?? -1;

//Handle our Requests and Search for Players using different methods
if (is_numeric($tid) && $tid > 0)
{
    $tgame = jsonLoadOneGame($tid);
    $tgamedesc = jsonLoadOneGameDesc($tid);
    $tgameretailinfo = jsonLoadOneGameRetailInfo($tid);
    $togamereview = jsonLoadOfficialGameReviews($tid);
    $tgames[] = $tgame;
    $tgamedescs[] = $tgamedesc;
    $tgameretailinfos[] = $tgameretailinfo;
    $tofficialreviews[]=$togamereview;
} 
else if (!empty($tname))
{
    //Filter the name
    $tname = appFormProcessData($tname);
    $tplayerlist = jsonLoadAllGame();
    foreach ($tplayerlist as $tp)
    {
        if (strtolower($tp->name) === strtolower($tname))
        {
            $tgames[] = $tp;
        }
    }
}
else if($tgamerank > 0)
{
    $tplayerlist = jsonLoadAllGame();
    foreach ($tplayerlist as $tp)
    {
        if ($tp->gamerank === $tgamerank)
        {
            $tgames[] = $tp;
            break;
        }
    }
}

if(count($tgames)==0)
{
    header("Location: app_error.php");
    return;
}
else{
// We've found our player
    $tpagecontent = createPage($tgames, $tgamedescs, $tgameretailinfos, $tofficialreviews);

$tpagetitle = "Game Information";
$tpagelead = "";
$tpagefooter = "";
}
// ----BUILD OUR HTML PAGE----------------------------
// Create an instance of our Page class
$tpage = new MasterPage($tpagetitle);
// Set the Three Dynamic Areas (1 and 3 have defaults)
if (! empty($tpagelead))
    $tpage->setDynamic1($tpagelead);
$tpage->setDynamic2($tpagecontent);
if (! empty($tpagefooter))
    $tpage->setDynamic3($tpagefooter);
// Return the Dynamic Page to the user.
$tpage->renderPage();

?>