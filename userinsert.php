<?php
    include 'connection.php';
    
    if($_POST)
    {
        $fullname = $_POST['full_name'];
         $address = $_POST['address'];
         $phone = $_POST['phone'];
         $date_of_birth = $_POST['date_of_birth'];
        $email = $_POST['email'];
        $password =$_POST['password'];

        $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = "a44afb0b6808d662";

        $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);


        $count=0;
        if (empty($fullname)) {
        echo"<script>alert('You forgot to enter your first name!'); window.history.back(); fullname.focus();</script>";
        
        $count++;
        }
        
        else if (empty($date_of_birth)) {
        echo"<script>alert('You forgot to enter your date of birth!');window.history.back();date_of_birth.focus();</script>";
        $count++;
        
        }
        else if (empty($phone)) {
            echo"<script>alert('You forgot to enter your phone number!');window.history.back();phone.focus();</script>";
            $count++;
            
            }
         else if(strlen($phone)!=10)
        {
             echo"<script>alert('enter a validate phone number!');
            location.href='http://localhost/chatting/Registration.php';
             phone.focus();
            </script>";
        $count++;

        }

        else if (empty($email)) {
        echo"<script>alert('You forgot to enter your email!');window.history.back();
        date_of_birth.focus();</script>";
        
        $count++;
        }
        

       
        else if (empty($password)) {
       echo"<script>alert('You forgot to enter your password!');window.history.back();
       password.focus();</script>";
        
                $count++;
        }
         else if(strlen($password)!=6)
        {
             echo"<script>alert('enter a validate password!');
            location.href='http://localhost/chatting/Registration.php';
             password.focus();
            </script>";
        $count++;

        }
        if($count==0)        
            {
                
                    $sql =("SELECT * FROM tbl_users where email='$email' ")  or die("failed to query database".mysqli_error());
                       
                       $result=mysqli_query($conn,$sql);
                       
                       $row=mysqli_fetch_array($result);
                      if($row['email']==$email)
                       {
                       echo"<script>alert('Account has been already Registered!!!' );</script>";
                        header('location:http://localhost/chatting/Registration.php');


                       }
                       else
                       {

                            $sql = "INSERT into tbl_users (full_name,
                            address,phone,date_of_birth,email,password) VALUES ('$fullname','$address','$phone','$date_of_birth','$email','$encryptedpswd')";
                            if(mysqli_query($conn, $sql))
                            {
                                echo"data is inserted succesfully";
                             
                             header('location:http://localhost/chatting/Login.php');
                             
                            }
                            else
                             {
                                echo"data is not inserted succesfully";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            header("Location:http://localhost/chatting/Registration.php");
                            }
                        }
                
               }
             

        }
        
   
?>