<?php
class custom
{
	
	
	
	function sql_safe($var = "")
	{
		if( ! isset($var) )
		{
			$var = "";
		}
		
		$var = trim($var);
		$var = str_replace("'","'",$var);
		$var = str_replace(",",",",$var);
		$var = stripslashes($var);
		//--$var = mysql_escape_string($var); //--- <sheng> removed cuz not needed when using pdo in sql statements
		return $var;
	}

	/******************************************************************************************************************
	'' @DESCRIPTION: 	Makes a string javascript persistent. Changes special characters, etc.
	'' @DESCRIPTION:	using this function it has to be possible to pass any string which should be 
	''					executed in a javascript later. example: you want to execute the following
	''					onclick="obj.value='" & usrInput & "'. so in this case usrInput needs to be validated that no
	''					javascript error happens when he/she enters e.g. a '.
	'' @PARAM:			val [string]: the value which needs to be encoded
	'' @RETURN:			[string] encoded string which can be used within javascript strings.
	'******************************************************************************************************************/
	function js_encode($val)
	{
		$val = $val . "";
		$tmp = str_replace(chr(92), "\\", $tmp);
		$tmp = str_replace(chr(39), "\'", $val);
		$tmp = str_replace(chr(34), "&quot;", $tmp);
		$tmp = str_replace(chr(13), "<br>", $tmp);
		$tmp = str_replace(chr(10), " ", $tmp);
		return $tmp;
	}

	
	function grid_safe($val)
	{
		$output = '';
		$val = addslashes($val);
		$output = htmlspecialchars($val . "");
		$output = str_replace("'", "&#39;",$output);
		$output = $this->js_encode($output);
		return $output;
	}
	function new_id(){
		$unique_id = "_".strtoupper(uniqid());
		return $unique_id;
	}
	
	function create_image( $dir, $file, $new_file, $width, $height, $proportional=true, $use_linux_command=false )
	{		
		// Target dimensions
		$max_width = $width;
		$max_height = $height;
			
		$info = getimagesize($dir.$file);
		$image = '';
		
		$final_width = 0;
		$final_height = 0;
		list($width_old, $height_old) = $info;
		
		if ($proportional) {
			// Get current dimensions
			$old_width  = $width_old;
			$old_height = $height_old;
			
			// Calculate the scaling we need to do to fit the image inside our frame
			$scale      = min($max_width/$old_width, $max_height/$old_height);
			
			// Get the new dimensions
			$final_width  = ceil($scale*$old_width);
			$final_height = ceil($scale*$old_height);
		}
		else {
			$final_width = $width;
			$final_height = $height;
		}
	
		switch ( $info['mime'] ) {
			case "image/jpeg":
				$image = imagecreatefromjpeg($dir.$file);	
			break;
			case "image/gif":
				$image = imagecreatefromgif($dir.$file);
			break;
			case "image/png":
				$image = imagecreatefrompng($dir.$file);
			break;	
			default:
				return false;
		}
		
		$image_resized = imagecreatetruecolor( $final_width, $final_height );
		imagecolortransparent($image_resized, imagecolorallocate($image_resized, 0, 0, 0) );
		imagealphablending($image_resized, false);
		imagesavealpha($image_resized, true);
		
		imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);
		
		switch ( $info['mime'] ) {
			case "image/gif":
				imagegif($image_resized, $dir.$new_file);
			break;
			case "image/jpeg":
				imagejpeg($image_resized, $dir.$new_file);
			break;
			case "image/png":
				imagepng($image_resized, $dir.$new_file);
			break;
			default:
				return false;
		}
		
		return true;
	}
	
	function radio_arr($options=array(), $values=array(), $name="", $selected_value="", $separator="", $other_attributes="")
	{
		$output = '';
		$id = '';
		$i = 0;
		foreach ($values as $value) {
			$check = $selected_value==$value ? 'checked="checked"' : '';
			$output .= "<input class=\"left\" type=\"radio\" name=\"$name\" id=\"$name"."_".$i."\" value=\"$values[$i]\" $check $other_attributes /> <label class=\"left\">".$separator.$options[$i].$separator."</label>\r\n";
			$i++;
		}
		return $output;
	}

	function checkbox($option="",$value="",$name="",$id="",$selected_value, $other_attributes="",$separator="")
	{
		$output = '';
		$check = $selected_value > 0 ? 'checked="checked"' : '';
		$output = "<input class=\"left\" type=\"checkbox\" name=\"$name\" id=\"$id\" value=\"$value\" $check $other_attributes /> <label class=\"left\">".$option." ".$separator."</label>\r\n";
		return $output;
	}


	function dropdown_option($option,$value,$selected=false)
	{
		$select_value = $selected==true ? "selected=\"selected\"" : '';
		return "<option value=\"$value\" $select_value >$option</option>\r\n";
	}


	function dropdown($name,$options,$other_attr)
	{
		return "<select name=\"$name\" id=\"$name\" $other_attr >\r\n$options\r\n</select>\r\n";
	}

	
	function dropdown_rs($rs,$value_display=array(),$name="",$selected_value="",$select_text="",$other_attributes="")
	{	
		$selectopt_tmp = ($selected_value==0 || $selected_value=='') ? "selected=\"selected\"" : '';		
		$output = "";
		
		$output .= "<select name=\"$name\" id=\"$name\" $other_attributes >\r\n";	
		if($select_text) {
			$output .= "    <option value=\"\" $selectopt_tmp>- $select_text -</option>\r\n";
		}
		if ($rs)
		{
			foreach ($rs as $row)
			{
				$select_option = "";
				if ($selected_value > 0 || $selected_value != '') {
					
					if ($row->$value_display['value'] == $selected_value) {
						$select_option = "selected=\"selected\"";
					}elseif (strcmp(strtoupper($row->$value_display['value']),strtoupper($selected_value))==0) {
						$select_option = "selected=\"selected\"";
					}
				}
				$output .= "    <option value=\"".$row->$value_display['value']."\" $select_option >".$row->$value_display['display']."</option>\r\n";	
				$i++;
			}
		}
		$output .= "</select>\r\n";
		return $output;
	}

	function dropdown_arr($options=array(), $values=array(), $name="", $selected_value=NULL, $select_text="", $other_attributes="")
	{	
		$selectopt_tmp = ($selected_value==0 || $selected_value=='') ? "selected=\"selected\"" : '';		
		$output = "";
		$output .= "<select name=\"$name\" id=\"$name\" $other_attributes >\r\n";	
		$output .= "    <option value=\"\" $selectopt_tmp>$select_text</option>\r\n";
		
		if ($values)
		{
			$i = 0;	
			foreach ($values as $value)
			{
				$select_option = "";
				if ($selected_value > 0) {				
					if ($values[$i] == $selected_value) {
						$select_option = "selected=\"selected\"";
					}
				}
				$output .= "    <option value=\"$values[$i]\" $select_option >$options[$i]</option>\r\n";	
				$i++;
			}
		}
		$output .= "</select>\r\n";
		return $output;
	}
}
?>