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
    <title>Admin</title>
</head>

<body>

<?php

    if(isset($_POST['name'])){

          $name = $_POST['name'];
          $address = $_POST['address'];
          $salary = $_POST['salary'];
          $schedule = $_POST['schedule'];
          $desc = $_POST['desc'];
          $region = $_POST['region'];

    }

    $link = mysqli_connect("localhost", "root", "", "web_mid");

    $query_users = mysqli_query($link,"SELECT * FROM users");

    $query_jobs = mysqli_query($link,"SELECT * FROM job");

    $data_u = mysqli_fetch_assoc($query_users);
    $data_j = mysqli_fetch_assoc($query_jobs);

    if(isset($_POST['name'])){

        $query = mysqli_query($link, "SELECT name FROM job WHERE description='".mysqli_real_escape_string($link, $_POST['desc'])."'");

        if(mysqli_num_rows($query) > 0)
        {

            $err[] = "Уже существует в базе данных";

        }

    }

    if(empty($err))
    {

          if(!empty($_POST["name"]) && !empty($_POST["address"]) && !empty($_POST["salary"]) && !empty($_POST["schedule"]) && !empty($_POST["desc"]) && !empty($_POST["region"])){

            $query = mysqli_query($link,"INSERT INTO job (name, description, address, region, salary, schedule, added_date) VALUES ('$name', '$desc','$address','$region','$salary','$schedule', NOW())");

          }

    }

    if(isset($_POST['update_name']) && isset($_POST['update_id'])){

        $id = $_POST['update_id'];
        $name = $_POST['update_name'];
        $desc = $_POST['update_desc'];
        $address = $_POST['update_address'];
        $region = $_POST['update_region'];
        $salary = $_POST['update_salary'];
        $schedule = $_POST['update_schedule'];

        $query ="UPDATE job SET name='$name', description='$desc', address='$address', region='$region', salary='$salary', schedule='$schedule', added_date=NOW()  WHERE id='$id'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);
    }

    if(isset($_POST['delete_id'])){

        $id = $_POST['delete_id'];
        $query ="DELETE FROM job WHERE id='$id'";
        $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
        mysqli_close($link);

    }

    if(isset($_COOKIE['user_id'])){

        $id = $_COOKIE['user_id'];
        $query = mysqli_query($link,"SELECT * FROM users WHERE id='".mysqli_real_escape_string($link,$id)."' LIMIT 1");
        $name = mysqli_fetch_assoc($query);

    }

    if(isset($_POST['logout'])){
        setcookie("user_id", $id, time()-3600*24*7, "/");
        header("Location:http://localhost/Midka/loginPage.php");
    }

