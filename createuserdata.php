<?php
function jsonCreatePlayerFormat($pfile,BLLUserData $ud)
{
    $tnewuser = new BLLUserData();
    $tnewuser->id = $ud->id;
    $tnewuser->email = "";
    $tnewuser->password = "";
    $tnewuser->fname = "";
    $tnewuser->lname = "";
    $tnewuser->phonenumber = "";
    $tdata = json_encode($tnewuser).PHP_EOL;
    file_put_contents($pfile,$tdata);
    return $tdata;
}
?>