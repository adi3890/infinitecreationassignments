<?php
ini_set('error_reporting', 'E_NOTICE' );


// This program will help company to select a room which is available at reuired time.

// Below mentioned array contains time availability of rooms data fetched from data base

$booked = Array('room1' => [[strtotime('09:30'), 2],[strtotime('12:00'), 1], [strtotime('17:00'),3]],
				'room2' => [[strtotime('07:30'), 2],[strtotime('11:00'), 1], [strtotime('14:00'),1]],
				'room3' => [[strtotime('10:00'), 1.5],[strtotime('12:00'), 1], [strtotime('14:30'),2.5]]
);

echo "Please enter stating time of meeting in fromat hh:mm 24-hours format eg. '15:45' : ";
$start = strtotime(fgets(STDIN));
echo "Please enter duration of meeting : ";
$duration = fgets(STDIN);

function choose_vacant_time($start, $duration, $booked){
	$available_rooms = Array();
	foreach ($booked as $room => $data) {
		$available = true;
		foreach ($data as $time) {
			if(unavailable($start, $duration, $time)){
				$available = false;
				break;
			}
		}
		if($available){
			$available_rooms[] = $room;
		}
	}
	if(sizeof($available_rooms) > 0){
		foreach ($available_rooms as $key => $room) {
			echo "Choose $key for $room \n";
		}
		$selected = (int) fgets(STDIN);
		$chosen = $available_rooms[$selected]??="Invalid room chosen";
		if($chosen == "Invalid room chosen"){
			echo $chosen;
		} else {
			echo "$chosen booked succesfully \n";
		}
	} else {
		echo "No room available for selected time !!";
	}
}

function unavailable($start, $duration, $time){
	$end = (int) $start + $duration*3600;
	$meeting_start = (int) $time[0];
	$meeting_end = (int) $meeting_start+  $time[1]*3600;
	if(($start > $meeting_start && $start < $meeting_end) || ($end > $meeting_start && $end < $meeting_end) || ($start <= $meeting_start && $end >= $meeting_end)){
		return true;
	} else {
		return false;
	}
}

choose_vacant_time($start, $duration, $booked);






