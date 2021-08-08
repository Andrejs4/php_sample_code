<?php
$cases = intval(readline());

for($i=0; $i < $cases; $i++){
    $plate_number = intval(readline()); // N
    $word_0 = array();   // First letter
    $word_n = array();   // Last letter

    for($j=0; $j < $plate_number; $j++){
        $word = readline();
        $word_0[] = $word[0];
        $word_n[] = $word[strlen($word)-1];
    }

    $word_id = array_keys($word_0);

    // -----------------------------------------------------------------------

    // At least can exclude wrong answers right away...
    // Count all start and end letters
    $starts = array();
    $stops = array();
    for($j=0; $j < $plate_number; $j++){
        if(isset($starts[$word_0[$j]])){
            $starts[$word_0[$j]] = $starts[$word_0[$j]] + 1;
        }
        else{
            $starts[$word_0[$j]] = 1;
        }

        if(isset($stops[$word_n[$j]])){
            $stops[$word_n[$j]] = $stops[$word_n[$j]] + 1;
        }
        else{
            $stops[$word_n[$j]] = 1;
        }
    }

    // Count how many ends don't have starts for them
    $off_count = 0;
    foreach($starts as $key=>$val){
        if(isset($stops[$key])){
            $off_count+= abs($stops[$key] - $val);
        }
        else{
            $off_count+= $val;
        }
    }

    // And remaining stops
    $stops_with_no_starts = array_diff_key($stops, $starts);
    foreach($stops_with_no_starts as $key=>$val){
        $off_count+= $val;
    }

    $ordering_possible = TRUE;
    if($off_count > 2){
        $ordering_possible = FALSE;
    }

    // -----------------------------------------------------------------------



    // Ok, lets check if ordering is really possible by using real algorithm
    if($ordering_possible){
        $ordered_id = array();
        $chain_id = 0;
        $chain_letter = $word_n[0]; // Last letter

        for()

        unset($word_id[0]);


    }

    // -----------------------------------------------------------------------

    if($ordering_possible){
        echo("Ordering is possible.");
    }
    else{
        echo("The door cannot be opened.");
    }
}
?>
