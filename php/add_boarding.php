<?php
require 'connect.inc.php';

//////////////////////////////////////////////
session_start();

$email=$_SESSION['email'];
/////////////////////////////////////////////

//////////////////////////////////////////////
//file uploading errors
$error_1=$error_2=$error_3='';

//other errors
$fill_all=$error_password='';

//raising error for alert box
$error_alert="error";
///////////////////////////////////////////////



if(isset($_POST['submit'])){
    $email=$_SESSION['email'];
    $password=$_POST['password'];
    $studentCount=$_POST['studentCount'];
    $price=$_POST['price'];
    $distance=$_POST['distance'];
    $address=$_POST['address'];
    
    $photo_array=array('photo_1','photo_2','photo_3','photo_4','photo_5');
    $allPhotosFilled=1;
    for($num=0; $num<5; $num++){
        $allPhotosFilled=($allPhotosFilled)&&($_FILES[$photo_array[$num]]['name']!='');
    }
   
    if(($email!='') && ($password!='') && ($studentCount!='') && ($price!='') && ($distance!='') && ($address!='') && ($allPhotosFilled)){
       
        /*finding the user id
        =====================*/
        $query_select="SELECT * FROM users WHERE email='$email'";
        if(!is_null(mysqli_query($db, $query_select))){
            if ($query_run = mysqli_query($db, $query_select)) {
                while ($row = mysqli_fetch_assoc($query_run)) {
                     $userID = $row['userID'];
                     $password_db = $row['password'];
                    
                    
                    /*adding boarding data to database
                    ==================================*/
                    if($password==$password_db){
                        $query_add = "INSERT INTO boarding_details VALUES(NULL, '$userID', '$studentCount', '$price', '$distance','$address')";
                        if (mysqli_query($db, $query_add)) {
                            $price = '500';
                            $studentCount = '1';
                            $password = '';
                            $distance = '100';
                            $address='';
                            //echo 'successfully added!';
                            
                            /*finding the last boarding ID (boarding ID of the current boarding input)
                            =========================================================================*/
                            
                            $query_lastid="SELECT * FROM `boarding_details` ORDER BY boardingID DESC";
                            if(!is_null(mysqli_query($db, $query_lastid))) {
                                if ($query_run_lastid = mysqli_query($db, $query_lastid)) {
                                    while ($row_lastid = mysqli_fetch_assoc($query_run_lastid)) {
                                        $last_boarding_id=$row_lastid['boardingID'];
                                        
                                        /*photo adding process
                                        ======================*/
                                        $photo_array=array('photo_1','photo_2','photo_3','photo_4','photo_5');
                                        for($num=0; $num<5; $num++){
                                            $file_name = $_FILES[$photo_array[$num]]['name'];
                                            $file_size = $_FILES[$photo_array[$num]]['size'];
                                            $file_type = $_FILES[$photo_array[$num]]['type'];
                                            $file_tmp_name = $_FILES[$photo_array[$num]]['tmp_name'];
                                            $file_extention=strtolower(substr($file_name,strpos($file_name,'.')+1));
                                            $file_max_size=5242880;

                                            if(isset($file_name)){
                                                if(!empty($file_name)){
                                                    if(($file_extention=='jpg' || $file_extention=='jpeg')&&($file_type=='image/jpeg')&&($file_size<=$file_max_size)) {
                                                        
                                                        /*upload location and renaming the image file
                                                        =============================================*/
                                                     $location = 'uploads';
                                                   if(is_dir($location)==false){
                                                        mkdir("$location", 0700);// Create directory if it does not exist
                                                    } 
                                                    $new_file_name='u'.$userID.'b'.$last_boarding_id.'img0'.$num.'.'.$file_extention;
                                                        if (move_uploaded_file($file_tmp_name, "$location/" . $new_file_name)) {
                                                            echo 'uploaded';
                                                        } else {
                                                            $error_1= '*There was an error uploading the file '.$file_name.' ';
                                                        }
                                                    }else{
                                                        $error_2= '*file must be jpg/jpeg and must be 5MB or less. ';
                                                    }
                                                }else{
                                                    $error_3= '*please choose an image ';
                                                }
                                            }
                                        }
                                        break;
                                    }
                                }
                            }

                        } else {
                        }
                    }else{
                        $error_password= '*invalid password!';
                        $password='';
                    }
                }
            }
        }else{
            $error_email= '*Your email does not exist!';
        }   
    $error_alert="";
    }else{
        $fill_all= '*fill all the data.';
    }
}else{
    $password='';
    $studentCount='';
    $price='';
    $distance='';
    $address='';
}
?>