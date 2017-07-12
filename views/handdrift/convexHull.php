<?php

	function convexHull($points)
	{
		/* Ensure point doesn't rotate the incorrect direction as we process the hull halves */
		$cross = function($o, $a, $b) {
			return ($a[0] - $o[0]) * ($b[1] - $o[1]) - ($a[1] - $o[1]) * ($b[0] - $o[0]);
		};

 		$pointCount = count($points);
 		sort($points);
		if ($pointCount > 1) {

			$n = $pointCount;
			$k = 0;
			$h = array();
 
			/* Build lower portion of hull */
			for ($i = 0; $i < $n; ++$i) {
				while ($k >= 2 && $cross($h[$k - 2], $h[$k - 1], $points[$i]) <= 0)
					$k--;
				$h[$k++] = $points[$i];
			}
 
			/* Build upper portion of hull */
			for ($i = $n - 2, $t = $k + 1; $i >= 0; $i--) {
				while ($k >= $t && $cross($h[$k - 2], $h[$k - 1], $points[$i]) <= 0)
					$k--;
				$h[$k++] = $points[$i];
			}

			/* Remove all vertices after k as they are inside of the hull */
			if ($k > 1) {

				/* If you don't require a self closing polygon, change $k below to $k-1 */
				$h = array_splice($h, 0, $k); 
			}

			return $h;

		}
		else if ($pointCount <= 1)
		{
			return $points;
		}
		else
		{
			return null;
		}
	}

?>
