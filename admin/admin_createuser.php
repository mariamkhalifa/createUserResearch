<?php
    require_once '../load.php';
    confirm_logged_in();

    if(isset($_POST['submit'])){
        $fname = trim($_POST['fname']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);

        if(empty($fname) || empty($username) || empty($email)) {
            $message = 'Please fill required fields!';
        }else{
            //All data pre processed and ready to go
            $message = createUser($fname, $username, $email); 
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
    <h2>Create User</h2>
    <?php echo !empty($message)? $message:''; ?>
    <form action="admin_createuser.php" method="post">
        <label>First Name:</label>
        <input type="text" name="fname" value=""><br>
        <label>Username:</label>
        <input type="text" name="username" value=""><br>
        <label>Email:</label>
        <input type="email" name="email" value=""><br>
        <button type="submit" name="submit">Create User</button>
    </form>
</body>
</html>