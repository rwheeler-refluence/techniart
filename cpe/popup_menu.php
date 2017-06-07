<?php

////////////////////////////////////////////////////////////
//   PopUpMenu 0.5
//   make a popup menu that maintains its state
//
//   Paul Schreiber
//   paul@magic.ca
//   http://paulschreiber.com/
//
//   parameters
//   ----------
//
//   name: the name attribute you want for the <SELECT> tag
//
//   values: a hash that contains the values and labels for
//           the <OPTION> tags
//
//   javascript: javascript for the <SELECT> tag, i.e.
//               onChange="this.form.submit()" [optional]
//
//   size: the SIZE attribute for the <SELECT> tag [optional]
//
//
//

if ( !defined('POPUP_MENU_DEFINED') ) {
	define('POPUP_MENU_DEFINED', TRUE);

		function popup_menu ($name, $values, $javascript = "", $size = 1) {

			// grab this to maintain state
			global $$name;
			$selected = ($$name) ? $$name : "";

			// start building the popup meny
			$result = "<select id=\"state\" name=\"$name\"";
			
			if ($size != 1)
				$result .= " size=\"$size\"";
				
			if ($javascript)
				$result .= " " . $javascript;
			
			$result .= ">\n";
			
			$result .= "<option value=\"none\">\n";
			
			// list all the options
			while ( list( $value, $label ) = each( $values ) ) {
			
				// printed SELECTED if an item was previously selected
				// so we maintain the state
				if ($selected == $value) {
					$result .= "<option value=\"$value\" SELECTED>$label\n";
				} else {
					$result .= "<option value=\"$value\">$label\n";
				}
			}
			
			// finish the popup menu
			$result .= "</select>\n";
			
			echo $result;
		}

}

?>
