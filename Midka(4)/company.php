<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- CSS only -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- JS, Popper.js, and jQuery -->
    <script src="https://use.fontawesome.com/142431c6ed.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="/vender/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <title>Profile</title>
</head>
<body>
<?php

    $link = mysqli_connect("localhost", "root", "", "web_mid");
    
    if(isset($_COOKIE['company_id'])){

        $id = $_COOKIE['company_id'];
        $query = mysqli_query($link,"SELECT * FROM company WHERE id='".mysqli_real_escape_string($link,$id)."' LIMIT 1");
        $query_job = mysqli_query($link,"SELECT * FROM job WHERE company_id='".mysqli_real_escape_string($link,$id)."'");
        $company = mysqli_fetch_assoc($query);
        $job = mysqli_fetch_assoc($query_job);

        $query_country = mysqli_query($link,"SELECT * FROM country");
        $country = mysqli_fetch_assoc($query_country);

    }
    
    if(isset($_POST['v_name'])){

          $name = $_POST['v_name'];
          $address = $_POST['address'];
          $salary = $_POST['salary'];
          $schedule = $_POST['schedule'];
          $desc = $_POST['v_desc'];
          $region = $_POST['region'];

    }

    if(isset($_POST['v_name'])){
        $query = mysqli_query($link, "SELECT description FROM job WHERE description='".mysqli_real_escape_string($link, $_POST['desc'])."'");
            if(mysqli_num_rows($query) > 0)
            {
                $err[] = "Уже существует в базе данных";
            }
            else
            {
              if(!empty($_POST["v_name"]) && !empty($_POST["address"]) && !empty($_POST["salary"]) && !empty($_POST["schedule"]) && !empty($_POST["desc"]) && !empty($_POST["region"])){

                $query = mysqli_query($link,"INSERT INTO job (name, description, address, region, salary, schedule, added_date, company_id) VALUES ('$name', '$desc','$address','$region','$salary','$schedule', NOW(), '$id')");

            }
        }
    } 
    
    if(isset($_POST['name']) && isset($_COOKIE['company_id'])){

        $id = $_COOKIE['company_id'];
        $name = $_POST['name'];
        $type = $_POST['type'];
        $site = $_POST['site'];
        $address = $_POST['address'];
        $desc = $_POST['desc'];
        $email = $_POST['email'];
        $upd_country = $_POST['country'];
        $contact = $_POST['contact'];

        $query ="UPDATE company SET type='$type', name='$name', email='$email', country='$upd_country', contact='$contact', site='$site', address='$address', description='$desc' WHERE id='$id'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }
    
    if(isset($_POST['logout'])){
        setcookie("company_id", $id, time()-3600*24*7, "/");
        header("Location:http://localhost/Midka/loginPage.php");
    }
    
?>
        <div class="header frontpage" style="margin-top: 30px">
            <div class="container">

            <nav class="navbar navbar-expand-lg navbar-light bg-#EFF3F8">
              <a class="navbar-brand" href="index.html">EMPLOYMENT.COM</a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                    <a class="nav-link" href="index.html">Home</a>
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
                    <a class="nav-link py-4" href="#">Students and graduates</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link py-4" href="#">Industry Metoring Program</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link py-4" href="#">Employers and recuriters</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link py-4" href="#">Unitempts</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link py-4" href="#">Academic staff</a>
                  </li>
                   <li class="nav-item">
                    <a class="nav-link py-4" href="contact%20us.html">Contact us</a>
                  </li>

                </ul>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
      <div class="row">
           <div class="col-5">
                <?php
                    echo  '<label>Company Name:</label>
                           <p><strong>'.$company['name'].'</strong></p>
                           <br>
                           <label>Company Email:</label>
                           <p><strong>'.$company['email'].'</strong></p>
                           <br>
                           <label>Company Country:</label>
                           <p><strong>'.$company['country'].'</strong></p>
                           <br>
                           <label>Company Contact:</label>
                           <p><strong>'.$company['contact'].'</strong></p>
                           <br>
                           <label>Company Address:</label>
                           <p><strong>'.$company['address'].'</strong></p>
                           <button class="btn btn-info" data-toggle="modal" data-target="#EditModal" type="button">Edit</button>
                           <br>
                           <br>';
                ?>
            </div>
            <div class="col-4 form-group">
               <h3>Vakancies</h3>
               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal" style="margin: 15px 0"> Add new </button>
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
                    <td>".$job['name']."</td>
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
        <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Vakancy</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="v_name"> </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="v_desc"> </div>
                            <div class="form-group">
                                <label>Region</label>
                                <select name="region"class="form-control">
                                    <option>Almaty</option>
                                    <option>Nursultan</option>
                                    <option>Shymkent</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <input type="text" class="form-control" name="address"> </div>
                            <div class="form-group">
                                <label>Salary</label>
                                <input type="number" class="form-control" name="salary"> </div>
                            <div class="form-group">
                                <label>Working hours</label>
                                <select name="schedule" class="form-control">
                                    <option>Full Day</option>
                                    <option>Shift</option>
                                    <option>Flexible</option>
                                    <option>Remote work</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add Job</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="EditModalLable" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="EditModalLable">Edit</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <label>Company Type</label>
                                <select class="form-control" style="margin-left: 0; max-width: 80px" name="type">
                                     <option>IP</option>
                                     <option>TOO</option>
                                     <option>AO</option>
                                     <option>CKP</option>
                                     <option>MRP</option>
                                     <option>CCP</option>
                                 </select>
                            </div>
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" name="name" value="<?php echo $company['name'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Company Email</label>
                                <input type="text" class="form-control" name="email" value="<?php echo $company['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label>Company Description</label>
                                <textarea class="form-control" name="desc"><?php echo $company['description'] ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Company Site</label>
                                <input type="text" class="form-control" name="site" value="<?php echo $company['site'] ?>"> 
                            </div>
                            <div class="form-group">
                                <label>Country</label>
                                <select name="country" class="form-control">
                                        <?php
                                            do{
                                                echo "<option>".$country['name']."</option>";
                                            }
                                            while ($country = mysqli_fetch_assoc($query_country));
                                        ?>
                                </select>                            
                            </div>
                            <div class="form-group">
                                <label>Company Address</label>
                                <input type="text" class="form-control" name="address" value="<?php echo $company['address'] ?>"> 
                            </div>
                            <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control" name="contact"  value="<?php echo $company['contact'] ?>">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Save</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                            </div>
                        </form>
                    </div>
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
          <a href="find_job.php" style="text-decoration: none">Find Job</a>
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
            if(isset($_COOKIE['user_id']) || isset($_COOKIE['company_id'])){
                echo '<a href="profile.php" style="text-decoration: none">Profile</a>';
            }
            else{
                echo '<a href="loginPage.php" style="text-decoration: none">Your Account</a>';
            }
            ?>
        </p>
        <p>
          <a href="" style="text-decoration: none">Private agency population</a>

        </p>
        <p>
          <a href="contact%20us.php" style="text-decoration: none">About US</a>
        </p>
        <p>
          <a href="#!" style="text-decoration: none">Help</a>
        </p>
      </div>
      <hr class="w-100 clearfix d-md-none">

      <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Contact</h6>
        <p style="color: white;"><span class="fas fa-home mr-3" style="margin-left: 0"></span>Manasa 131</p>
        <p style="color: white;"><span class="fas fa-envelope mr-3" style="margin-left: 0"></span>info@gmail.com</p>
        <p style="color: white;"><span class="fas fa-phone mr-3" style="margin-left: 0"></span>+77777777777</p>
        <p style="color: white;"><span class="fas fa-print mr-3" style="margin-left: 0"></span>+77088888888</p>
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