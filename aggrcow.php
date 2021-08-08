<?php
/**
 * Solution for AGGRCOW problem (https://www.spoj.com/problems/AGGRCOW/)
 * Andrejs Petrovs
 */

// To easier run tests locally
if(isset($_SERVER['argv'][1]) and $_SERVER['argv'][1] == "test"){
    runTests();
    exit("Tests complete\n");
}

// Get output from console; calculate; output to console.
$first_input = readline();
$cases = intval($first_input);
for($i=0; $i < $cases; $i++){
	list($stalls, $cows) = explode(" ", readline());
	$stalls = intval($stalls);	// Stalls count
	$cows = intval($cows);	// Covs count

	$positions = array();
	for($j=0; $j < $stalls; $j++){
		$positions[] = intval(readline());
	}

    $min_distance = largestMinimumDistance($positions, $stalls, $cows);
    echo($min_distance."\n");
}


# FUNCTIONS

// Find largest minimum distance
// when assigning $c points on $n positions.


/**
 * Returns largest minimum distance.
 * Based on binary search algorithm.
 *
 * @param   array $positions List of positions
 * @param   int $n Number of stalls
 * @param   int $c Number of cows
 * @return  int Largest minimum distance. -1 if no solution.
*/
function largestMinimumDistance($positions, $n, $c){
    // Positions need to be sorted before used in binary search.
    sort($positions);

    // Initialize result. Will output -1 if no solution.
    $result = -1;

    // Start from the maximum possible distance
    $left = 1;
    $right = $positions[$n - 1] - $positions[0];

    // Do binary search
    while($left < $right){
        $minimum_distance = ($left + $right) / 2;

        // If it is possible to place $c elements within $minimum_distance,
        // search for higher distance.
        if (isPossible($minimum_distance, $positions, $n, $c)){
            $result = max($result, $minimum_distance);
            $left = $minimum_distance + 1;
        }
        // If not possible to place elements,
        // search for lower distance
        else{
            $right = $minimum_distance;
        }
    }

    // Round result to higher nearest integer
    return ceil($result);
}

/**
 * Helper function
 * Is it possible to arrange elements on given $minimum_distance?
 *
 * @param   int $minimum_distance Number of stalls
 * @param   array $positions List of positions
 * @param   int $n Number of stalls
 * @param   int $c Number of cows
 * @return  int Largest minimum distance
*/
function isPossible($minimum_distance, $positions, $n, $c){
    // Place first element at first position
    $pos = $positions[0];

    // Count elements placed.
    $elements = 1;

    // Try placing $c elements on $positions
    // with minimum distance $minimum_distance.
    for($i = 1; $i < $n; $i++){
        if($positions[$i] - $pos >= $minimum_distance){
            // Place next element if distance from previously placed
            // element is greater than $minimum_distance
            $pos = $positions[$i];
            $elements++;

            // Return TRUE if all elements are placed successfully
            if($elements == $c){
                return TRUE;
            }
        }
    }
    return FALSE;
}

# TESTS

function runTests(){
    $positions = array(1, 5, 10, 13);
    $stalls = 4;
    $cows = 3;
    $min_distance = (largestMinimumDistance($positions, $stalls, $cows));
    // Assert correct ansver
    if($min_distance == 4){
        echo("Test 0 OK\n");
    }
    else{
        echo("Test 0 failed. Result {$min_distance} is wrong\n");
    }

    $positions = array(1, 2, 8, 4, 9);
    $stalls = 5;
    $cows = 3;
    $min_distance = (largestMinimumDistance($positions, $stalls, $cows));
    // Assert correct ansver
    if($min_distance == 3){
        echo("Test 1 OK\n");
    }
    else{
        echo("Test 1 failed. Result {$min_distance} is wrong\n");
    }

    $positions = array(11, 12, 18, 14, 19);
    $stalls = 5;
    $cows = 3;
    $min_distance = (largestMinimumDistance($positions, $stalls, $cows));
    // Assert correct ansver
    if($min_distance == 3){
        echo("Test 2 OK\n");
    }
    else{
        echo("Test 2 failed. Result {$min_distance} is wrong\n");
    }

    $positions = array(111, 112, 118, 114, 119);
    $stalls = 5;
    $cows = 3;
    $min_distance = (largestMinimumDistance($positions, $stalls, $cows));
    // Assert correct ansver
    if($min_distance == 3){
        echo("Test 3 OK\n");
    }
    else{
        echo("Test 3 failed. Result {$min_distance} is wrong\n");
    }

    $positions = array(1, 2, 8, 4, 9, 10, 13);
    $stalls = 7;
    $cows = 3;
    $min_distance = (largestMinimumDistance($positions, $stalls, $cows));
    // Assert correct ansver
    if($min_distance == 5){
        echo("Test 4 OK\n");
    }
    else{
        echo("Test 4 failed. Result {$min_distance} is wrong\n");
    }

    $positions = array(1, 6, 10, 20, 24, 28);
    $stalls = 6;
    $cows = 3;
    $min_distance = (largestMinimumDistance($positions, $stalls, $cows));
    // Assert correct ansver
    if($min_distance == 9){
        echo("Test 5 OK\n");
    }
    else{
        echo("Test 5 failed. Result {$min_distance} is wrong\n");
    }

    $positions = array(0, 1, 7, 3, 8);
    $stalls = 5;
    $cows = 3;
    $min_distance = (largestMinimumDistance($positions, $stalls, $cows));
    // Assert correct ansver
    if($min_distance == 3){
        echo("Test 6 OK\n");
    }
    else{
        echo("Test 6 failed. Result {$min_distance} is wrong\n");
    }
}

?>
