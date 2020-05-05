<?php
          if(isset($_POST['login']))
          {
            $con = mysqli_connect("localhost","root","");
            mysqli_select_db($con,'webtech');

            $username = $_POST['username'];
            $password = $_POST['password'];
            $query = "select * from users where username='$username' and  password='$password'";

            $query_run = mysqli_query($con,$query);
            if($query_run){
              if(mysqli_num_rows($query_run) > 0)
              {
                $_SESSION['username'] = $username;
                header('location: ../sank.php?username='.$_SESSION['username']);
                $_SESSION['logged'] = TRUE;
                echo '<script type="text/javascript"> alert("Successfully logged in") </script>';
              }
              else{
                  $_SESSION['logged'] = FALSE;
                  echo '<script type="text/javascript"> alert("invalid credentials") </script>';
                  header('location: login.html');
              }
            }
            else{
              $_SESSION['logged'] = FALSE;
              echo '<script type="text/javascript"> alert("database error") </script>';
            }
          }
?>
