Version 1.0.0
+++++++++++++
This version is first version of BS Wiki released under MIT license(for more info read License.md under root directory of skin).
Features:
1. Bootstrap based responsive skin
2. Configurable Social icons to connect to your pages.

Installation:
place this line at the end of your LocalSettings.php

require_once "$IP/skins/bswiki/BSWiki.php";

you can place the link to your facebook, google plus, youtube, email and/or twitter account on the top navbar. to do so, assign the link of page to following global variables.

$wgBSWfblink = "https://www.facebook.com/ExamsMyantra";

and similarly for other social networks, there is limited number of social links place, others are listed below.

$wgBSWgooglelink, $wgBSWtwitterlink, $wgBSWyoutubelink, $wgBSWemaillink.
======================================================