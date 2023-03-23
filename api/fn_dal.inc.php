<?php

// Include the Class Include
require_once ("oo_bll.inc.php");
require_once ("oo_pl.inc.php");

function dalfactoryCreateConsole(): BLLConsole
{
    $tconsole = new BLLConsole("Playstation", "4");
    $tconsole->developer = "Sony Computer Entertainment";
    $tconsole->manufacturer = "Sony, Foxconn";
    $tconsole->product_family = "PlayStation";
    $tconsole->release_date = "29th November 2013";
    $tconsole->units_sold = "106 million";
    return $tconsole;
}

function jsonOne($pfile, $pid)
{
    $tsplfile = new SplFileObject($pfile);
    $tsplfile->seek($pid - 1);
    $tdata = json_decode($tsplfile->current());
    return $tdata;
}

function jsonAll($pfile)
{
    $tentries = file($pfile);
    $tarray = [];
    foreach ($tentries as $tentry) {
        $tarray[] = json_decode($tentry);
    }
    return $tarray;
}

function jsonLoadOneGame($pid): BLLGamet
{
    $tplayer = new BLLGamet();
    $tplayer->fromArray(jsonOne("data/json/games.json", $pid));
    return $tplayer;
}

function jsonLoadAllGame(): array
{
    $tarray = jsonAll("data/json/games.json");
    return array_map(function ($a) {
        $tc = new BLLGamet();
        $tc->fromArray($a);
        return $tc;
    }, $tarray);
}

function jsonLoadOneGameDesc($pid): BLLGamedesc
{
    $tgamedesc = new BLLGamedesc();
    $tgamedesc->fromArray(jsonOne("data/json/gamedesc.json", $pid));
    return $tgamedesc;
}

function jsonLoadOneGameRetailInfo($pid): BLLGameretailinfo
{
    $tgameretailinfo = new BLLGameretailinfo();
    $tgameretailinfo->fromArray(jsonOne("data/json/retailinfo.json", $pid));
    return $tgameretailinfo;
}

function jsonLoadOfficialGameReviews($pid): BLLOfficialgamereview
{
    $tofficialgamereview = new BLLOfficialgamereview();
    $tofficialgamereview->fromArray(jsonOne("data/json/officialreview.json", $pid));
    return $tofficialgamereview;
}

function dalfactoryCreateGameList(): BLLGamelist
{
    $tgameslist = [];
    $tgameslist["1"] = new BLLGame(1, "Persona 5 Royal", "10", "Action Role-Playing");
    $tgameslist["2"] = new BLLGame(2, "Fortnite Battle Royale", "9.6", "Battle Royale");
    $tgameslist["3"] = new BLLGame(3, "Horizon Zero Dawn", "9.3", "Action Role-Playing");
    $tgameslist["4"] = new BLLGame(4, "Uncharted 4", "9", "Action-Adventure");
    $tgameslist["5"] = new BLLGame(5, "Minecraft", "9", "Sandbox");
    $tgameslist["6"] = new BLLGame(6, "Star Wars Jedi: The Fallen Order", "9", "Action-Adventure");
    $tgameslist["7"] = new BLLGame(7, "Kingdom Hearts 3", "8.7", "Action-Adventure");
    $tgameslist["8"] = new BLLGame(8, "Marvels Sprider-Man", "8.7", "Action-Adventure");
    $tgameslist["9"] = new BLLGame(9, "Rocket League", "8", "Arcade Racing");
    $tgameslist["10"] = new BLLGame(10, "Fifa 20", "7.8", "Sports Game");

    $tgames = new BLLGamelist();
    $tgames->gamelistname = "Top 10 Games";
    $tgames->gamelist = $tgameslist;
    return $tgames;
}

