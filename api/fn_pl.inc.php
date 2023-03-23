<?php
require_once ("oo_bll.inc.php");
require_once ("oo_pl.inc.php");

function renderConsoleOverview(BLLConsole $pm)
{
    $tmanhtml = <<<OVERVIEW
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Console Overview: {$pm->fname} {$pm->lname}</h3>
            </div>
            <div class="panel-body">
                <ul class="list-group">
                    <li class="list-group-item">
                        <span class="badge">{$pm->developer}</span>
                        Developer
                    </li>
                    <li class="list-group-item">
                        <span class="badge">{$pm->manufacturer}</span>
                        Manufacturer
                    </li>
                    <li class="list-group-item">
                        <span class="badge">{$pm->product_family}</span>
                        Product Family
                    </li>
                    <li class="list-group-item">
                    <span class="badge">{$pm->release_date}</span>
                        Release Date
                    </li>
                    <li class="list-group-item">
                    <span class="badge">{$pm->units_sold}</span>
                        Units Sold
                    </li>
                </ul>
            </div>
         </div>
    OVERVIEW;
    return $tmanhtml;
}

function renderGameOverview(BLLGamet $pp, BLLGamedesc $gd, BLLGameretailinfo $gri, BLLOfficialgamereview $gor)
{
    $timgref = "img/player/{$pp->gamerank}.jpg";
    $timg = $timgref;
    $toverview = <<<OVERVIEW
        <article class="row marketing">
            <h2>Game Details</h2>
            <div class="media-left">
                <img src="$timg" width="256" />
            </div>
            <div class="media-body">
                <div class="well">
                    <h1>{$pp->name}</h1>
                </div>
                <h2>Game Rank: {$pp->gamerank}</h2>
                <h3>Game Rating: {$pp->rating}</h3>
                <h3>Genre: {$pp->genre}</h3>
                <h3>Release Date: {$pp->releasedate}</h3>
            </div>
    
        <section class="row details" id="Game-info">
        <h2>Game Description:</h2>
        <h3> {$gd->summary}</h3>
        <h3></h3>
        <h3>For more information click this link to go to the source of the information above: <a href="{$gd->link}">More About {$pp->name}</a></h3>
        </section>
    
        <section class="row details" id="Game-Reail-Information">
        <h2>Amazon Link: <a href="{$gri->link1}"> £{$gri->link1price}</a></h2>
        <h2>GAME Link: <a href="{$gri->link2}"> £{$gri->link2price}</a></h2>
        <h2>PlayStation Store Link: <a href="{$gri->link3}"> £{$gri->link3price}</a></h2>
        </section>
                <section class="row details" id="Official-Game-Review">
                <h2>Official Review: </h2>
                <h2>{$gor->reviewsite1}</h2>
                <h3>{$gor->review1}</h3>
                <h3>Rating: {$gor->rating1}</h3>
                <h3>Heres a link to the full review: <a href="{$gor->link1}"> {$gor->reviewsite1}</a></h3>
                <h2> </h2>
                <h2>Official Review: </h2>
                <h2>{$gor->reviewsite2}</h2>
                <h3>{$gor->review2}</h3>
                <h3>Rating: {$gor->rating2}</h3>
                <h3>Heres a link to the full review: <a href="{$gor->link2}"> {$gor->reviewsite2}</a></h3>
                <h2> </h2>
                <h2>Official Review: </h2>
                <h2>{$gor->reviewsite3}</h2>
                <h3>{$gor->review3}</h3>
                <h3>Rating: {$gor->rating3}</h3>
                <h3>Heres a link to the full review: <a href="{$gor->link3}"> {$gor->reviewsite3}</a></h3>
                </section>
                    
                    <section class="row details" id="Editorial-Game-Review">
                    <h2>Editorial Review:</h2>
                    <h3>{$gor->editorialreview}</h3>
                    </section>
     
        </article>
    OVERVIEW;
    return $toverview;
}

function renderGameRow(BLLGame $pp)
{
    $trow = <<<PROW
        		<tr>
        		    <td>{$pp->gamerank}</td>
        		    <td>{$pp->name}</td>
    				<td>{$pp->rating}</td>
    				<td>{$pp->genre}</td>
                    <td><a class="btn btn-info" href="player.php?id={$pp->gamerank}">More...</a></td>
    			</tr>
    			
    PROW;
    return $trow;
}

