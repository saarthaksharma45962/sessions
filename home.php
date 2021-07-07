<?php


    session_start();
    if(!isset($_SESSION['user'])){

        header("location:login.php");

    }
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
                        <a class="nav-link" href="logout.php">Logout<span class="sr-only">(current)</span></a>
                    </li>
                    
                    </ul>
                </div>
            </nav>
    </head>

    <body>
   
        <div>
            
            <h4>Hello <?php echo $_SESSION['user']; ?></h4>
        
        </div>
        <div> 
            <form method="POST">
            <button type="submit" name="view" id="view">View Users</button>
            </form>
        </div>
        <?php if(isset($_POST["view"])){
            ?>
            <div class="container my-3">
            <table class = "table">
            <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th  scope="col">Contact</th>
                <th scope = "col"> Email</th>
            </tr>
            
            </thead>
           
            <tbody>
            <?php include"dbconn.php"; 
            
             $data_fetc = "select ID, Name , Contact, Email from registered";
             $dquery = mysqli_query($conn,$data_fetc);

             while( $row = mysqli_fetch_assoc($dquery)){

                ?>
                <tr>
                    <td><?php  echo $row['ID'];  ?></td>
                    <td><?php  echo $row['Name'];  ?></td>         
                    <td><?php  echo $row['Contact'];  ?></td>
                    <td><?php  echo $row['Email']; ?></td>
                </tr>



    <?php

             }
            
            
            
            
            
            
            
            
    ?>



            </tbody>
            
            </table>
            </div>

<?php
            
        }
    ?>
    </body>




</html>