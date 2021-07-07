<?php


    session_start();
?>




<html>
    <head>   <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="main.css"/>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <a class="navbar-brand" href="#">WELCOME</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                
                </ul>
            </div>
        </nav>
    </head>
    <body>
    <?php 

    include "dbconn.php";


      if(isset($_POST['submit'])){
        
        $name = mysqli_real_escape_string($conn,$_POST['user']);
        $email = mysqli_real_escape_string($conn,$_POST["email"]);
        $contact = mysqli_real_escape_string($conn,$_POST["p_number"]);
        $password = mysqli_real_escape_string($conn,$_POST["pass"]);
        $cpassword = mysqli_real_escape_string($conn,$_POST["cpass"]);
#creating hashed passwords--------------------------------------
        $pass = md5($password);
        $cpass = md5($cpassword);
        
# Check whether email is in perfect format--------------------------------------------------------
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
        
       


# Check whether email already exists or not------------------------
          $emailquery = "select* from registered where Email = '$email'";
          $query = mysqli_query($conn,$emailquery);

          $emailcount = mysqli_num_rows($query);
          if($emailcount > 0){
          echo"email already exists";
              }
              else{
                if(preg_match("/^[0-9]{10}+$/",$contact)){


#-------------------------check whether password and confirm password match or not------------------
                if($password === $cpassword){


                  #inserting data----------------------------
                      $a_query = "insert into registered(Name, Email,Contact,Password,Confirm_Pass) values ('$name','$email','$contact','$pass','$cpass')";
                      $query1 = mysqli_query($conn,$a_query);
                  
                  }
                  else{
                  
                    echo"passwords do not match";
                  }

                }
                else{
                  echo"Enter valid contact number";
                }

              }
            }
          else{
            echo"Enter valid email address";
          }



      }


    ?>
    <section>
  <div class="container-with-center">
    Register 
  </div>
</section>
<section>
  <div class="container">
  <form  method= "post"  >
    <div class="form-group row">
      <div class="col-xs-4">
        <label for="user">Name</label>
        <input type="text" name="user" id="user" class="form-control" placeholder="Enter username" required />
      </div>
    </div>
    <div class="form-group row">
      <div class="col-xs-4">
        <label for="email">Email</label>
        <input type="email" class="form-control" name = "email" id= "email" placeholder="Enter email Id" required/>
      </div>
    </div> 

    <div class="form-group row">
      <div class="col-xs-4">
        <label for="p_number">Contact</label>
        <input type="text" class="form-control"  name = "p_number" id = "p_number" placeholder="Enter contact number" required/>
      </div>
    </div>
   
    <div class="form-group row">
      <div class="col-xs-4">
        <label for="pass">Password</label>
        <input type="password" class="form-control"  name = "pass" id="pass" placeholder="Enter password" required/>
      </div>
    </div>

    <div class="form-group row">
      <div class="col-xs-4">
        <label for="pass">Confirm Password</label>
        <input type="password" class="form-control"  name = "cpass" id="cpass" placeholder="confirm password" required/>
      </div>
    </div>
    <button type="submit" name="submit" class="btn btn-default">SIGN UP</button>

    </form>
    <div>
      <h6>Have an account?</h6><a href="login.php">Log In</a>
    </div>
  </div>
</section>

    </body>










</html>