function dalfactoryCreateGameCarousel(): array
{
    $tcarouselitems = [];
    $tcarouselitems[] = new PLCarouselImage("P5RBanner.jpg", "Game Rankings", "The best games PlayStation 4 has to offer");
    $tcarouselitems[] = new PLCarouselImage("FortniteBanner.png", "Game Rankings", "The best games PlayStation 4 has to offer");
    $tcarouselitems[] = new PLCarouselImage("HZDBanner.jpg", "Game Rankings", "The best games PlayStation 4 has to offer");
    $tcarouselitems[] = new PLCarouselImage("U4Banner.jpg", "Game Rankings", "The best games PlayStation 4 has to offer");
    $tcarouselitems[] = new PLCarouselImage("SWFOBannner.jpg", "Game Rankings", "The best games PlayStation 4 has to offer");
    return $tcarouselitems;
}

function dalfactoryCreateConsoleCarousel(): array
{
    $tcarouselitems = [];
    $tcarouselitems[] = new PLCarouselImage("Playstation4.jpg", "", "About The Console");
    return $tcarouselitems;
}

function dalfactoryCreateHomeArticles(): array
{
    $tarticles = [];
    $tarticle = new PLHomeArticle("Review", "Persona 5", "img/player/P5R.png", "player.php?id=1", "Find out More");
    $tarticle->summary = <<<SUMMARY
        
    SUMMARY;

    $tarticle->content = <<<ARTICLE
        <p>
    				Game Rating - 10
    				</p>
    				<p>Game Summary - Persona 5 takes place in modern-day Tokyo and follows Joker after his transfer to Shujin Academy due to being put on probation for an assault of which he was falsely accused. During a school year, he and other students awaken to special powers, becoming a group of secret vigilantes known as the Phantom Thieves of Hearts. They explore the Metaverse, a supernatural realm born from humanity's subconscious desires, to steal malevolent intent from the hearts of adults. As with previous games in the series, the party battles enemies known as Shadows using physical manifestations of their psyche known as their Persona. The game incorporates role-playing and dungeon crawling elements alongside social simulation scenarios.</p>
    				<p>Game Review - "Person 5 Royal is a living master class in how to take an already amazing game and amp it up to the next level. It’s not just a standard “game of the year” edition with some extra content thrown in on the side. Just about everything in Atlus 2016 (2017 in the US) JRPG magnum opus has been honed, polished, and expanded in some meaningful and positive way. Across more than 130 hours of adventuring through urban Tokyo and the surreal realms of the human mind, the amount of love and attention to detail hiding around each old and new twist in the story left me in awe.\" - T.J.Haher IGN</p>
    ARTICLE;
    // Add to the Array
    $tarticles[] = $tarticle;

    $tarticle = new PLHomeArticle("Top Games", "Top 5 Games", "img/carousel/ps4-logo.png", "rankings.php", "Find out More");
    $tarticle->summary = <<<SUMMARY
        
    SUMMARY;
    // Add to the Array
    $tarticles[] = $tarticle;
    return $tarticles;
}

function dalfactoryCreateNewsItems(): array
{
    $tnilist = [];

    $tni = new PLNewsItem("Persona 5", "", "player.php?id=1", "More...");
    $tni->rating = "Rating - 10";
    $tni->summary = "An action role-playing game filled with mystery";
    $tnilist[] = $tni;

    $tni = new PLNewsItem("Fortnite", "", "player.php?id=2", "More...");
    $tni->rating = "Rating - 9.6";
    $tni->summary = "An interesting Battle Royale game that took the work by storm";
    $tnilist[] = $tni;

    $tni = new PLNewsItem("Horizon Zero Dawn", "", "player.php?id=3", "More...");
    $tni->rating = "Rating - 9.3";
    $tni->summary = "An open world action role-playing game filled with various activities";
    $tnilist[] = $tni;

    $tni = new PLNewsItem("StarWars Jedi: Fallen Order", "", "player.php?id=6", "More...");
    $tni->rating = "Rating - 9";
    $tni->summary = "An action adventure game that takes you through the hardships of being a Jedi";
    $tnilist[] = $tni;

    $tni = new PLNewsItem("Minecraft", "", "player.php?id=5", "More...");
    $tni->rating = "Rating - 9";
    $tni->summary = "An open world sandbox game where your imagination is your limit";
    $tnilist[] = $tni;

    return $tnilist;
}