?>
        <div class="header frontpage" style="margin-top: 30px">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light bg-#EFF3F8"> <a class="navbar-brand" href="#">EMPLOYMENT.COM</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"> <a class="nav-link" href="index.html">Home</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="find_job.php">Find a job</a> </li>
                            <li class="nav-item"> <a class="nav-link" href="#" tabindex="-1" aria-disabled="true">Help</a> </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown">
                                <strong>
                                    <?php
                                        if(!empty($name)){
                                            echo '<a class="lav-link dropdown-toggle" style="color: black" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$name['full_name'].'</a>';
                                            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                                      <form method="Post">
                                                      <input type="hidden" name="logout" value="1">
                                                      <button type="submit" class="dropdown-item">Logout</button>
                                                      </form>
                                                      <a class="dropdown-item" href="profile.php">Profile</a>';
                                            if($name['role'] != 'admin'){
                                                header("Location:http://localhost/Midka/loginPage.php");
                                                setcookie("user_id", $id, time()-3600*24*7, "/");
                                            }

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
        </div>
        <hr class="my-4">
        <div class="container  bg-light">
            <h2 style="padding: 30px 0 0 0">All Users</h2>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Telephone</th>
                        <th scope="col">E-email</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>

                <?php

                    do{
                        echo "<tr>";
                        echo "<td>".$data_u['id']."</td>";
                        echo "<td>".$data_u['full_name']."</td>";
                        echo "<td>".$data_u['number']."</td>";
                        echo "<td>".$data_u['email']."</td>";
                        echo "<td><button class='btn btn-info'>Details</button></td>";
                        echo "</tr>";
                    }
                    while ($data_u = mysqli_fetch_assoc($query_users));

                ?>

            </table>
        </div>
        <hr class="my-4">
        <div class="container  bg-light">
            <h2 style="padding: 30px 0 0 0">Job List</h2>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal" style="margin: 15px 0"> Add new </button>
            <br>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Address</th>
                        <th scope="col">Region</th>
                        <th scope="col">Salary</th>
                        <th scope="col">Schedule</th>
                        <th scope="col">Date</th>
                        <th scope="col">Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                         $rows = mysqli_num_rows($query_jobs);

                        for($i = 1; $i < $rows; ++$i){
                            $row = mysqli_fetch_row($query_jobs);
                            echo "<tr>";
                                for($j = 0; $j < 8; $j++) echo "<td>$row[$j]</td>";
                            echo "<input type='hidden' id='name_$row[0]' value='$row[1]'>";
                            echo "<input type='hidden' id='desc_$row[0]' value='$row[2]'>";
                            echo "<input type='hidden' id='address_$row[0]' value='$row[3]'>";
                            echo "<input type='hidden' id='region_$row[0]' value='$row[4]'>";
                            echo "<input type='hidden' id='salary_$row[0]' value='$row[5]'>";
                            echo "<input type='hidden' id='schedule_$row[0]' value='$row[6]'>";
                            echo "<input type='hidden' id='date_$row[0]' value='$row[7]'>";
                            echo "<td><button onclick='updateJob($row[0])' class='btn btn-info btn-sm' data-toggle='modal' data-target='#UpdateJobModal' type='button'>Update</button>
                                        <button onclick='deleteJob($row[0])' class='btn btn-danger btn-sm' data-toggle='modal' data-target='#deleteJobModal' type='button'>Delete</button>
                                </td>";
                            echo "</tr>";
                        }

                    ?>
                </tbody>
            </table>
        </div>     
        <!-- Button trigger modal -->
        <!-- Modal -->
        <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control" name="name"> </div>
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" class="form-control" name="desc"> </div>
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
        <div class="modal fade" id="UpdateJobModal" tabindex="-1" role="dialog" aria-labelledby="UpdateJobModalLable" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="UpdateModaljobLable">Update Job</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="form-group">
                                <input type="hidden" name="update_id" id="update_id">
                                <label for="update_name">Name</label>
                                <input type="text" class="form-control" name="update_name" id="update_name">
                            </div>
                            <div class="form-group">
                                <label for="update_desc">Description</label>
                                <input type="text" class="form-control" name="update_desc" id="update_desc"> 
                            </div>
                            <div class="form-group">
                                <label for="update_address">Address</label>
                                <input type="text" class="form-control" name="update_address" id="update_address"> 
                            </div>
                            <div class="form-group">
                                <label for="update_region">Region</label>
                                <select name="update_region" id="update_region" class="form-control">
                                    <option>Almaty</option>
                                    <option>Nursultan</option>
                                    <option>Shymkent</option>
                                </select>                            </div>
                            <div class="form-group">
                                <label for="update_salary">Salary</label>
                                <input type="number" class="form-control" name="update_salary" id="update_salary"> </div>
                            <div class="form-group">
                                <label for="update_schedule">Schedule</label>
                                <select name="update_schedule" class="form-control" id="update_schedule">
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
        <div class="modal fade" id="deleteJobModal" tabindex="-1" role="dialog" aria-labelledby="UpdateJobModalLable" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Are you sure?</h5> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                    </div>
                    <div class="modal-footer">
                        <form method="post">
                            <div class="form-group">
                                <input type="hidden" name="delete_id" id="delete_id">
                            </div>
                            <button type="submit" class="btn btn-danger">Delete job</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Close</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!-- Footer -->
        <footer class="page-footer font-small mdb-color pt-4" style="background-color: #474747;">
            <div class="container text-center text-md-left">
                <div class="row text-center text-md-left mt-3 pb-3">
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Emloyment of Students</h6>
                        <p style="color: white;">Info about Service Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                    <hr class="w-100 clearfix d-md-none">
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Services</h6>
                        <p> <a href="find_job.php" style="text-decoration: none">Find Job</a> </p>
                        <p> <a href="#!" style="text-decoration: none">Find Worker</a> </p>
                        <p> <a href="#!" style="text-decoration: none">Employment Service</a> </p>
                        <p> <a href="#!" style="text-decoration: none">Analytics</a> </p>
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
                        <p> <a href="#!" style="text-decoration: none">Private agency population</a> </p>
                        <p> <a href="contact%20us.html" style="text-decoration: none">About US</a> </p>
                        <p> <a href="#!" style="text-decoration: none">Help</a> </p>
                    </div>
                    <hr class="w-100 clearfix d-md-none">
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold" style="color: white;">Contact</h6>
                        <p style="color: white;"> <span class="fas fa-home mr-3" style="margin-left: 0"></span>Manasa 131</p>
                        <p style="color: white;"> <span class="fas fa-envelope mr-3" style="margin-left: 0"></span>info@gmail.com</p>
                        <p style="color: white;"> <span class="fas fa-phone mr-3" style="margin-left: 0"></span>+77777777777</p>
                        <p style="color: white;"> <span class="fas fa-print mr-3" style="margin-left: 0"></span>+77088888888</p>
                    </div>
                </div>
                <hr>
                <div class="row d-flex align-items-center">
                    <div class="col-md-7 col-lg-8">
                        <p class="text-center text-md-left" style="color: white;">©️ 2020 Copyright:
                            <a href="#"> <strong> Employment.com</strong> </a>
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

<script type="text/javascript">

    const updateJob = (id) => {
        document.getElementById("update_id").value = id;
        document.getElementById("update_name").value = document.getElementById("name_" + id).value;
        document.getElementById("update_desc").value = document.getElementById("desc_" + id).value;
        document.getElementById("update_address").value = document.getElementById("address_" + id).value;
        document.getElementById("update_region").value = document.getElementById("region_" + id).value;
        document.getElementById("update_salary").value = document.getElementById("salary_" + id).value;
        document.getElementById("update_schedule").value = document.getElementById("schedule_" + id).value;
    }
    const deleteJob = (id) => {
        document.getElementById("delete_id").value = id;
    }

</script>

</html>
