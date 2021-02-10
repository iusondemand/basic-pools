<?php



function pubblica($tit, $body, $meta = "", $tabs ="") {

	### it's very basic, extracted from another tool I use. Customize as you like

	$template = file_get_contents("materialize.htm");
	
	global $template,$nav_menu;
	
	$tmp =  str_replace(
		array("--title--","--site_title--","--main--","--meta--") ,
		array($tit, $title, $body, $meta,  $nav_menu),
		$template);
    $tmp = str_replace(".youtube.com",".youtube-nocookie.com",$tmp);

    echo $tmp;
}
