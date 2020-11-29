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
<meta charset="UTF-8">
	<title>Login</title>
</head>
<body>
        <?php
    
      // Переменные с формы
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $pass = $_POST['pass'];
        }




      // Подключение к базе данных
    $link = mysqli_connect("localhost", "root", "", "web_mid");
    $auth_error = 'false';

      // Если есть ошибка соединения, выводим её и убиваем подключение

        if(!empty($_POST['email']) && !empty($_POST['pass']))
        {
            $query = mysqli_query($link,"SELECT * FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1");
            $query_comp = mysqli_query($link,"SELECT * FROM company WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1");
            $data = mysqli_fetch_assoc($query);
            $data_comp = mysqli_fetch_assoc($query_comp);

            if($data['pass'] == ($_POST['pass']) && $data['role'] == 'admin')
            {
                $auth_error = 'false';
                setcookie("user_id", $data['id'], time()+3600*24*7, "/");
                header("Location:http://localhost/Midka/adminPage.php");
            }
            else if($data['pass'] == ($_POST['pass']) && $data['role'] == 'user'){

                $auth_error = 'false';
                setcookie("user_id", $data['id'], time()+3600*24*7, "/");
                header("Location:http://localhost/Midka/find_job.php");
            }
            else if($data_comp['password'] == ($_POST['pass'])){

                $auth_error = 'false';
                setcookie("company_id", $data_comp['id'], time()+3600*24*7, "/");
                header("Location:http://localhost/Midka/company.php");
            }
            else{
                $auth_error = 'true';
            }
        }
    
    //trigger
/*    else if(empty($_POST['email']) && empty($_POST['pass'])){
        $auth_error = '';
    }*/
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
                    <a class="nav-link" href="find_job.php">Find a job</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Help</a>
                  </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <strong>
                            <a class="lav-link" style="color: black" href="exx.php">Sign Up</a>
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
				    <a class="nav-link py-4 " href="contact%20us.html">Contact us</a>
				  </li>

				</ul>
			</div>
		</div>
	</div>

  <div class="container">

<hr>

<div class="card bg-light ">
<article class="card-body mx-auto" style="max-width: 500px;">
   <?php
    if($auth_error == 'true'){
        echo '<div class="alert alert-danger text-center" role="alert">
              Incorrect Email or Password. Please, try again!
            </div>';
    }
    else if($auth_error == 'empty'){
        echo '<div class="alert alert-danger text-center" role="alert">
              Please, enter Email and Password!
            </div>';
    }
    ?>
	<h4 class="card-title mt-3 text-center">Login</h4>
    <br>
	<form method="post">
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope" style="width: 16px; heigth: 16px"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email" type="email">
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock" style="width: 16px; heigth: 16px"></i> </span>
		</div>
        <input class="form-control" placeholder="Password" type="password" name="pass">
    </div> <!-- form-group// -->                                     
    <div class="form-group">

        <button type="submit" class="btn btn-primary btn-block"> Login </button>
    </div> <!-- form-group// --> 
    <p class="text-center"><a href="../Midka/exx.php" style="color: black">Don't have an account?</a></p> 
</form>
    
</article>
</div> <!-- card.// -->

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
<!-- JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</html>