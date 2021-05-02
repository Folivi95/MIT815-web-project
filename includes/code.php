
<?php
include('security.php');

?>

<!-- delete user -->
<?php

if(isset($_POST['delete_user']))
{
    $id = $_POST['id'];

    $id_query = "DELETE * FROM users WHERE id='$id'";
    $query_run = mysqli_query($connection, $id_query);
    if($query_run)
    {
        $_SESSION['delete_user_status'] = "User is Deleted";
        $_SESSION['delete_user_status_code'] = "success";
        header('Location: edituser.php'); 
    }
    else
    {
        $_SESSION['delete_user_status'] = "User is NOT DELETED";       
        $_SESSION['delete_user_status_code'] = "error";
        header('Location: edituser.php'); 
    }  
}
?>

<!-- create user -->
<?php

if(isset($_POST['createuserbtn']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $usertype = $_POST['usertype'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $user_query = "SELECT * FROM users WHERE firstname='$firstname' ";
    $user_query2 = "SELECT * FROM users WHERE lastname='$lastname' ";
    $user_query_run = mysqli_query($connection, $user_query);
    $user_query_run2 = mysqli_query($connection, $user_query2);
    if((mysqli_num_rows($user_query_run) > 0) && (mysqli_num_rows($user_query_run2) > 0))
    {
        $_SESSION['createuserstatus'] = "User already exists.";
        $_SESSION['status_code'] = "error";
        header('Location: /admin/createuser.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO users (firstname,lastname,usertype,password) VALUES ('$firstname', '$lastname','$usertype','$hash')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['createuserstatus'] = "User Created";
                $_SESSION['createuserstatus_status_code'] = "success";
                header('Location: /admin/createuser.php');
            }
            else 
            {
                $_SESSION['createuserstatus'] = "Admin Profile Not Added";
                $_SESSION['createuserstatus_status_code'] = "error";
                header('Location: /admin/createuser.php');  
            }
        }
        else 
        {
            $_SESSION['createuserstatus'] = "Password and Confirm Password Does Not Match";
            $_SESSION['createuserstatus_status_code'] = "warning";
            header('Location: /admin/createuser.php');  
        }
    }

}
?>

<!-- create class -->
<?php

if(isset($_POST['createclassbtn']))
{
    $name = $_POST['classname'];
    $venue = $_POST['venue'];
    $day = $_POST['dayoftheweek'];
    $starttime = $_POST['starttime'];
    $stoptime = $_POST['stoptime'];
    $noofparticipants = $_POST['noofparticipants'];

    $name_query = "SELECT * FROM classes WHERE name='$name' ";
    $email_query_run = mysqli_query($connection, $name_query);

    if((mysqli_num_rows($name_query) > 0))
    {
        $_SESSION['createclassstatus'] = "Class already exists.";
        $_SESSION['status_code'] = "error";
        header('Location: /admin/createclass.php');  
    }
    else
    {
        if($starttime <= $stoptime)
        {
            $query = "INSERT INTO classes (name,venue,day,starttime,stoptime,noofparticipants) VALUES ('$name', '$venue','$day','$starttime','$stoptime','$noofparticipants')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['createclassstatus'] = "User Created";
                $_SESSION['createclassstatus_status_code'] = "success";
                header('Location: /admin/createclass.php');
            }
            else 
            {
                $_SESSION['createclassstatus'] = "Class Not Added";
                $_SESSION['createclassstatus_status_code'] = "error";
                header('Location: /admin/createclass.php');  
            }
        }
        else 
        {
            $_SESSION['createclassstatus'] = "Start time should be earlier than Stop time.";
            $_SESSION['createclassstatus_status_code'] = "warning";
            header('Location: /admin/createclass.php');  
        }
    }

}
?>

<!-- update class -->
<?php

if(isset($_POST['update_class']))
{
    $id = $_POST['update_id'];
    $classname = $_POST['classname'];
    $venue = $_POST['venue'];
    $day = $_POST['day'];
    $starttime = $_POST['starttime'];
    $stoptime = $_POST['stoptime'];
    $noofparticipants = $_POST['noofparticipants'];

    $query = "UPDATE classes SET name='$classname', venue='$venue', day='$day', starttime='$starttime', stoptime='$stoptime', noofparticipants='$noofparticipants' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['update_class_status'] = "Class updated successfully";
        $_SESSION['update_class_status_code'] = "success";
        header('Location: /admin/updateclass.php'); 
    }
    else
    {
        $_SESSION['update_class_status'] = "Failed to update class";
        $_SESSION['update_class_status_code'] = "error";
        header('Location: /admin/updateclass.php'); 
    }
}
?>

<!-- delete class -->
<?php

if(isset($_POST['delete_class']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE from classes WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['delete_class_status'] = "Class deleted successfully";
        $_SESSION['delete_class_status_code'] = "success";
        header('Location: /admin/updateclass.php'); 
    }
    else
    {
        $_SESSION['delete_class_status'] = "Failed to delete class";
        $_SESSION['delete_class_status_code'] = "error";
        header('Location: /admin/updateclass.php'); 
    }
}
?>

<!-- Login method -->
<?php

if(isset($_POST['login_btn']))
{
    echo('I came here');
    $firstname = $_POST['firstname']; 
    $lastname = $_POST['lastname']; 
    $usertype = $_POST['usertype']; 
    $password_login = $_POST['password']; 

    $query = "SELECT * FROM users WHERE firstname='$firstname' AND lastname='$lastname' LIMIT 1";
    $query_run = mysqli_query($connection, $query);
    $usertypes = mysqli_fetch_array($query_run);

    // check if password matches
    $password_hash = $usertypes['password'];
    $verify_password = password_verify($password_login, $password_hash);
    $verify = $password_login === $usertypes['password'];

    if ($verify_password || $verify) {
        # code...
        if($usertypes['usertype'] == "Administrator")
        {
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['user_id'] = $usertypes['id'];
            $_SESSION['usertype'] = $usertypes['usertype'];
            header('Location: /admin/index.php');
        }
        else if($usertypes['usertype'] == "User")
        {
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['user_id'] = $usertypes['id'];
            $_SESSION['usertype'] = $usertypes['usertype'];
            header('Location: /admin/index.php');
        }
        else
        {
            $_SESSION['login_status'] = "Firstname / Lastname / Password is Invalid";
            header('Location: /admin/login.php');
        }
    }
    else {
        # code...
        $_SESSION['login_status'] = "Incorrect Password";
        header('Location: /admin/login.php');
    }
    
}
?>

<!-- enroll class -->
<?php

if(isset($_POST['enroll_class']))
{
    $class_id = $_POST['class_id'];
    $user_id = $_SESSION['user_id'];

    $enroll_query = "INSERT INTO usersclass (classesid,usersid) VALUES ('$class_id', '$user_id')";
    $query_run = mysqli_query($connection, $enroll_query);

    if($query_run)
    {
        $_SESSION['view_class_status'] = "Enrolled for class successfully";
        $_SESSION['view_class_status_code'] = "success";
        header('Location: /admin/viewclass.php'); 
    }
    else
    {
        $_SESSION['view_class_status'] = "Failed to enroll for class";
        $_SESSION['view_class_status_code'] = "error";
        header('Location: /admin/viewclass.php'); 
    }
}
?>