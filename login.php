<?php


    session_start();
?>

<html>
<head>   
        
        <meta charset="utf-8">
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
        include"dbconn.php";
    
        if(isset($_POST["Log_in"])){

            $email = $_POST["email"];
            $passwd = $_POST["pass1"];
 #----------------------creating hash of the entered password-------------------
            $hpsswd = md5($passwd);
 # ------------validate email-------------------------------------------
        if(filter_var($email,FILTER_VALIDATE_EMAIL)){
            $email_search = "select* from registered where Email='$email' ";
            $query_email = mysqli_query($conn,$email_search);

            $email_count = mysqli_num_rows($query_email);

            if($email_count){
                $email_pass = mysqli_fetch_assoc($query_email);
#---------------validating password---------------------------------------------------------------
                $db_pass = $email_pass["Password"];
                $_SESSION["user"] = $email_pass['Name'];
                if($hpsswd==$db_pass){

                   header("location:home.php");

                }
                else{
                    echo"invalid password";
                }

            }
            else{


                echo"Invalid email";
                }
            }
        }





    ?>

    <section>
    <form   method="POST">
        <div class="container my-3">
        <form  method= "post"  >
            <div class="form-group row">
            <div class="col-xs-4">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter email" required />
            </div>
            </div>
            <div class="form-group row">
            <div class="col-xs-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" name = "pass1" id= "pass1" placeholder="Enter password" required/>
            </div>
            </div> 
        
        <button type="submit" name="Log_in" class="btn btn-default">LOG IN</button>
    </form>
    <div>
        <h6>Don't have an account? <a href="register.php">Sign UP</a></h6>
    </div>
    </section>


    </body>

    </html>