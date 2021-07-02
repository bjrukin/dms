<?php
#===========================================================================
#= Script : phpCode128
#= File   : example.php
#= Version: 0.1
#= Author : Mike Leigh
#= Email  : mike@mikeleigh.com
#= Website: http://www.mikeleigh.com/scripts/phpcode128/
#= Support: http://www.mikeleigh.com/forum
#===========================================================================
#= Copyright (c) 2006 Mike Leigh
#= You are free to use and modify this script as long as this header
#= section stays intact
#=
#= This file is part of phpCode128.
#=
#= phpFile is free software; you can redistribute it and/or modify
#= it under the terms of the GNU General Public License as published by
#= the Free Software Foundation; either version 2 of the License, or
#= (at your option) any later version.
#=
#= phpFile is distributed in the hope that it will be useful,
#= but WITHOUT ANY WARRANTY; without even the implied warranty of
#= MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#= GNU General Public License for more details.
#=
#= You should have received a copy of the GNU General Public License
#= along with DownloadCounter; if not, write to the Free Software
#= Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
#===========================================================================
include('code128.class.php');

echo "<h2>Examples of using the code 128 php class</h2>";
echo "<p>All the examples here will use the string mikeleigh.com and the examples will showcase the different styles of barcode that can be produced witht he options</p>";

$barcode = new phpCode128('k4564620170306', 100, 'c:\windows\fonts\verdana.ttf', 18);
	$barcode->setAutoAdjustFontSize(true);
	$barcode->setBorderWidth(1);
	$barcode->setShowText(true);
	$barcode->setPixelWidth(1);
	$barcode->setTextSpacing(5);
$barcode->saveBarcode('1.png');
echo "<h3>Using the default class</h3>";
echo "<p>Font is set to verdanna with size 18 and the image size to 150.  The following defautls are used.  These are the same as the class defaults</p>";
echo '<pre>
	$barcode->setBorderSpacing(10);
	$barcode->setEanStyle(true);
</pre>';
echo "<img src='1.png'>";
echo "<hr />";



?>