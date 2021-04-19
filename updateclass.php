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
    if (isset($_SESSION['update_class_status']) && $_SESSION['update_class_status'] != '') {
      $message = $_SESSION['update_class_status'];
      echo "<script type='text/javascript'>toastr.success({$message})</script>";
    }
  ?>

  <div class="container-fluid">
  <?php 
    if (isset($_SESSION['update_btn'])) {
        $id = $_POST['update_id'];
                
        $query = "SELECT * FROM classes WHERE id='$id' ";
        $query_run = mysqli_query($connection, $query);
        foreach($query_run as $row)
        {
  ?>
    <form action="code.php" method="POST">
        <input type="hidden" name="update_id" value="<?php echo $row['id'] ?>">
        <div class="modal-body">
            <div class="form-group">
                <label>Class Name</label>
                <input type="text" name="classname" value="<?php echo $row['name'] ?>"  class="form-control col-md-5" placeholder="Enter Class Name">
            </div>
            <div class="form-group">
                <label>Venue</label>
                <input type="text" name="venue" value="<?php echo $row['venue'] ?>"  class="form-control col-md-5" placeholder="Enter Venue">
            </div>
            <div class="form-group">
                <label>Period (Day of the week)</label>
                <select name="day" id="day">
                  <option value="<?php echo $row['day'] ?>" selected="selected"><?php echo $row['day'] ?></option>
                  <option value="Monday">Monday</option>
                  <option value="Tuesday">Tuesday</option>
                  <option value="Wednesday">Wednesday</option>
                  <option value="Thursday">Thursday</option>
                  <option value="Friday">Friday</option>
                  <option value="Saturday">Saturday</option>
                  <option value="Sunday">Sunday</option>
                </select>
            </div>
            <div class="form-group">
                <label>Start Time</label>
                <input type="time" name="starttime" value="<?php echo $row['starttime'] ?>"  class="form-control col-md-5" placeholder="Enter Start Time">
            </div>
            <div class="form-group">
                <label>Stop Time</label>
                <input type="time" name="stoptime" value="<?php echo $row['stoptime'] ?>"  class="form-control col-md-5" placeholder="Enter Stop Time">
            </div>
            <div class="form-group">
                <label>Max. No of Participants</label>
                <input type="number" name="noofparticipants" value="<?php echo $row['noofparticipants'] ?>"  class="form-control col-md-5" placeholder="Enter Period">
            </div>

            <button type="submit" name="update_class" class="btn btn-primary">Update</button>
        </div>
    </form>
    <?php
        }
    }
    ?>
  </div>


<!-- <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Registered Admin</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">

                
                            $query = "SELECT id FROM register ORDER BY id";  
                            $query_run = mysqli_query($connection, $query);
                            $row = mysqli_num_rows($query_run);
                            echo '<h4> Total Admin: '.$row.'</h4>';

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
