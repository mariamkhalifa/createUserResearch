<?php

function createUser($fname, $username, $password, $email) {
    $pdo = Database::getInstance()->getConnection();

    //To Do: build the proper SQL query with the information above
    // execute it to create a user in tbl_user
    $create_user_query = "INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email)
    VALUES (:fname, :username, :password, :email)";

    $create_user_set = $pdo->prepare($create_user_query);
    $create_user_result = $create_user_set ->execute(
        array(
            ':fname'=>$fname,
            ':username'=>$username,
            ':password'=>$password,
            ':email'=>$email
        )
    ); 

    // To Do: based on the execution result, if everything goes through
    // redirect to the index.php
    // otherwise, return an error message

    if($create_user_result) {
        //redirect_to('index.php');
        $from = "mariam.khalifa.gabr@gmail.com";
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers = "Content-type: text/html\r\n";
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$fname. '<'.$email.'>' . "\r\n".
            'X-Mailer: PHP/' . phpversion();
        $recipient = $email;
        $subject = "Hello, Your Account Info.";
        $msg = '<html><body>';
        $msg .= '<h1>Hello <?php echo $fname; ?></h1>';
        $msg .= '<p>The website admin has created an account for you.</p>';
        $msg .= '<p>Your username is: <?php echo $username; ?></p>';
        $msg .= '<p>Your password is: <?php echo $password; ?></p>';
        $msg .= '<p>This is the url where you can login: http://localhost/movies_cms/admin/admin_login.php</p>';
        $msg .= '</body></html>';
        mail($recipient, $subject, $msg, $headers);
    }else{
        return 'This individul sucks!';
    }

    
}
