<?php
//获取当前是星期几
function getWeek($date) {
	$week = date('w',$date);
	if ($week == 0) {
		$week = 7;
	}
	return $week;
}

//根据配送时间获取下单时间的星期数
function getOrderWeek($week) {
	// $week = date('w');
	// if ($week == 0) {
	// 	$week = 7;
	// }
	if ($week == 1) {
		$ordweek = 6;
	} elseif ($week == 2) {
		$ordweek = 7;
	} else {
		$ordweek = $week - 2;
	}
	return $ordweek;
}

//根据下单时间获取配送时间的星期数
function getDeliveryWeek($week) {
	$deliveryweek = $week + 2;
	if ($deliveryweek == 8) {
		$deliveryweek = 1;
	} elseif ($deliveryweek == 9) {
		$deliveryweek = 2;
	}
	return $deliveryweek;
}