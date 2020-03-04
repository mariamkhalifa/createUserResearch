<?php

// usage: $newpassword = generatePassword(12); // for a 12-char password, upper/lower/numbers.
// functions that use rand() or mt_rand() are not secure according to the PHP manual.

function getRandomBytes($nbBytes = 32){
    $bytes = openssl_random_pseudo_bytes($nbBytes, $strong);
    if (false !== $bytes && true === $strong) {
        return $bytes;
    }
    else {
        throw new \Exception("Unable to generate secure token from OpenSSL.");
    }
}

function generatePassword($length){
    return substr(preg_replace("/[^a-zA-Z0-9]/", "", base64_encode(getRandomBytes($length+1))),0,$length);
}

function createUser($fname, $username, $password, $email) {
    $pdo = Database::getInstance()->getConnection();
    $new_password = generatePassword(8);
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    var_dump($hashed_password);
    var_dump($new_password);

    //To Do: build the proper SQL query with the information above
    // execute it to create a user in tbl_user
    $create_user_query = "INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email)
    VALUES (:fname, :username, :password, :email)";

    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set ->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$hashed_password,
            ':email'=>$email
        )
    ); 

    // To Do: based on the execution result, if everything goes through
    // redirect to the index.php
    // otherwise, return an error message

    if($create_user_result) {
        redirect_to('index.php');
    }else{
        return 'This individul sucks! But they are trying their best :)';
    }
}