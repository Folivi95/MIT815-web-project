<!-- delete user -->
<?php
include('security.php');

if(isset($_POST['delete_user']))
{
    $id = $_POST['id'];

    $id_query = "DELETE * FROM users WHERE id='$id' ";
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
include('security.php');

if(isset($_POST['createuserbtn']))
{
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $usertype = $_POST['usertype'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];

    $email_query = "SELECT * FROM register WHERE firstname='$firstname' ";
    $email_query2 = "SELECT * FROM register WHERE lastname='$lastname' ";
    $email_query_run = mysqli_query($connection, $email_query);
    $email_query_run2 = mysqli_query($connection, $email_query2);
    if((mysqli_num_rows($email_query_run) > 0) && (mysqli_num_rows($email_query_run2) > 0))
    {
        $_SESSION['createuserstatus'] = "User already exists.";
        $_SESSION['status_code'] = "error";
        header('Location: createuser.php');  
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
                header('Location: createuser.php');
            }
            else 
            {
                $_SESSION['createuserstatus'] = "Admin Profile Not Added";
                $_SESSION['createuserstatus_status_code'] = "error";
                header('Location: createuser.php');  
            }
        }
        else 
        {
            $_SESSION['createuserstatus'] = "Password and Confirm Password Does Not Match";
            $_SESSION['createuserstatus_status_code'] = "warning";
            header('Location: createuser.php');  
        }
    }

}
?>

<!-- create class -->
<?php
include('security.php');

if(isset($_POST['createclassbtn']))
{
    $name = $_POST['classname'];
    $venue = $_POST['venue'];
    $day = $_POST['dayoftheweek'];
    $starttime = $_POST['starttime'];
    $stoptime = $_POST['stoptime'];
    $noofparticipants = $_POST['noofparticipants'];

    $name_query = "SELECT * FROM register WHERE name='$name' ";
    $email_query_run = mysqli_query($connection, $name_query);

    if((mysqli_num_rows($name_query) > 0))
    {
        $_SESSION['createclassstatus'] = "Class already exists.";
        $_SESSION['status_code'] = "error";
        header('Location: createclass.php');  
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
                header('Location: createclass.php');
            }
            else 
            {
                $_SESSION['createclassstatus'] = "Class Not Added";
                $_SESSION['createclassstatus_status_code'] = "error";
                header('Location: createclass.php');  
            }
        }
        else 
        {
            $_SESSION['createclassstatus'] = "Start time should be earlier than Stop time.";
            $_SESSION['createclassstatus_status_code'] = "warning";
            header('Location: createclass.php');  
        }
    }

}
?>

<!-- update class -->
<?php
include('security.php');

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
        header('Location: updateclass.php'); 
    }
    else
    {
        $_SESSION['update_class_status'] = "Failed to update class";
        $_SESSION['update_class_status_code'] = "error";
        header('Location: updateclass.php'); 
    }
}
?>

<?php
include('security.php');

if(isset($_POST['updatebtn']))
{
    $id = $_POST['edit_id'];
    $username = $_POST['edit_username'];
    $email = $_POST['edit_email'];
    $password = $_POST['edit_password'];

    $query = "UPDATE register SET username='$username', email='$email', password='$password' WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Updated";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT Updated";
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }
}

?>

<?php
include('security.php');

if(isset($_POST['delete_btn']))
{
    $id = $_POST['delete_id'];

    $query = "DELETE FROM register WHERE id='$id' ";
    $query_run = mysqli_query($connection, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Your Data is Deleted";
        $_SESSION['status_code'] = "success";
        header('Location: register.php'); 
    }
    else
    {
        $_SESSION['status'] = "Your Data is NOT DELETED";       
        $_SESSION['status_code'] = "error";
        header('Location: register.php'); 
    }    
}
?>

<?php
include('security.php');

if(isset($_POST['login_btn']))
{
    $email_login = $_POST['emaill']; 
    $password_login = $_POST['passwordd']; 

    $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
    $query_run = mysqli_query($connection, $query);
    $usertypes = mysqli_fetch_array($query_run);

    if($usertypes['usertype'] == "admin")
    {
        $_SESSION['username'] = $email_login;
        header('Location: index.php');
    }
    else if($usertypes['usertype'] == "user")
    {
        $_SESSION['cusername'] = $email_login;
        header('Location: ../index.php');
    }
    else
    {
        $_SESSION['status'] = "Email / Password is Invalid";
        header('Location: login.php');
    }
}
?>

<?php
include('security.php');

if(isset($_POST['registerbtn']))
{
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['confirmpassword'];
    $usertype = $_POST['usertype'];
    
    $email_query = "SELECT * FROM register WHERE email='$email' ";
    $email_query_run = mysqli_query($connection, $email_query);
    if(mysqli_num_rows($email_query_run) > 0)
    {
        $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
        $_SESSION['status_code'] = "error";
        header('Location: register.php');  
    }
    else
    {
        if($password === $cpassword)
        {
            $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
            $query_run = mysqli_query($connection, $query);
            
            if($query_run)
            {
                // echo "Saved";
                $_SESSION['status'] = "Admin Profile Added";
                $_SESSION['status_code'] = "success";
                header('Location: register.php');
            }
            else 
            {
                $_SESSION['status'] = "Admin Profile Not Added";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
        }
        else 
        {
            $_SESSION['status'] = "Password and Confirm Password Does Not Match";
            $_SESSION['status_code'] = "warning";
            header('Location: register.php');  
        }
    }

}
?>