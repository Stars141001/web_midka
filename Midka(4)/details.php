<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">


	<!-- CSS only -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="assets/css/style.css">

<!-- CSS only -->

<!-- Font Awesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
<!-- Google Fonts Roboto -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
<!-- JS, Popper.js, and jQuery -->
<script src="https://use.fontawesome.com/142431c6ed.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="/vender/js/bootstrap.min.js"></script>
<!-- JS, Popper.js, and jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<meta charset="UTF-8">
	<title>Details</title>
</head>
<body>
    
    <?php
        $link = mysqli_connect("localhost", "root", "", "web_mid");
    
        if(isset($_COOKIE['company_id'])){

            $id_company = $_COOKIE['company_id'];
            $query_company = mysqli_query($link,"SELECT * FROM company WHERE id='".mysqli_real_escape_string($link,$id_company)."' LIMIT 1");
            $company = mysqli_fetch_assoc($query_company);
        }
    
        if(isset($_POST['logout'])){
            setcookie("company_id", $id_company, time()-3600*24*7, "/");
            header("Location:http://localhost/Midka/loginPage.php");
        }
    
        $id_job = $_GET['id'];
        $query_job = mysqli_query($link,"SELECT * FROM job WHERE id='$id_job'");
        $job = mysqli_fetch_assoc($query_job);
    ?>

		<div class="header frontpage" style="margin-top: 30px">
			<div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-#EFF3F8">
              <a class="navbar-brand" href="#">EMPLOYMENT.COM</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="Find%20Job.php">Find a job</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Help</a>
                  </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <strong>
                            <?php
                                if(!empty($company)){
                                    echo '<a class="lav-link dropdown-toggle" style="color: black" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$company['name'].'</a>';
                                    echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                              <form method="Post">
                                              <input type="hidden" name="logout" value="1">
                                              <button type="submit" class="dropdown-item">Logout</button>
                                              </form>';
                                    echo '</div>';
                                }else{
                                    header("Location:http://localhost/Midka/loginPage.php");
                                }
                            ?>
                        </strong>
                    </li>
                </ul>
              </div>
            </nav>
          </div>
        <br>
		<div class="container-fluid" style="background-color:#474747; ">
			<div class="container">
				
				<ul class="nav nav-pills lighten-2 mx-0 mb-0 mt-0 nav-fill">

				  <li class="nav-item">
				    <a class="nav-link py-4 " href="#">Students and graduates</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link py-4	" href="#">Industry Metoring Program</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link py-4" href="#">Employers and recuriters</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link py-4 " href="#">Unitempts</a>
				  </li>
				   <li class="nav-item">
				    <a class="nav-link py-4 " href="#">Academic staff</a>
				  </li>
				   <li class="nav-item">
				    <a class="nav-link py-4 " href="contact%20us.html">Contact us</a>
				  </li>

				</ul>
			</div>
		</div>
	</div>

<hr>
        <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLable" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditModalLable">Update Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <input type="hidden" name="update_id">
                                <label for="update_name">Name</label>
                                <input type="text" class="form-control" name="update_name" value="<?php echo $job['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="update_desc">Description</label>
                                <input type="text" class="form-control" name="update_desc" value="<?php echo $job['description'] ?>"> 
                            </div>
                            <div class="form-group">
                                <label for="update_address">Address</label>
                                <input type="text" class="form-control" name="update_address" value="<?php echo $job['address'] ?>"> 
                            </div>
                            <div class="form-group">
                                <label for="update_region">Region</label>
                                <select name="update_region" class="form-control">
                                    <option>Almaty</option>
                                    <option>Nursultan</option>
                                    <option>Shymkent</option>
                                </select>                            
                            </div>
                            <div class="form-group">
                                <label for="update_salary">Salary</label>
                                <input type="number" class="form-control" name="update_salary" value="<?php echo $job['salary'] ?>"> </div>
                            <div class="form-group">
                                <label for="update_schedule">Schedule</label>
                                <select name="update_schedule" class="form-control">
                                    <option>Full Day</option>
                                    <option>Shift Schedule</option>
                                    <option>Flexible schedule</option>
                                    <option>Remote work</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save job</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="container">
        <div class="row">
           <div class="col-5">
                <?php
                    echo  '<label>Name:</label>
                           <p><strong>'.$job['name'].'</strong></p>
                           <label>Description:</label>
                           <p><strong>'.$job['description'].'</strong></p>
                           <label>Address:</label>
                           <p><strong>'.$job['address'].'</strong></p>
                           <label>Region:</label>
                           <p><strong>'.$job['region'].'</strong></p>
                           <label>Salary:</label>
                           <p><strong>'.$job['salary'].'</strong></p>
                           <label>Schedule:</label>
                           <p><strong>'.$job['schedule'].'</strong></p>
                           <button class="btn btn-info" data-toggle="modal" data-target="#EditModal" type="button">Edit</button>
                           <br>
                           <br>';
                ?>
            </div>
            <div class="col-4 form-group">
               <h3>Workers</h3>
                <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                  <?php
                    do{
                    echo "<tr>
                        <td>".$user['name']."</td>
                        <td><a class='btn btn-info btn-sm' type='button' href='details.php?id=".$job['id']."'>Details</a></td>
                        </tr>";   
                    }
                    while($job = mysqli_fetch_assoc($query_job))
                    ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
<footer class="page-footer font-small mdb-color pt-4" style="background-color: #474747;">
  <div class="container text-center text-md-left">
    <div class="row text-center text-md-left mt-3 pb-3">
      <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Emloyment of Students</h6>
        <p style="color: white;">Info about Service 
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
      </div>
      <hr class="w-100 clearfix d-md-none">
      <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Services</h6>
        <p>
        <a href="Find%20Job.php" style="text-decoration: none">Find Job</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Find Worker</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Employment Service</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Analytics</a>
        </p>
      </div>
      <hr class="w-100 clearfix d-md-none">
      <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Useful links</h6>
        <p>
         <?php
                if(isset($_COOKIE['company_id'])){
                    echo '<a href="profile.php" style="text-decoration: none">Profile</a>';
                }
                else{
                    echo '<a href="loginPage.php" style="text-decoration: none">Your Account</a>';
                }
            ?>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Private agency population</a>
        </p>
        <p>
          <a href="contact%20us.html" style="text-decoration: none">About US</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Help</a>
        </p>
      </div>
      <hr class="w-100 clearfix d-md-none">

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Contact</h6>
        <p style="color: white;">
          <span class="fas fa-home mr-3" style="margin-left: 0"></span>Manasa 131</p>
        <p style="color: white;">
          <span class="fas fa-envelope mr-3" style="margin-left: 0"></span>info@gmail.com</p>
        <p style="color: white;">
          <span class="fas fa-phone mr-3" style="margin-left: 0"></span>+77777777777</p>
        <p style="color: white;">
          <span class="fas fa-print mr-3" style="margin-left: 0"></span>+77088888888</p>
      </div>
    </div>
    <hr>
    <div class="row d-flex align-items-center">
      <div class="col-md-7 col-lg-8">
        <p class="text-center text-md-left" style="color: white;">©️ 2020 Copyright:
          <a href="#">
            <strong> Employment.com</strong>
          </a>
        </p>
      </div>
    </div>
  </div>
</footer>

</body>
</html>