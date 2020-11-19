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




      // Параметры для подключения
      $db_host = "localhost"; 
      $db_user = "root"; // Логин БД
      $db_password = ""; // Пароль БД
      $db_base = 'web_mid'; // Имя БД
      $db_table = "users"; // Имя Таблицы БД

      // Подключение к базе данных
      $mysqli = new mysqli($db_host, $db_user, $db_password, $db_base);
    $link = mysqli_connect("localhost", "root", "", "web_mid");

      // Если есть ошибка соединения, выводим её и убиваем подключение
      if ($mysqli->connect_error) {
          die('Ошибка : ('. $mysqli->connect_error .') '. $mysqli->connect_error);
      }

        if(!empty($_POST['email']) && !empty($_POST['pass']))
        {
            // Вытаскиваем из БД запись, у которой логин равняеться введенному
            $query = mysqli_query($link,"SELECT id, email, pass FROM users WHERE email='".mysqli_real_escape_string($link,$_POST['email'])."' LIMIT 1");
            $data = mysqli_fetch_assoc($query);

            // Сравниваем пароли
            if($data['pass'] == ($_POST['pass']))
            {
                // Ставим куки
                setcookie("user_id", $data['id'], time()+60*60*24*30, "/");

                // Переадресовываем браузер на страницу проверки нашего скрипта
                header("Location:http://localhost/Midka/adminPage.php");
                }
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
                  <li class="nav-item">
                    <a class="nav-link" href="Find%20Job.php">Find a job</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Find an employee
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#">Employment services</a>
                      <a class="dropdown-item" href="#">Career guidance</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Analysis</a>
                    </div>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Help</a>
                  </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                  <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                  <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
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

<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">

	<h4 class="card-title mt-3 text-center">Login</h4>
    <br>
	<form method="post" action="">
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email" type="email">
    </div> 
    <div class="form-group input-group">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
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