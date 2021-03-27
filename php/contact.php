<?php 

    $array = array("firstname" => "", "name" => "", "tel" => "", "email" => "", "sujet" => "", "message" => "", "firstnameError" => "", "nameError" => "", "telError" => "", "emailError" => "", "sujetError" => "", "messageError" => "", "isSuccess" => false);
        
        
    $emailTo = "contact@arnaudhuret.fr";


    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $array["firstname"] = verifyInput($_POST["firstname"]);
        $array["name"] =  verifyInput($_POST["name"]);
        $array["tel"] =  verifyInput($_POST["tel"]);
        $array["email"] =  verifyInput($_POST["email"]);
        $array["sujet"] =  verifyInput($_POST["sujet"]);
        $array["message"] =  verifyInput($_POST["message"]);
        $array["isSuccess"] = true ; 
        $emailText = "";
       
        
        if(empty($array["firstname"]))
        {
            $array["firstnameError"] = "Indiquez votre prénom ici";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Prénom: {$array["firstname"]}\n";
        }
            
         
        if( empty ($array["name"]))
        {
            $array["nameError"] = "Indiquez votre nom ici";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Nom: {$array["name"]}\n";
        }
        
        if(empty($array["tel"]))
        {
            $array["telError"] = "Indiquez votre numéro de téléphone ici";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Tel: {$array["tel"]}\n";
        }
        
        if(!isEmail($array["email"]))
        {
            $array["emailError"] = "Indiquez votre adresse email ici";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Email: {$array["email"]}\n";
        }
        
        if(empty($array["sujet"]))
        {
            $array["sujetError"] = "Indiquez le sujet de votre message";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Sujet: {$array["sujet"]}\n";
        }
        
        if(empty($array["message"]))
        {
            $array["messageError"] = "Ecrivez votre message ici";
            $array["isSuccess"] = false;
        }
        else
        {
            $emailText .= "Message: {$array["message"]}\n";
        }
        if($array["isSuccess"])
        {
            $headers = "from: {$array["firstname"]} {$array["name"]} <{$array["email"]}>\r\nReply-To: {$array["email"]}";
            mail($emailTo, "website : nouveau message", $emailText, $headers);
        }
        
        echo json_encode($array);
    }

    function isEmail($var)
    {
        return filter_var($var, FILTER_VALIDATE_EMAIL);
    }

    function verifyInput($var)
    {
        
        $var = trim($var);
        $var = stripslashes ($var);
        $var = htmlspecialchars ($var);
        return  $var ; 
    } 


?>