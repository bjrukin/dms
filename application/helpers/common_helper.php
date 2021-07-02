<?php

function make_seo_url($string)
{
	$string = preg_replace("`\[.*\]`U","",$string);
	$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
	$string = htmlentities($string, ENT_COMPAT, 'utf-8');
	$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
	$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
	return strtolower(trim($string, '-'));
}

function send_mail($from,$from_name,$to,$subject,$message,$attachments=NULL)
{
	
	$CI =& get_instance();
	$CI->load->library('email');
	
	$config['charset'] = 'iso-8859-1';
	$config['wordwrap'] = TRUE;
	$config['mailtype'] = 'html';
	$CI->email->initialize($config);
	$CI->email->clear(TRUE);
	$CI->email->from($from, $from_name);
	$CI->email->to($to);
	$CI->email->subject($subject);
	$CI->email->message($message);
	if(!is_null($attachments))
	{
		if(is_array($attachments))
		{
			for($i=0;$i<count($attachments);$i++)
			{
				$CI->email->attach($attachments[$i]);
			}
		}
		else
		{
			$CI->email->attach($attachments);
		}
	}
	$CI->email->send();
}
function strip_word_comment($str,$n=500,$end_char = '&#8230;',$divid )
{
	if (strlen($str) < $n)
		{
			return $str;
		}
		
		if (strlen($str) <= $n)
		{
			return $str;
		}
		$end_char="<span style=\"cursor:pointer;color:#096; \" onclick=\"seemorecomment('".addslashes($str)."','".$divid."')\">".$end_char."</span>" ;	
		$out=substr($str,0,$n);
		$out=$out." ".$end_char;
		return $out;
}

function strip_word($str,$n=17,$end_char = '&#8230;')
{
	if (strlen($str) < $n)
		{
			return $str;
		}
		
		if (strlen($str) <= $n)
		{
			return $str;
		}
		$end_char="..." ;	
		$out=substr($str,0,$n);
		$out=$out." ".$end_char;
		return $out;
}

function generateCode($length=6,$level=2){

   list($usec, $sec) = explode(' ', microtime());
   srand((float) $sec + ((float) $usec * 100000));

   $validchars[1] = "0123456789abcdfghjkmnpqrstvwxyz";
   $validchars[2] = "0123456789abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
   $validchars[3] = "0123456789_!@#$%&*()-=+/abcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_!@#$%&*()-=+/";

   $code  = "";
   $counter   = 0;

   while ($counter < $length) {
     $actChar = substr($validchars[$level], rand(0, strlen($validchars[$level])-1), 1);

     // All character must be different
     if (!strstr($code, $actChar)) {
        $code  .= $actChar;
        $counter++;
     }
   }

   return $code;  

}

function generate_recaptcha()
{
	$CI =& get_instance();
	$CI->bep_assets->load_asset('recaptcha');
	$CI->load->module_library('recaptcha','Recaptcha');
	return $CI->recaptcha->recaptcha_get_html();
}
