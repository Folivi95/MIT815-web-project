<?php
include('includes/security.php');
?>

<!-- redirect to login page if user is not logged in -->
<?php 
    if (!isset($_SESSION['user_id'])) {
      header('Location: login.php');
    }

    if (isset($_SESSION['usertype']) && ($_SESSION['usertype'] == "User")) {
      header('Location: viewclass.php');
    }
?>

<?php
include('includes/header.php'); 
include('includes/navbar.php'); 
?>


<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
        class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>

  <!-- Content Row -->
  <div class="row">

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Number of Classes</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">

               <h4>Total Classes: *</h4>

              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Number of Users</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">0</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Number of Filled Classes</div>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <!-- <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-comments fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div> -->
  </div>

  <!-- Content Row -->
  <?php 
    if (isset($_SESSION['createuserstatus']) && $_SESSION['createuserstatus'] != '') {
      $message = $_SESSION['createuserstatus'];
      echo "<script type='text/javascript'>toastr.success({$message})</script>";
    }
  ?>

  <div class="container-fluid">
    <form action="code.php" method="POST">
        <div class="modal-body">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="firstname" class="form-control col-md-5" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="lastname" class="form-control col-md-5" placeholder="Enter Last Name">
            </div>
            <div class="form-group">
                <label>User Type</label>
                <select name="usertype" id="usertype">
                  <option value="User">Normal User</option>
                  <option value="Administrator">System Administrator</option>
                </select>
            </div>
            <!-- <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control col-md-5 checking_email" placeholder="Enter Email">
                <small class="error_email" style="color: red;"></small>
            </div> -->
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control col-md-5" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirmpassword" class="form-control col-md-5" placeholder="Confirm Password">
            </div>

            <button type="submit" name="createuserbtn" class="btn btn-primary">Save</button>
        </div>
    </form>
  </div>


<!-- <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        
                            // $query = "SELECT id FROM register ORDER BY id";  
                            // $query_run = mysqli_query($connection, $query);
                            // $row = mysqli_num_rows($query_run);
                            // echo '<h4> Total Admin: '.$row.'</h4>';
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div> -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>