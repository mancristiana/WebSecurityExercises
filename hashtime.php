<?php
/**
 * Created by PhpStorm.
 * User: mancr
 * Date: 3/7/2017
 * Time: 19:47
 */

const CHARACTERS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";

const ARRAY_LENGTH = 50000;
const WORD_LENGTH = 20;

$array = array();
$time = microtime(true);

/**
 * Count delta microtime between the calls of this function
 * @param $echo boolean controlling whether the time should be echoed or not
 * @param $text text to be echoed
 */
function timeEcho($echo, $text) {
    global $time;
    $deltaTime = microtime(true) - $time;
    $time = microtime(true);
    if ($echo) {
        echo str_replace("%", "&ensp;", str_pad($text, 20, "%")) . round($deltaTime, 10) . '<br>';
    }
}

/**
 * @param $wordLen
 * @return string
 */
function generateRandomWord($wordLen) {
    $charactersLength = strlen(CHARACTERS);
    $randomWord = "";
    for ($i = 0; $i < $wordLen; $i++) {
        $random = rand(0, $charactersLength - 1);
        $randomWord .= CHARACTERS[$random];
    }

    return $randomWord;
}

function testHash($alg) {
    global $array;

    timeEcho(false, "");
    for ($i = 0; $i < ARRAY_LENGTH; $i++) {
        hash($alg, $array[$i]);
    }
    timeEcho(true, $alg);
}

function testBcrypt() {
    global $array;

    timeEcho(false, "");
    for ($i = 0; $i < 100; $i++) {
        password_hash($array[$i], PASSWORD_DEFAULT);
    }
    timeEcho(true, "Bcrypt 100");
}

for ($i = 0; $i < ARRAY_LENGTH; $i++) {
    $array[$i] = generateRandomWord(WORD_LENGTH);
}

echo "<pre>";

testHash("MD5");
testHash("SHA1");
testHash("SHA256");
testHash("SHA512");
testHash("RIPEMD160");
testHash("RIPEMD320");

testBcrypt();

echo "</pre>";



