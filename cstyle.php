<?php

/*
[--=INDEX=--]
/COMMON STYLE
	/SHORTCODE
[--=END INDEX=--]
*/

/*COMMON STYLE*/
function cstyle($n_select, $n_style) {
    static $cstyle;
    static $common_style;
    if (!empty($n_select) && !empty($n_style)) {
    	if (empty($common_style)) {
    		$common_style = array('' => '');
    	}
    	$is_new = false;
    	$is_old = false;
    	foreach ($common_style as $select => $style) {
    		if (($n_select == $select) && ($n_style == $style)) {	/*IF NEW = CURRENT SELECTORS AND NEW = CURRENT STYLE */
    			$is_old = true;
    		}
    		if (($n_select == $select) && ($n_style != $style)) {	/*IF NEW = CURRENT SELECTORS AND NEW =/= CURRENT STYLE */
    			$n_style = $n_style . $style;
    		}
    		if (($n_select != $select) && ($n_style == $style)) {	/*IF NEW =/= CURRENT SELECTORS AND NEW = CURRENT STYLE */
    			unset($common_style[$select]);
    			$common_style[$n_select . ', ' . $select] = $style;
    			$is_old = true;
    		}
    		if (($n_select != $select) && ($n_style != $style)) {	/*IF NEW =/= CURRENT SELECTORS AND NEW =/= CURRENT STYLE */
    			$is_new = true;
    		}
    	}
    	if ($is_new == true && $is_old == false) {
    		$common_style[$n_select] = $n_style;
    	}
    	if (!empty($common_style)) {
    		$cstyle = '';
	    	foreach ($common_style as $select => $style) {
	    		if (!empty($select) && !empty($style)) {
	    			$cstyle.= $select . ' { ' . $style . ' } ';
	    		}
	    	}
    	}
    }
    return $cstyle;
}
add_action( 'common_style', 'cstyle' );
	/*SHORTCODE*/
	function cstyle_shortcode($atts) {
		cstyle($atts["select"], $atts["style"]);
	}
	add_shortcode( 'cstyle', 'cstyle_shortcode' );
	/*END SHORTCODE*/
/*END COMMON STYLE*/

?>
