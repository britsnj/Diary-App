<?php

    session_start();

    $username = "";
    $email = "";
    $errors = array();
    
    
    $link = mysqli_connect("shareddb-u.hosting.stackcp.net", "secret-diary-313333a05a", "n7vafey1d8", "secret-diary-313333a05a");

    if (mysqli_connect_error()) {    
      die ("Database Connection NOT Successful");
    }

        if (isset($_POST['login_btn'])){

            if (empty($_POST['email'])){

                $errors['email'] = "Please enter your e-mail";
                
            } 
            
            if (empty($_POST['password'])) {

                 $errors['password'] ="Please enter your password to continue";
    
                    } else {
                    
                    //CHECK THAT THE USER EXISTS
                    
                    $email = mysqli_real_escape_string($link, $_POST['email']);
                    $password = mysqli_real_escape_string($link, $_POST['password']);
                    
                    if (count($errors) === 0 ){                 
                    $query = "SELECT * from `users` WHERE email = '$email'";
                    
                    if ($result = mysqli_query($link, $query)){
                        
                        $user = mysqli_fetch_array($result);
                    
                        if (mysqli_num_rows($result) > 0){
                    
                    
                                if (password_verify($password, $user['password'])){
                                    
                                    if($_POST['stayLoggedin']){
                                        
                                        setcookie('name', $user['name'], time() + (86400*30), "/");
                                    } 
                                    
                                    $_SESSION['name'] = $user['name'];
                                    $_SESSION['email'] = $user['email'];
                                    $_SESSION['verified'] = $user['verified']; //verified is used for email verification
                                    $_SESSION['token'] = $user['token'];
                                    $_SESSION['message'] = "You have been logged in";
                                    header('location: index.php');
                                    
                                } else {
                                    
                                    $errors['loginpassword'] = "Invalid Password. Try again.";
                                } 
                        } else {
                            
                            $errors['unknown'] = "We do not have that user in our database. Please <a href=signup.php>Register</a>";
                        }
                        
                        }
                        
                    }
                    
                    }
        }


?>


<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <link href="https://fonts.googleapis.com/css2?family=Aclonica&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="main.css">
    
    </head>
    
    <body>
    
        <div class="container-fluid" id="background">
            
            <img class="bgd-img" src="images/background.jpg">
            

            <h1 id="title">MY SECRET DIARY</h1>

            <div class="container" id="loginForm">
                <?php if (count($errors) > 0): ?>
                      <div class="alert alert-danger">
                        <?php foreach ($errors as $error): ?>
                        <li>
                          <?php echo $error; ?>
                        </li>
                        <?php endforeach;?>
                      </div>
                    <?php endif;?>
                <form method="POST">
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col">
                            <p id="prompt">Please log in with your e-mail and password</p>
                        </div>
                        <div class="col">
                        </div>
                    </div>
                    <div class="form-group mx-sm-3">
                    <label for="email">Email address</label>
                    <input type="email" name="email" class="form-control" id="loginEmail">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                    </div>
                    <div class="form-group mx-sm-3">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="loginPassword">
                    </div>
                    <div class="form-group form-check mx-sm-3">
                    <input type="checkbox" class="form-check-input" id="loggedinCheck" name="stayLoggedin">
                    <label class="form-check-label" for="stayLoggedin">Stay Logged In (30 days)</label>
                    </div>
                    <button type="submit" class="btn btn-primary mx-sm-3" name = "login_btn">Log In</button>
                </form>
                <div class="row">

                    <div class="col">
                    </div>
                    <div class="col">
                        <a id=regLink href="signup.php">Click here to Register</a>
                    </div>
                    <div class="col">
                    </div>
                </div>                      
            </div>

        </div>


        <script type="text/javascript">
        
           
        </script>



        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>  
        
</body>

</html>

   


