<?php

class Comment
{
	private $data = array();
	
	public function __construct($row)
	{
		/*
		/	The constructor
		*/
		
		$this->data = $row;
	}
	
	public function markup()
	{
		/*
		/	This method outputs the XHTML markup of the comment
		*/
		
		// Setting up an alias, so we don't have to write $this->data every time:
		$d = &$this->data;
		
		// Converting the time to a UNIX timestamp:
		$d['dt'] = strtotime($d['dt']);
	}
	
	public static function validate(&$arr)
	{
		/*
		/	This method is used to validate the data sent via AJAX.
		/
		/	It return true/false depending on whether the data is valid, and populates
		/	the $arr array passed as a paremter (notice the ampersand above) with
		/	either the valid input data, or the error messages.
		*/
		
		$errors = array();
		$data	= array();
		
		// Using the filter with a custom callback function:
		
		if(!($data['body'] = filter_input(INPUT_POST,'body',FILTER_CALLBACK,array('options'=>'Comment::validate_text'))))
		{
			$errors['body'] = 'Please enter a comment body.';
		}
		
		if(!empty($errors)){
			
			// If there are errors, copy the $errors array to $arr:
			
			$arr = $errors;
			return false;
		}
		
		// If the data is valid, sanitize all the data and copy it to $arr:
		
		foreach($data as $k=>$v){
			$arr[$k] = mysql_real_escape_string($v);
		}
		
		
		return true;
		
	}

	private static function validate_text($str)
	{
		/*
		/	This method is used internally as a FILTER_CALLBACK
		*/
		
		if(mb_strlen($str,'utf8')<1)
			return false;
		
		// Encode all html special characters (<, >, ", & .. etc) and convert
		// the new line characters to <br> tags:
		
		$str = nl2br(htmlspecialchars($str));
		
		// Remove the new line characters that are left
		$str = str_replace(array(chr(10),chr(13)),'',$str);
		
		return $str;
	}

}

?>