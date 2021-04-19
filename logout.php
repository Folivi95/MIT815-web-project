<form action="logout.php" method="POST"> 
      <button type="submit" name="logout_btn" class="btn btn-primary">Logout</button>
</form>

Step 2: Create a page with the name logout.php and paste the below code.
<?php
session_start();

if(isset($_POST['logout_btn']))
{
    session_destroy();
    unset($_SESSION['firstname']);
    unset($_SESSION['lastname']);
    unset($_SESSION['user_id']);
    unset($_SESSION['usertype']);
    header('Location: login.php');
}

?>