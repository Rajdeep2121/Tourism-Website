<?php
        
        $firstname= $_POST['firstname'];
        $lastname= $_POST['lastname'];  
        $username= $_POST['username'];
        $passwd= $_POST['password'];
       
     
        //if(!empty($firstname) || !empty($passwd) || !empty($lastname) || !empty($email)|| !empty($passwd)){
            $host="localhost";
            $dbUsername="root";
            $dbpasswd="";
            $dbname="webtech";

            $conn = new mysqli($host, $dbUsername, $dbpasswd, $dbname);
           // if(mysqli_connect_error()){
             //   die('Connect Error('. mysqli_connect_errno().')'.mysqli_connect_error());
            //}
            if(!mysqli_connect_error()){
                //$SELECT ="SELECT email From itiner Where email = ? Limit 1";
                $SELECT1="SELECT username From users Where username = ? Limit 1";
                $INSERT="INSERT Into users(firstname, lastname,username,password) values(?,?,?,?)";

                //$stmt=$conn->prepare($SELECT);
                //$stmt->bind_param("s",$email);
                //$stmt->execute();
                //$stmt->bind_result($email);
                //$stmt->store_result();
                //$row= $stmt->num_rows;

                $stmt=$conn->prepare($SELECT1);
                $stmt->bind_param("s",$username);
                $stmt->execute();
                $stmt->bind_result($username);
                $stmt->store_result();
                $row1= $stmt->num_rows;

                if($row==0 && $row1==0){
                    $stmt->close();

                    $stmt=$conn->prepare($INSERT);
                    $stmt->bind_param("ssss", $firstname,$lastname,$username,$passwd);
                    $stmt->execute();
                    $mes1="New record inserted successfully";
                    echo "<script type='text/javascript'>alert('$mes1');
                    window.location.href = 'http://localhost/working/login/login.html';
                    </script>";
                }
                else{
                    if($row==1){
                    $mes="Looks like you are already a member of our website. Try logging in instead!";
                    echo "<script type='text/javascript'>alert('$mes');
                    window.location.href = 'http://localhost/working/login/login.html';
                    </script>";
                }
                else if($row1==1){
                    $me="Oops! It seems as though someone already has used this username!Try using a different one";
                    echo "<script type='text/javascript'>alert('$me');
                    window.location.href = 'http://localhost/working/login/register.html';
                    </script>";
                }
            }
            }
        //}
        //else{
            $message="All fields are required";
            echo "<script type='text/javascript'>alert('$message');
            window.location.href = 'http://localhost/working/login/register.html';
            </script>";
            die();
        //}
        ?>
        