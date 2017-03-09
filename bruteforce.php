<?php
/**
 * Created by PhpStorm.
 * User: mancr
 * Date: 3/9/2017
 * Time: 14:22
 */

// Constants
const CHARACTERS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
const PAS_LENGTH = 4;
$len = strlen(CHARACTERS);

// Given hash
$hash = hash("SHA1", "pass");

echo "<pre>";
echo "Hash = " . $hash . "\n";


// BRUTEFORCE

//for ($i = 0; $i < $len; $i++) {
//    for ($j = 0; $j < $len; $j++) {
//        for ($k = 0; $k < $len; $k++) {
//
//            $word = "" . CHARACTERS[$i] . CHARACTERS[$j] . CHARACTERS[$k];
//            if (hash("SHA1", $word) == $hash) {
//                echo "Pass = " . $word . "\n";
//            }
//        }
//    }
//}

$solution = bruteforce("", 0);
if($solution) {
    echo "Solution was found";
} else {
    echo "Solution was not found!";
}


function bruteforce($pas, $pasIndex) {
    global $len, $hash;
    if (hash("SHA1", $pas) == $hash) {
        echo "Pass = " . $pas . "\n";
        return true;
    } else if($pasIndex < PAS_LENGTH) {

        $found = false;
        for ($i = 0; $i < $len && !$found; $i++) {
            $found = bruteforce($pas . CHARACTERS[$i], $pasIndex + 1);
        }
        return $found;
    } else {
        return false;
    }
}




echo "</pre>";