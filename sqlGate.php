<?php

session_start();

$link = mysqli_connect("shareddb-u.hosting.stackcp.net", "secret-diary-313333a05a", "n7vafey1d8", "secret-diary-313333a05a");

if (mysqli_connect_error()) {    
    die ("Database Connection NOT Successful");
    }

        
    $diary = mysqli_real_escape_string($link, $_POST['inputArea']);
    $email = $_SESSION['email'];

    echo $diary;
    echo $email;
    

    $query = "UPDATE `users` SET diary='$diary' where email='$email'";
    
    if(mysqli_query($link, $query)){
        
        echo "Sucessfully Updated";
        $_SESSION['diary'] = $diary;
        
            
    } else {
        
        echo "Update Failed";
        
    } 
 

?>