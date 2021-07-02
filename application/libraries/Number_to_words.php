<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
* PROJECT
*
* @package         PROJECT
* @author          <AUTHOR_NAME>
* @copyright       Copyright (c) 2016
*/

// ---------------------------------------------------------------------------

/**
* Number_to_Words
*
*/
class Number_to_Words {

	public function convert_number($number) 
	{
		if (($number < 0) || ($number > 999999999)) 
		{
			throw new Exception("Number is out of range");
		}

		$Gn = floor($number / 1000000);
		/* Millions (giga) */
		
		$number -= $Gn * 1000000;
		$kn = floor($number / 1000);

		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);

		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);

		/* Tens (deca) */
		$n = $number % 10;

		/* Ones */

		$res = "";

		if ($Gn) 
		{
			$res .= $this->convert_number($Gn) .  " Million";
		}

		if ($kn) 
		{
			$res .= (empty($res) ? "" : " ") .$this->convert_number($kn) . " Thousand";
		}

		if ($Hn) 
		{
			$res .= (empty($res) ? "" : " ") .$this->convert_number($Hn) . " Hundred";
		}

		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");

		if ($Dn || $n) 
		{
			if (!empty($res)) 
			{
				$res .= " and ";
			}

			if ($Dn < 2) 
			{
				$res .= $ones[$Dn * 10 + $n];
			} else 
			{
				$res .= $tens[$Dn];

				if ($n) {
					$res .= " " . $ones[$n];
				}
			}
		}

		if (empty($res)) 
		{
			$res = "zero";
		}

		return $res;
	}

	public function convert_number_nepali($number) 
	{
		if (($number < 0) || ($number > 999999999)) 
		{
			throw new Exception("Number is out of range");
		}

		$Cc = floor($number / 10000000);

		$number -= $Cc * 10000000;
		$Lc = floor($number / 100000);
		/* Millions (giga) */
		
		$number -= $Lc * 100000;
		$kn = floor($number / 1000);

		/* Thousands (kilo) */
		$number -= $kn * 1000;
		$Hn = floor($number / 100);

		/* Hundreds (hecto) */
		$number -= $Hn * 100;
		$Dn = floor($number / 10);

		/* Tens (deca) */
		$n = $number % 10;

		/* Ones */

		$res = "";

		if ($Cc) 
		{
			$x = $this->convert_number_nepali($Cc);
			$res .= $x .  (($x != 'One') ? " Crores" : " Crore");
		}

		if ($Lc) 
		{
			$x = $this->convert_number_nepali($Lc);
			$res .= (empty($res) ? "" : " ") . $x .  (($x != 'One') ? " Lakhs" : " Lakh");
		}

		if ($kn) 
		{
			$x = $this->convert_number_nepali($Lc);
			$res .= (empty($res) ? "" : " ") . $x . (($x != 'One') ? " Thousands" : " Thousand");
		}

		if ($Hn) 
		{
			$x = $this->convert_number_nepali($Lc);
			$res .= (empty($res) ? "" : " ") . $x . (($x != 'One') ? " Hundreds" : " Hundred");
		}

		$ones = array("", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", "Nineteen");
		$tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety");

		if ($Dn || $n) 
		{
			if (!empty($res)) 
			{
				$res .= " and ";
			}

			if ($Dn < 2) 
			{
				$res .= $ones[$Dn * 10 + $n];
			} else 
			{
				$res .= $tens[$Dn];

				if ($n) {
					$res .= " " . $ones[$n];
				}
			}
		}

		if (empty($res)) 
		{
			$res = "zero";
		}

		return $res;
	}

	public function nepali_number_format($number, $precison = 2)
	{
		$number = strrev($number);

		$chunk0 = substr($number, 0,3);
		$chunk1 = substr($number, 3);

		$a = str_split($chunk1, 2);
		array_unshift($a, $chunk0);

		$format = "%0{$precison}d";
		return strrev(implode(",", $a)) . "." . sprintf($format, "");

	}
	public function number_to_words_nepali_format($number, $currency_symbol = "Rs. ", $currency_symbol2 = " Paisa")
	{
		if($number < 0)
		{
			// $minus = '-';
			$number = $number * -1;
		}
		$no = round($number);
		$point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
	$words = array('0' => '', '1' => 'One', '2' => 'Two',
			'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
			'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
			'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
			'13' => 'Thirteen', '14' => 'Fourteen',
			'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
			'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
			'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
			'60' => 'Sixty', '70' => 'Seventy',
			'80' => 'Eighty', '90' => 'Ninety');
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. $digits[$counter] . $plural . " " . $hundred;
			} else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$points = ($point) ?
		" and" . $words[$point / 10] . " " . 
		$words[$point = $point % 10] : '';

		if($point){
			return $currency_symbol . $result . $points . $currency_symbol2;
		}
		else {
			return $currency_symbol . $result;
		}
	}


}

/* End of file Number_to_Words.php */
/* Location: ./application/libraries/Number_to_Words.php */