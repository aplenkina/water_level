<?php


$nMax = 100000;
$levelMax = 100000000;

$array = getArray($nMax, $levelMax);
$waterMax = getMaxWaterLevel($array);

echo 'All leveles: ' . implode(', ', $array) . '; Max value: ' . $waterMax;

function getArray($nMax, $levelMax) {
	if (!$nMax || !$levelMax) {
		return [];
	}

	$n = rand(1, abs($nMax));
	for ($i = 0; $i <= $n; $i++) {
		$array[] = rand(1, abs($levelMax));
	}
	return $array;
}

function getMaxWaterLevel($array) {
	
	$count = count($array);
	$max = 0;
	$min = 0;
	$levels = [];
	$levelsTail = [];
	for ($i = 1; $i < $count; $i++) {
		if ($array[$i - 1] <= $array[$i]) {
			continue;
		}

		$max = $array[$i - 1];
		$min = $array[$i];
		$subArray = [];

		while ($i < $count && $max > $array[$i]) {
			if ($min >= $array[$i]) {
				$min = $array[$i];
			}
			$subArray[$i] = $array[$i];
			if (isset($array[$i + 1]) && $array[$i + 1] > $array[$i] && $array[$i + 1] < $max) {
				$levelsTail[] = $array[$i + 1] - min($subArray);
			} elseif (isset($array[$i + 1]) && $array[$i + 1] < $array[$i]) {
				$subArray = [];
			}
			$i++;
		}

		if ($i < $count) {
			$levels[] = $max - $min;
		}
	}
	$allMaxValues = array_merge($levels, $levelsTail);

	return ($allMaxValues) ? max($allMaxValues) : 0;
}