function dalfactoryCreateConsoleTabs(): array
{
    $ttabs = [];

    // Tab 1
    $ttab = new PLTab("history", "About Console");
    $ttab->content = <<<TAB
        <p>
    						The PlayStation 4 (officially abbreviated as PS4) is an eighth-generation home video game console developed by Sony Computer Entertainment. Announced as the successor to the PlayStation 3 in February 2013, it was launched on November 15 in North America, November 29 in Europe, South America and Australia, and on February 22, 2014 in Japan. It's the 4th best-selling console of all time. It competes with Microsoft's Xbox One and Nintendo's Wii U and Switch.
    					</p>
    
    					<p>Moving away from the more complex Cell microarchitecture of its predecessor, the console features an AMD Accelerated Processing Unit (APU) built upon the x86-64 architecture, which can theoretically peak at 1.84 teraflops; AMD stated that it was the "most powerful" APU it had developed to date. The PlayStation 4 places an increased emphasis on social interaction and integration with other devices and services, including the ability to play games off-console on PlayStation Vita and other supported devices ("Remote Play"), the ability to stream gameplay online or to friends, with them controlling gameplay remotely ("Share Play"). The console's controller was also redesigned and improved over the PlayStation 3, with improved buttons and analog sticks, and an integrated touchpad among other changes. The console also supports HDR10 High-dynamic-range video and playback of 4K resolution multimedia.</p>
    
    					<p>
    						The PlayStation 4 was released to critical acclaim, with critics praising Sony for acknowledging its consumers' needs, embracing independent game development, and for not imposing the restrictive digital rights management schemes like those originally announced by Microsoft for the Xbox One. Critics and third-party studios also praised the capabilities of the PlayStation 4 in comparison to its competitors; developers described the performance difference between the console and Xbox One as "significant" and "obvious". Heightened demand also helped Sony top global console sales. By the end of September 2019, over 102 million PlayStation 4 consoles had been shipped worldwide, surpassing lifetime sales of the PlayStation 3.
    					</p>
    
    					<p>
    						On September 7, 2016, Sony unveiled the PlayStation 4 Slim, a smaller version of the console; and a high-end version called the PlayStation 4 Pro, which features an upgraded GPU and a higher CPU clock rate to support enhanced performance and 4K resolution in supported games.
    					</p>
    
    					<p>
    						For more information click the link below to go to the source for my information.
    					</p>
    
    					<p>
    						<a href="https://en.wikipedia.org/wiki/PlayStation_4">More About Playstion 4</a>
    					</p>
                        <p>
                            Here is a link to the offical Playstaion website. Be sure to check it out.
                        </p>    
                        <p>
    						<a href="https://www.playstation.com/en-gb/explore/ps4/">Playstion 4 website</a>
    					</p>
    TAB;
    $ttabs[] = $ttab;

    // Tab 2
    $ttab = new PLTab("season", "Specs");
    $ttab->content = <<<TAB
        <section class="well">
    						<h4>Operating Software</h4>
    						Playstion 4 system software
    					</section>
    					<section class="well">
    						<h4>CPU</h4>
    						Semi-custom 8-core AMD x86-64 Jaguar 1.6 GHz CPU (2.13 GHz on PS4 Pro) (integrated into APU)
                            Secondary low power processor (for background tasks)
    					</section>
    					<section class="well">
    						<h4>Memory</h4>
    				          8 GB GDDR5 (unified – all models)
                              256 MB DDR3 RAM (for background tasks on PS4 and PS4 Slim)
                              1 GB DDR3 RAM (for background tasks on PS4 Pro)
    
    					</section>
    					<section class="well">
    						<h4>Storage</h4>
    						HDD, 500 GB, 1 TB, 2 TB (user upgradeable, supports SSD)
    					</section>
                        <section class="well">
    						<h4>Graphics</h4>
    						Custom AMD GCN Radeon integrated into APU; clocked at 800MHz (911MHz on PS4 Pro)
    					</section>
                        <section class="well">
    						<h4>Controller Input</h4>
    						DualShock 4, PlayStation Move, PlayStation Vita
    					</section>
    
    TAB;
    $ttabs[] = $ttab;

    return $ttabs;
}

?>