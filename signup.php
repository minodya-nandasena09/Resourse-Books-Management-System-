<?php
session_start();
if (isset($_SESSION["user"]))
{
    header("Location: levels.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>SignUp-Page</title>
</head>
<body>
    <!--Header-->
    <header class="header">
        <a href="#" class="logo">Reference Books Manager - FOTS, UOV</a>

        <nav class="navbar">
            <p>Change Theme</p>
            <a>
                <div class="icon">
                <div class="bx bxs-moon" id="darkMode-icon">
                </div>
            </a> 
        </nav>
       <!-- <div class="icon">
        <div class="bx bxs-moon" id="darkMode-icon">
        </div>
        </div>-->
        
    </header>

    <section class="home" id="home">
        <div class="home-content">
            <div class="container pt-5">

            
            <!--<form action="login.php" method="post">
                <div class="form-group">
                    <input type="text" placeholder="Enter username" name="fullname" class="form-control">
                </div>

                <br><br><br>
                <div class="form-group">
                    <input type="password" placeholder="Enter password" name="password" class="form-control">
                </div>
                <br><br><br>
                <div class="form-btn">
                    <input type="submit" value="login" name="login" class="btn btn-primary">
                </div>
    
            </form>
        </div>
            <div><p></p>Not Registered Yet? <a href="signup.html">Click here</a></div>-->
 

            <div class="wrappers">
                <div class="form-box login">
                    <h2>Don't Have an Account ?</h2>
                    <br>

                    <?php
    if (isset($_POST["submit"]))
    {
        $fullName = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $passwordRep = $_POST["rep-password"];

        //$pass=md5($password);


        $errors = array();

        if(empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRep)  ){
            array_push($errors,"All fields are required");
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            array_push($errors, "Email is not valid");
        }
        if(strlen($password)<4)
        {
            array_push($errors,"Password must be 4 character long");
        }
        if($password!==$passwordRep)
        {
            array_push($errors," Password is not matched");
        }

        require_once "database.php";
        $sql = "SELECT * FROM ref_book WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($result);
        if($rowCount>0)
        {
            array_push($errors, "Email already exist!");
        }

        if(count($errors)>0)
        {
            foreach($errors as $error){
                echo "<div class='btn'>$error</div>";
            }
        }
        else{
           
            $sql = "INSERT INTO ref_book (username, email, password) VALUES ( ?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss", $fullName, $email, $password);
                mysqli_stmt_execute($stmt);
                echo "<div class='btn'>You have registered succesfully</div>";
                header("Location: levels.php");
            }
            else{
                die("Something went wrong");
            }
        }

    }
    ?>


                    <form action="signup.php" method="post">

                        <div class="input-box">
                            <p><span class="icon"><ion-icon name="person-outline"></ion-icon></span>
                                <input type="text" name="username" required >
                                <label>Username</label></p>
                        </div>

                        <div class="input-box">
                            <p><span class="icon"><ion-icon name="mail-open-outline"></ion-icon></span>
                                <input type="email" name="email" required >
                                <label>E-mail</label></p>
                        </div>
                        
                        <div class="input-box">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                               <p><input type="password" name="password" required >
                                <label>Password</label></p>
                        </div>

                        <div class="input-box">
                            <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                               <p><input type="password" name="rep-password" required >
                                <label>Confirm Password</label></p>
                        </div>
                        
                        <div class="remember-forgot">
                           <label><input type="checkbox"> I agree to terms and conditions.</label>
                            <!--<a href="#">forgot password ?</a>-->
                        </div>

                        <input type="submit" name="submit" value="Sign up" class="btn">
                        <div class="login-register">
                            <p>Have an account ?<a href="signin.php" class="register"> Sign in</a></p>
                        </div>
                    </form>
                </div>
            </div>
            
            
        </div>

        <div class="pro-containers">
            <div class="pro-box">
                <div class="pro-container">
                    <div class="pro-box">
                        <div class="pro" style="--i:0;">
                            <i class='bx bx-book-open' ></i>
                            <h3>Self-study</h3>
                        </div>
        
                        <div class="pro" style="--i:1;">
                            <i class='bx bx-book-open' ></i>
                            <h3>Save time</h3>
                        </div>
        
                        <div class="pro" style="--i:2;">
                            <i class='bx bx-book-open' ></i>
                            <h3>Manage better GPA</h3>
                        </div>
        
                        <div class="pro" style="--i:3;">
                            <i class='bx bx-book-open' ></i>
                            <h3>Level-up yourself</h3>
                        </div>
        
                        <div class="circle"></div>
                       
                    </div>
                    <div class="overlay"></div>
                </div>
        
                <div class="home-img">
                    <img src="img/un1.svg" alt="">
                </div>
                
            </div>
            
        </div>

        <div class="home-img">
            <img src="img/un1.svg" alt="">
        </div>
        </section>
        
        <br>
        

    </div>
   
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script src="script.js"></script>
</body>
</html>