<?php
/*
  Plugin Name: Forms
  Plugin URI:http://register.local/
  Description: Updates user rating based on number of posts.
  Version: 1.0
  Author: varsha
 
 */

add_action('wp_enqueue_scripts', 'callback_for_style');
function callback_for_style() {
    wp_register_style( 'register', plugins_url('/style.css', __FILE__), false, '1.0.0', 'all' );
    wp_enqueue_style( 'register' );
}

function register_contact_form(){

    if(isset($_POST['submitted'])) 
    {

        if(trim($_POST['FirstName']) === '') {
            $firstnameError = 'Please enter your first name.';
            $hasError = true;
        } else {
            $firstname = trim($_POST['FirstName']);
        }
        
            if(trim($_POST['LastName']) === '') {
                $lastnameError = 'Please enter your last name.';
                $hasError = true;
            } else {
                $lastname = trim($_POST['LastName']);
            }
            
                if(trim($_POST['Address']) === '') {
                    $streetaddressError = 'Please enter your address.';
                    $hasError = true;
                } else {
                    $Address = trim($_POST['Address']);
                }
                
                    if(trim($_POST['Address']) === '') {
                        $streetaddressError = 'Please enter your address.';
                        $hasError = true;
                    } else {
                        $Address = trim($_POST['Address']);
                    }
                    
                        if(trim($_POST['Cityname']) === '') {
                            $cityError = 'Please enter your city.';
                            $hasError = true;
                        } else {
                            $Cityname = trim($_POST['Cityname']);
                        }
                        
                        if(trim($_POST['code']) === '') {
                            $pincodeError = 'Please enter your Pincode.';
                            $hasError = true;
                        } else if ( ! (preg_match('/^[0-9]{6}$/D', $_POST['code'] ))){
                            $pincodeError= "Incorrect Zip code! Please enter correct number.";
                        }
                    
                        
                        
                        //else {
                           // $code = trim($_POST['code']);
                        //}
                            


                            if(trim($_POST['email']) === '')  {
                                $emailError = 'Please enter your email address.';
                                $hasError = true;
                            } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
                                $emailError = 'You entered an invalid email address.';
                                $hasError = true;
                            } else {
                                $email = trim($_POST['email']);
                            }

                    
                                if(trim($_POST['phonenumber']) === '') {
                                    $phonenumberError = 'Please enter your Phone number.';
                                    $hasError = true;
                                }else if (!preg_match("/^([0-9]{10})$/", trim($_POST['phonenumber'])))
                                 {
                                     $phonenumberError ='you entered invalid mobile number.';
                                     $hasError=true;
                                 }else {
                                
                                    $phonenumber=trim($_POST['phonenumber']);
                                }
                             
                                
                               if(trim($_POST['amount']) === '') {
                                $amountError = 'Please enter your amount.';
                              $hasError = true;
                             } 
                       
                            $amount = $_POST ["amount"];  
                            if (!preg_match ("/^[0-9]*$/", $amount) ){  
                                $ErrMsg = "Only numeric value is allowed.";  
                                echo $ErrMsg;  
                            } else {  
                                echo $amount;  
                            }  
                                    

                                    if(!isset($hasError)) {
                                        $emailTo = 'dev-email@flywheel.local';
                                        $subject = '[Contact Form] From '.$firstname .$lastname;
                                        $body = "First Name: $firstname \n LastName:$lastname \n Street Address: $Address \n City: $Cityname \n Pincode: $code \n Email: $email \n Phone number: $phonenumber \n Amount: $amount ";
                                        $headers = 'From: '.$firstname.$lastname.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;
                                
                                        wp_mail($emailTo, $subject, $body, $headers);
                                    }
                            
                                    if(!$hasError)
                                   $submittedSuccess = 'Thank you for contacting us!';
                                                        
    }
                     
    // validating variables

    $firstnameError = isset($firstnameError) ? $firstnameError : '';
    $lastnameError = isset($lastnameError) ? $lastnameError : '';
    $streetaddressError = isset($streetaddressError) ? $streetaddressError : '';
    $streetaddressError = isset($streetaddressError) ? $streetaddressError : '';
    $cityError = isset($cityError) ? $cityError : '';
    $pincodeError = isset($pincodeError) ? $pincodeError : '';
    $emailError = isset($emailError) ? $emailError : '';
    $phonenumberError = isset($phonenumberError) ? $phonenumberError : '';
    $amountError = isset($amountError) ? $amountError : '';
    $submittedSuccess = isset( $submittedSuccess) ?  $submittedSuccess : '';
    $content =  $submittedSuccess . '
     <form action="' . get_the_permalink() . '" id="contactForm" method="post">
        <div class="formGroup">
            <label for="FirstName:">First Name:</label>
            <input type="text" name="FirstName" id="FirstName">
            <span class="error"> ' . $firstnameError . '</span>
        </div>
        <div class="formGroup">
            <label for="LastName:">Last Name:</label>
            <input type="text" name="LastName" id="LastName">
            <span class="error"> ' . $lastnameError . '</span>
        </div>
        <div class="formGroup">
            <label for="Address">Street Address:</label>
            <input type="text" name="Address" id="Address">
            <span class="error"> ' . $streetaddressError . '</span>
        </div>
        <div class="formGroup">
            <label for="Adress"></label>
            <input type="text" name="Address" id="Address">
            <span class="error"> ' . $streetaddressError . '</span>
        </div>
        <div class="formGroup">
        <label for="Cityname">City:</label>
        <input type="text" name="Cityname" id="Cityname">
        <span class="error"> ' . $cityError . '</span>
    </div>
        <div class="formGroup">
        <label for="code">Pincode:</label>
        <input type="text" name="code" id="code">
        <span class="error"> ' . $pincodeError . '</span>
    </div>
    <div class="formGroup">
            <label for="email">Email:</label>
            <input type="text" name="email" id="email">
            <span class="error"> ' . $emailError . '</span>
        </div>
        <div class="formGroup">
        <label for="phonenumber">Phone number:</label>
        <input type="text" name="phonenumber" id="phonenumber">
        <span class="error"> ' . $phonenumberError . '</span>
    </div>
    <div class="formGroup">
        <label for="amount">Amount:</label>
        <input type="text" name="amount" id="amount">
        <span class="error"> ' . $amountError . '</span>
    </div>
    <input type="hidden" name="submitted" id="submitted" value="true" />
    <input type="submit" value="Submit" />


     </form>


    ';
    return $content;
}

 add_shortcode( 'register_contact_form', 'register_contact_form' );
