<?php

global $_bf_vc_row_columns;

if ( preg_match_all( '/ \s* \[\s*vc_column\b 
.*? 

width  \s* = \s* 
	(["\']?) 
	
	(?(1) (.*?)\\1 | ([^\s]+) )
	
.*? 
]   /six', $content, $match ) ) {

	$_bf_vc_row_columns = $match[2];
} else {
	$_bf_vc_row_columns = array( '1/1' ); # Default full column width
}


include vc_manager()->getDefaultShortcodesTemplatesDir() . '/vc_row.php';

$_bf_vc_row_columns = array();