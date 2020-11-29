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
	<title>Registration</title>
</head>
<body>
    
    <?php
    
        if(isset($_POST['name'])){
              $name = $_POST['name'];
              $email = $_POST['email'];
              $pass = $_POST['pass'];
              $re_pass = $_POST['re_pass'];
              $contact = $_POST['contact'];
              $country = $_POST['country'];
        }   
    
        if(isset($_POST['c_name'])){
            $c_name = $_POST['c_name'];
            $c_type = $_POST['c_type'];
            $c_name_b = $_POST['c_name_b'];
            $c_email = $_POST['c_email'];
            $c_pass = $_POST['c_password'];
            $c_address = $_POST['c_address'];
            $c_re_pass = $_POST['c_re_password'];
            $c_contact = $_POST['c_contact'];
            $c_country = $_POST['c_country'];
        }

        $link = mysqli_connect("localhost", "root", "", "web_mid");
        
        if(isset($_POST['email'])){
            $query = mysqli_query($link, "SELECT email FROM users WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'");
                if(mysqli_num_rows($query) > 0)
                {
                    $err[] = "Уже существует в базе данных";
                }
                else
                {
                  if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["pass"]) && !empty($_POST["contact"])){

                    $query = mysqli_query($link,"INSERT INTO users (full_name, number, email, pass, country) VALUES ('$name','$contact','$email','$pass','$country')");
                    header("Location:http://localhost/Midka/loginPage.php");
                  }
                }
        }        
        if(isset($_POST['c_email'])){
            $query = mysqli_query($link, "SELECT email FROM company WHERE email='".mysqli_real_escape_string($link, $_POST['email'])."'");
                if(mysqli_num_rows($query) > 0)
                {
                    $err[] = "Уже существует в базе данных";
                }
                else
                {

                  if(!empty($_POST["c_name"]) && !empty($_POST["c_email"]) && !empty($_POST["c_password"]) && !empty($_POST["c_contact"])){

                    $query = mysqli_query($link,"INSERT INTO company (type, name, contact, email, password, country, address) VALUES ('$c_type','$c_name','$c_contact','$c_email','$c_pass','$c_country','$c_address')");
                    header("Location:http://localhost/Midka/loginPage.php");
                  }
                }
        }
        
        $query_country = mysqli_query($link,"SELECT * FROM country");
        $data = mysqli_fetch_assoc($query_country);
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
                            <a class="lav-link" style="color: black" href="loginPage.php">Sign In</a>
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

  <div class="container">

<hr>
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          New User
        </button>
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          New Company
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
        <div>
        <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <p class="text-center">Get started with your free account</p>
            <p style="text-align: center">
                <a href="" class="btn btn-block btn-twitter"> <span class="fab fa-twitter" ></span><strong> Twitter</strong></a>
                <a href="" class="btn btn-block btn-facebook"> <span class="fab fa-facebook-f"></span><strong> Facebook</strong></a>
            </p>
            <p class="divider-text" style="text-align: center">
                <span class="bg-light">OR</span>
            </p>
            <form method="post" action="">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                <input name="name" class="form-control" placeholder="Full name" type="text">
            </div> 
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                <input name="email" class="form-control" placeholder="Email address" type="email">
            </div> 
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone" style="width: 16px; heigth: 16px"></i> </span>
                </div>
                <input name="contact" class="form-control" placeholder="Phone number" type="text">
            </div>     
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="images/world.png" style="width: 16px; heigth: 16px"> </span>
                </div>
                <select name="country" class="form-control" style="margin-left: 0">
                   <?php
                            do{
                                echo "<option>".$data['name']."</option>";
                            }
                            while ($data = mysqli_fetch_assoc($query_country));
                    ?>
                </select>
            </div>
            <div class="form-group input-group">
            </div> <!-- form-group end.// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock" style="width: 16px; heigth: 16px"></i> </span>
                </div>
                <input class="form-control" placeholder="Create password" type="password" name="pass">
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock" style="width: 16px; heigth: 16px"></i> </span>
                </div>
                <input class="form-control" placeholder="Repeat password" type="password" name="re_pass">
            </div> <!-- form-group// -->                                      
            <div class="form-group">

                <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
            </div> <!-- form-group// -->      
            <p class="text-center"><a href="../Midka/loginPage.php" style="color: black">Have an account?</a></p>                                                                 
        </form>
        </article>
        </div>
      </div>
    </div>
  </div>
  <div class="card">
    <div id="headingTwo">
      <h2 class="mb-0">
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div>
              <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Create Company Account</h4>
            <br>
            <br>
            <form method="post" action="">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                 <select class="form-control" style="margin-left: 0; max-width: 80px" name="c_type">
                     <option>IP</option>
                     <option>TOO</option>
                     <option>AO</option>
                     <option>CKP</option>
                     <option>MRP</option>
                     <option>CCP</option>
                 </select>
            </div> 
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                <input name="c_name" class="form-control" placeholder="Company name" type="text">
            </div> 
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                <input name="c_email" class="form-control" placeholder="Company email" type="email">
            </div> 
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-location" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                <input name="c_address" class="form-control" placeholder="Company address" type="text">
            </div> 
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-phone" style="width: 16px; heigth: 16px"></i> </span>
                </div>
                <input name="c_contact" class="form-control" placeholder="Contact number" type="text">
            </div>     
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><img src="images/world.png" style="width: 16px; heigth: 16px"> </span>
                </div>
                <select name="c_country" class="form-control" style="margin-left: 0">
                   <?php
                            $query = mysqli_query($link,"SELECT * FROM country");
                            $data_c = mysqli_fetch_assoc($query);
                            do{
                                echo "<option>".$data_c['name']."</option>";
                            }
                            while ($data_c = mysqli_fetch_assoc($query));
                    ?>
                </select>
            </div>       
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                <input name="c_password" class="form-control" placeholder="Company password" type="password">
            </div>  
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock" style="width: 16px; heigth: 16px"></i> </span>
                 </div>
                <input name="c_re_password" class="form-control" placeholder="Repeat password" type="password">
            </div>                               
            <div class="form-group">

                <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
            </div> <!-- form-group// -->      
            <p class="text-center"><a href="../Midka/loginPage.php" style="color: black">Have an account?</a></p>                                                                 
        </form>
        </article>
        </div>
      </div>
    </div>
  </div>
  </div> 
<!--container end.//-->

<br><br>


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
                if(isset($_COOKIE['user_id'])){
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