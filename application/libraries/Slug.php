<?php 

defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Slug
{
	

	function create($string, $ext=''){     
        $replace = '-';         
        $string = strtolower($string);     
		
        //replace / and . with white space     
        $string = preg_replace("/[\/\.]/", " ", $string);     
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);     
		
        //remove multiple dashes or whitespaces     
        $string = preg_replace("/[\s-]+/", " ", $string);     
		
        //convert whitespaces and underscore to $replace     
        $string = preg_replace("/[\s_]/", $replace, $string);     
		
        //limit the slug size     
        $string = substr($string, 0, 100);     
		
        //slug is generated     
        return ($ext) ? $string.$ext : $string; 
    } 
}