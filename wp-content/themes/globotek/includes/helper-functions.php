<?php
function icon( $svg_title, $css_class = NULL, $type = 'static' ) {
	
	if( $type == 'static' ) {
		
		echo '<svg class="icon ' . $css_class . '" aria-hidden="true">';
		echo '<use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="' . get_template_directory_uri() . '/images/svg/svg-symbols.svg#' . $svg_title . '"></use>';
		echo '</svg>';
		
	} elseif( $type == 'active' ) {
		
		echo '<img src="' . get_template_directory_uri() . '/images/svg/' . $svg_title . '.svg">';
		
	}
	
}