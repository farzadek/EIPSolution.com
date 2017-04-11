<?php
session_start();

function validate_phone( $phone_number ) {
    $formats = array(
        "/^([1]-)?[1-9]{1}[0-9]{6}$/i", // [1-]5555555555
        "/^([1]-)?[1-9]{3}-[0-9]{3}-[0-9]{4}$/i", // [1-]555-555-5555
        "/^([1]-)?[1-9]{3} [0-9]{3} [0-9]{4}$/i", // [1-]555 555 5555
        "/^([1]-)?\([1-9]{3}\)-[0-9]{3}-[0-9]{4}$/i", // [1-](555)-555-5555
        "/^([1]-)?\([1-9]{3}\) [0-9]{3}-[0-9]{4}$/i", // [1-](555)-555-5555
        "/^[1-9]{1}[0-9]{9}$/i" // 5555555555
        );
    foreach( $formats as $format ) {
        if( preg_match( $format, $phone_number ) ) return true;
    }
    return false; 
}

$errors = array();      
$data = array();      
$phone = $_POST['phone'];
$email = $_POST['email'];

// validate the variables ======================================================
if (!validate_phone($phone)){ $errors['name'] = 'Phone in correct format is required. '; }

include("connect.php");
$sql = "SELECT * from users WHERE email='$email'";
$result = mysql_query($sql, $user_con) or die(mysql_error());
$row = mysql_fetch_assoc($result);
if($row){$errors['name'] = 'This Email adress already registered!';}

// return a response ===========================================================
    if ( ! empty($errors)) {
        $data['success'] = false;
        $data['errors']  = $errors;
    } else {
        $prename = $_POST['prename'];
        $name = $_POST['name'].' '.$prename;
        $pass = $_POST['pass'];
        $email = $_POST['email'];

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
            $msg = '<html><head><title>Message from EIP.Solution</title></head><body><table><tr style="font-size:14px;">'.$prename.' '.$name.'</tr><tr style="font-size:14px;">'.$phone.'</tr><tr style="font-size:14px;">'.$email.'</tr></table>Enregsitre dans system EIP.SOLUTION</body></html>';
            mail('info@eipmondial.com','Email from Solution page - EIP website',$msg, $headers);

            $messageMail = '<html><head><title>Message from EIP.Solution</title></head><body><p style="font-size:16px">Vous avez enregistre dns le system EIP.Solution.</p><p style="font-size:12px">USERNAME: '.$email.'<br/>MOT DE PASSE: '.$pass.'</p></body></html>';
            mail($email,'EIP SOLUTION Inc. mail System',$messageMail, $headers);
           
        $ty = date("Y");
        $sql = "select count('id') as counts from users where YEAR(memberdate)=$ty"; 
        if (mysql_query($sql, $user_con)) {
            $result = mysql_query($sql, $user_con) or die(mysql_error());
            $r = mysql_fetch_assoc($result);
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysql_error($user_con);
        }
        $_SESSION['un'] = $email;
        $ty= $r['counts']+1;
        if($ty<10){$ty='00'.$ty;}elseif($ty<100 && $ty>9){$ty='0'.$ty;}
        $ty1='VP'.date("y").$ty;
        $sql = "INSERT INTO users (username, password, type, active, name_user, vpcode, email) 
                VALUES ('$email','$pass', 3, 1, '$name', '$ty1', '$email')";
        $result = mysql_query($sql, $user_con) or die(mysql_error());
        $sql = "INSERT INTO member (vpcode, name, famil, email, phone1, active) 
                VALUES ('$ty1','$prename','$name', '$email', '$phone',1)";
        $result = mysql_query($sql, $user_con) or die(mysql_error());

        $data['success'] = true;
        $data['message'] = 'Nous avons bien recu votre message!';
    }

echo json_encode($data);