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
    <title>Find Job</title>
</head>
<body>
    <?php

        $link = mysqli_connect("localhost", "root", "", "web_mid");
    
        if(isset($_POST['filter'])){
            
            if(strcmp($_POST['filter'], 'By Salary') === 0){
            
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 ORDER BY salary DESC");
                $data = mysqli_fetch_assoc($query_search);
                   
            }
            else{
                
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 ORDER BY added_date DESC");
                $data = mysqli_fetch_assoc($query_search);
            
            }
            
        }    
    
        if(isset($_POST['specialty']) && isset($_POST['region'])){

            $specialty = $_POST['specialty'];
            $region = $_POST['region'];
            
            if(strcmp($_POST['filter'], 'By Salary') === 0){
            
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 AND name LIKE '%$specialty%' AND region='$region' ORDER BY salary DESC");
                $data = mysqli_fetch_assoc($query_search);
                   
            }
            else{
                
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 AND name LIKE '%$specialty%' AND region='$region' ORDER BY added_date DESC");
                $data = mysqli_fetch_assoc($query_search);
            
            }
            
        }
        else if(isset($_POST['filter']) && !isset($_POST['specialty'])){
            
            if(strcmp($_POST['filter'], 'By Salary') === 0){
            
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 ORDER BY salary DESC");
                $data = mysqli_fetch_assoc($query_search);
                   
            }
            else{
                
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 ORDER BY added_date DESC");
                $data = mysqli_fetch_assoc($query_search);
            
            }
        }
        else if(isset($_POST['specialty']) && isset($_POST['filter'])){
                        
            $specialty = $_POST['specialty'];
            
            if(strcmp($_POST['filter'], 'By Salary') === 0){
            
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 AND name LIKE '%$specialty%' ORDER BY salary DESC");
                $data = mysqli_fetch_assoc($query_search);
                   
            }
            else{
                
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0 AND name LIKE '%$specialty%' ORDER BY added_date DESC");
                $data = mysqli_fetch_assoc($query_search);
            
            }
        
        }else{
            
                $query_search = mysqli_query($link,"SELECT * FROM job WHERE id > 0");
                $data = mysqli_fetch_assoc($query_search);
        
        }
    
        if(isset($_COOKIE['user_id'])){
        
            $id = $_COOKIE['user_id'];
            $query = mysqli_query($link,"SELECT id, full_name, role FROM users WHERE id='".mysqli_real_escape_string($link,$id)."' LIMIT 1");
            $name = mysqli_fetch_assoc($query);

        }

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
                  <li class="nav-item active">
                    <a class="nav-link" href="find_job.php">Find a job</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Help</a>
                  </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <strong>
                            <?php
                            if(!empty($name)){
                                echo '<a class="lav-link dropdown-toggle" style="color: black" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$name['full_name'].'</a>';
                                echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                          <a class="dropdown-item" href="loginPage.php">Logout</a>
                                          <a class="dropdown-item" href="profile.php">Profile</a>';
                                if($name['role'] == 'admin'){
                                    echo '<a class="dropdown-item" href="adminPage.php">Admin Page</a>';
                                }
                                
                                echo '</div>';
                            }else{
                                echo '<a class="lav-link" style="color: black" href="loginPage.php">Sign In</a>';
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
                    <a class="nav-link py-4    " href="#">Industry Metoring Program</a>
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
    <br>
    <div class="container" style="margin-bottom: 70px">
        <div class="resoult-filter clearfix">
                <div class="row-line">

                    <form class="form-inline" method="post">
                        <div class="col-lg-2 text-right">Find</div>
                        <div class="col-lg-3">
                            <div class="form-group" style="margin-left: 0px">
                                <input type="search" name="specialty" class="form-control" placeholder="Specialty">
                            </div>
                        </div>
                            <div class="form-group">
                                <select name="region" class="form-control">
                                    <option value="null" disabled="disabled" selected>region</option>
                                    <option>Almaty</option>
                                    <option>Nursultan</option>
                                    <option>Shymkent</option>
                                </select>
                            </div>
                            <div class="form-group">
                               <select name="filter" class="form-control">
                                    <option>By Date</option>
                                    <option>By Salary</option>
                                </select>
                            </div>
                            <div class="col-lg-2">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </div>
                    </form>

                </div>
        </div>
        <br>

        <h4 class="dark mb15" style="text-align: center">
        
        <?php 
            
            if(isset($_POST['specialty']) && isset($_POST['region'])){
                
                
                if(!empty($_POST['specialty'])){
                    
                    echo $_POST['specialty'].', '.$_POST['region'].' Region';
                    
                }
                
                else{
                    
                    echo $_POST['region'].' Region';
                    
                }
            }
            else if(isset($_POST['specialty'])){
                
                if(empty($_POST['region'])){
                    
                    echo $_POST['specialty'];

                }
            }
               
            
            ?>
            
        </h4>
        <br>
        <div class="result-list clearfix">
            <div class="result-list-heading">
                <div class="row">
                    <div class="col-xs-4 col-sm-6">
                        <span class="hidden-xs"></span>
                    </div>
                </div>
            </div>
            
            <?php 
            
            if(empty($data)){

            ?>

                <div class="result-list-rows">
                    <div class="result-list-row">
                        <div class="row">
                           <div class="col-12">
                                <p style="text-align: center"><strong style="font-weigth: 900; font-size: 48px">RESULT NOT FOUND</strong></p>
                           </div>
                        </div>
                    </div>
                </div>
                
                <?php

            }else{

                do{ 
                ?>

                    <div class="result-list-rows">
                        <div class="result-list-row">
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 hidden-xs img-center">
                                    <img src="images/vacnoavatar.png">
                                </div>
                                <div class="col-lg-6 col-md-7 col-sm-6">
                                    <div class="row-heading">
                                        <a href="#" class="bold orange" style="text-decoration: "><?php echo $data['name']; ?></a>
                                    </div>
                                    <div class="row-info">
                                        <p style="color">IT, telecommunications, electronics, programming, development</p>
                                        <p>
                                                <?php echo $data['description'];?>
                                        </p>
                                    </div>
                                    <div class="row-text">
                                        <p class="grey" style="color: darkgrey"><?php echo $data['added_date'];?></p>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-3">
                                    <ul>
                                        <li>
                                            <?php echo 'Salary: <strong>'.$data['salary'].' $</strong>';?>
                                        </li>
                                        <li>
                                            <?php echo 'Address: <strong>'.$data['address'].'</strong>';?>
                                        </li>
                                        <li>
                                            <?php echo 'Region: <strong>'.$data['region'].'</strong>';?>
                                        </li>
                                        <li>
                                            <?php echo 'Schedule: <strong>'.$data['schedule'].'</strong>';?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php

                    }while ($data = mysqli_fetch_assoc($query_search));
            }
                ?>
        </div>
    </div>
        <!-- Footer -->
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
          <a href="exx.php" style="text-decoration: none">Your Account</a>
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
