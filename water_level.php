<?php


$nMax = 100000;
$levelMax = 100000000;

$array = getArray($nMax, $levelMax);
$waterMax = getMaxWaterLevel($array);

echo 'Max value: ' . $waterMax;
exit(0);

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
	$max = 0;
	$min = 0;
	$levels = [];
	$count = count($array);
	for ($i = 1; $i < $count; $i++) {
		if ($array[$i - 1] <= $array[$i]) {
			continue;
		}

		$max = $array[$i - 1];
		$min = $array[$i];

		while ($i < $count && $max > $array[$i]) {
			if ($min > $array[$i]) {
				$min = $array[$i];
			}
			$i++;
		}

		if ($i < $count) {
			$levels[] = $max - $min;
		}
	}
return ($levels) ? max($levels) : 0;
}

