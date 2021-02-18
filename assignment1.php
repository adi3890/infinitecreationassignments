<?php
ini_set('error_reporting', 'E_NOTICE' );

echo "Please enter number of packages: ";
$package = fgets(STDIN);
echo "Please enter number of large containers available: ";
$large = fgets(STDIN);
echo "Please enter number of small containers available: ";
$small = fgets(STDIN);

if($package > ($large*5 + $small)){
	echo "Sorry, We do not carry sufficient number of containers to carry required packages \n";
} elseif ($package == ($large*5 + $small)){
	echo "Number of packages required \n Large: $large Small: $small \n";
} else {
	$large_required =  (int) ($package / 5);
	if($large_required <= $large){
		$small_required = fmod($package, 5);
	} else {
		$large_required = $large;
		$small_required = $package - $large*5;
	}
	if($small_required > $small){
		$small_required = 0;
		$large_required++;
	}
	
	echo "Number of packages required \n Large: $large_required Small: $small_required \n";
}
