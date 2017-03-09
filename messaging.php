<?php
/**
 * Created by PhpStorm.
 * User: mancr
 * Date: 3/2/2017
 * Time: 15:08
 */
include "db.php";
include "crypt.php";

// Encrypt message
$iv = generate_iv();
$encrypted_msg = encrypt("WTF?", $iv);

db_insert_message($encrypted_msg, $iv);



//echo $encrypted_msg;
//echo decrypt($encrypted_msg, $iv);