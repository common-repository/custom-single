<?php
/*
Plugin Name: Custom Single
Plugin URI: http://wordpress.org/plugins/custom-single/
Description: Enables themes to support custom single.php templates per category in the form single-CATEGORYID.php.
Author: Tor N. Johnson
Version: 1.0.0
Author URI: http://profiles.wordpress.org/kasigi
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/


// Enable Sessions to store results
add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}



function get_singleTemplateFile($t){
	$mulchPile=null;
	$selection = null;

	if($_SESSION['cs-categories']==""){
		$args['type']="post";
		$_SESSION['cs-categories'] = get_categories();
	}


	$primaryCategories = get_the_category();
	$sortedCategories = null;
	$keyedCategories = null;

	foreach($primaryCategories as $cat){
		$keyedCategories[$cat->term_id]=$cat;
	}

	foreach($_SESSION['cs-categories'] as $cat){
		if($keyedCategories[$cat->term_id]!=null){
			$sortedCategories[]=$keyedCategories[$cat->term_id];
		}
	}

	if(is_array($sortedCategories)){
	foreach( $sortedCategories as $cat ) { 

		if ( file_exists(TEMPLATEPATH . "/single-{$cat->term_id}.php") ) {
			$selection = TEMPLATEPATH . "/single-{$cat->term_id}.php";
			}
	} 
	}


	if($selection == null && is_array($sortedCategories)){
		foreach( $sortedCategories as $cat ) { 
			if($cat->parent !=""){
				$pCat = $cat->parent;
				$safety = 0;
				while($selection == null and $pCat != "" and $safety < 20){
					if ( file_exists(TEMPLATEPATH . "/single-$pCat.php") ) {
						$selection = TEMPLATEPATH . "/single-$pCat.php";
					}else{
						$pCatArray = get_the_category($pCat);
						if($pCatArray->parent != ""){
							$pCat = $pCatArray->parent;
						}
					}
					$safety++;
				}
			}
		}
	}



	if($selection != null){
		return $selection;
	}else{
		return $t;
	}
}// end get_singleTemplateFile
// return TEMPLATEPATH . "/single-{$cat->term_id}.php";
add_filter('single_template', 'get_singleTemplateFile');
