<?php
include('../includes/connect.php');
session_start();
?>
<?php
        if (isset($_POST['user_login_submit_button'])) {
          $user_email = $_POST['user_email'];
          $user_password = $_POST['user_password'];
          $search_user = "select * from user where user_email='$user_email' and user_password='$user_password'";
          $result = mysqli_query($con, $search_user);
          // setting these null
          $user_temp_password=NULL;
          $user_temp_email=NULL;
          if ($result) {
            // echo '<script>alert("'.$user_email.'");</script>';
            while ($row = mysqli_fetch_assoc($result)) {
              $user_id = (int)$row['user_id'];
              $user_temp_email = $row['user_email'];
              $user_temp_password = $row['user_password'];
              $user_username = $row['user_username'];
              $user_phone_number = (int)$row['user_phone_number'];
            }
            // echo '<script>alert("'.$user_phone_number.'");</script>';
            if ($user_temp_email!=NULL and $user_temp_password=!NULL and $user_email == $user_temp_email and $user_password == $user_temp_password) {
             // echo '<script>alert("Logged In");</script>';
              // refresh page to make user logged in
              $_SESSION['user_logged_in_status'] = true;
              $_SESSION['username']=$user_username;
              $_SESSION['user_id']=(int)$user_id;
              header("Location: ../index.php");
              // echo "<script>
              // window.open('http://localhost/Ecommerce%20Website/index.php,'_self');
              // </script>";


            } else {
              echo "<script>alert('Email or password Do not match')</script>";
            //  $_SESSION['user_logged_in_status'] = false;
            }
          }

          // echo $user_email;
          // echo '<script>alert("'.$user_email.'.");</script>';


        }

        ?>