function renderGameTable(BLLGamelist $pgame)
{
    $trowdata = "";
    foreach ($pgame->gamelist as $tp) {
        $trowdata .= renderGameRow($tp);
    }
    $ttable = <<<TABLE
    <table class="table table-striped table-hover">
    					<thead>
    						<tr>
    							<th>Rank</th>
    							<th>Name</th>
    							<th>Rating</th>
    							<th>Genre</th>
    						</tr>
    					</thead>
    					<tbody>
    					{$trowdata}
    					</tbody>
    </table>
    TABLE;
    return $ttable;
}

function renderCarousel(array $pimgs, $pimgdir)
{
    $tci = "";
    $count = 0;

    // -------Build the Images---------------------------------------------------------
    foreach ($pimgs as $titem) {
        $tactive = $count === 0 ? " active" : "";
        $thtml = <<<ITEM
                <div class="item{$tactive}">
                    <img class="img-responsive" src="{$pimgdir}/carousel/{$titem->imgref}">
                    <div class="container">
                        <div class="carousel-caption">
                            <h1>{$titem->title}</h1>
                            <p class="lead">{$titem->lead}</p>
        		        </div>
        			</div>
        	    </div>            
        ITEM;
        $tci .= $thtml;
        $count ++;
    }

    // --Build Navigation-------------------------
    $tdot = "";
    $tdotset = "";
    $tarrows = "";

    if ($count > 1) {
        for ($i = 0; $i < count($pimgs); $i ++) {
            if ($i === 0)
                $tdot .= "<li data-target=\"#myCarousel\" data-slide-to=\"$i\" class=\"active\"></li>";
            else
                $tdot .= "<li data-target=\"#myCarousel\" data-slide-to=\"$i\"></li>";
        }
        $tdotset = <<<INDICATOR
                <ol class="carousel-indicators">
                {$tdot}
                </ol>
        INDICATOR;
    }
    if ($count > 1) {
        $tarrows = <<<ARROWS
        		<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
        		<a class="right carousel-control" href="#myCarousel" data-slide="next"> <span class="glyphicon glyphicon-chevron-right"></span></a>
        ARROWS;
    }

    $tcarousel = <<<CAROUSEL
        <div class="carousel slide" id="myCarousel">
                {$tdotset}
    			<div class="carousel-inner">
    				{$tci}
    			</div>	
    		    {$tarrows}
        </div>
    CAROUSEL;
    return $tcarousel;
}

function renderTabs(array $ptabs, $ptabid)
{
    $count = 0;
    $ttabnav = "";
    $ttabcontent = "";

    foreach ($ptabs as $ttab) {
        $tnavactive = "";
        $ttabactive = "";
        if ($count === 0) {
            $tnavactive = " class=\"active\"";
            $ttabactive = " active in";
        }
        $ttabnav .= "<li{$tnavactive}><a href=\"#{$ttab->tabid}\" data-toggle=\"tab\">{$ttab->tabname}</a></li>";
        $ttabcontent .= "<article class=\"tab-pane fade{$ttabactive}\" id=\"{$ttab->tabid}\">{$ttab->content}</article>";
        $count ++;
    }

    $ttabhtml = <<<HTML
            <ul class="nav nav-tabs">
            {$ttabnav}
            </ul>
        	<div class="tab-content" id="{$ptabid}">
    			  {$ttabcontent}
    		</div>
    HTML;
    return $ttabhtml;
}

function renderHomeArticle(PLHomeArticle $phome, $pwidth = 6)
{
    $thome = <<<HOME
        <article class="col-lg-{$pwidth}">
    		<h2>{$phome->heading}</h2>
    		<h4>
    			<span class="label label-success">{$phome->tagline}</span>
    		</h4>
    		<div class="home-thumb">
    			<img src="{$phome->storyimg}" />
    		</div>
    		<div class="text-primary">
    			{$phome->summary}
    		</div>
            <div class="text">
    		    {$phome->content}
            <div>
            <div class="options">
    			<a class="btn btn-info" href="{$phome->link}">{$phome->linktitle}</a>
            </div>
    	</article>
    HOME;
    return $thome;
}

function renderNewsSummary(PLNewsItem $pitem)
{
    $tnewsitem = <<<NI
    		    <section class="list-group-item">
    				<h4 class="list-group-item-heading">{$pitem->heading}</h4>
                    <p class="list-group-item-text">{$pitem->rating}</p>
    				<p class="list-group-item-text">{$pitem->summary}</p>
    				<a class="btn btn-xs btn-default" href="{$pitem->link}">{$pitem->linktext}</a>
    			</section>
    NI;
    return $tnewsitem;
}

?>