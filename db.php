<?php
/**
 * Created by PhpStorm.
 * User: mancr
 * Date: 3/2/2017
 * Time: 14:55
 */

const ERROR_MESSAGE = "Something went wrong.";
const ERROR_MESSAGE_INSERT = "Records were not created.";

function connect_to_db() {
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "websecurityex";

    // Create and return connection
    return new mysqli($servername, $username, $password, $db);
}

function db_insert_message($msg, $iv) {
    $conn = connect_to_db();

    // Check connection
    if (!$conn->connect_errno) {

        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO messages (id, msg, iv) VALUES (NULL , ?, ?)");
        $bind = $stmt->bind_param("ss", $msg, $iv);
        $res = $stmt->execute();

        if($stmt && $bind && $res){
            echo "<br>New message added successfully!";
        } else {
            echo "<br>".ERROR_MESSAGE . " " . ERROR_MESSAGE_INSERT;
        }

        $stmt->close();
        $conn->close();

    } else {
        echo ERROR_MESSAGE . " " . ERROR_MESSAGE_INSERT . " " .$conn->connect_errno . "<br>" . $conn->connect_error;
    }
}

function db_get_messages() {

}