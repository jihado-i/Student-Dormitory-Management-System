<?php
    require_once("../includes/dbconn.php");
    if(!empty($_POST["emailid"])) {
        $email= $_POST["emailid"];
        if (filter_var($email, FILTER_VALIDATE_EMAIL)===false) {

            echo "Hata: Geçerli bir e-posta girmediniz.";
        } else {
            $result ="SELECT count(*) FROM userRegistration WHERE email=?";
            $stmt = $mysqli->prepare($result);
            $stmt->bind_param('s',$email);
            $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if($count>0){
    echo "<span style='color:red'> Bu e-posta zaten var! Yeni bir tane dene.</span>";
        } else {
            echo "<span style='color:green'> E-posta kayıt için kullanılabilir!!</span>";
        }
     }
    }

    if(!empty($_POST["oldpassword"])) {
    $pass=$_POST["oldpassword"];
    $pass=md5($pass);
    $result ="SELECT password FROM userregistration WHERE password=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('s',$pass);
    $stmt->execute();
    $stmt -> bind_result($result);
    $stmt -> fetch();
    $opass=$result;
    if($opass==$pass) 
    echo "<span style='color:green'> Parola eşleşiyor.</span>";
    else echo "<span style='color:red'>şifre eşleşmiyor!</span>";
    }


    if(!empty($_POST["roomno"])) {
    $roomno=$_POST["roomno"];
    $result ="SELECT count(*) FROM registration WHERE roomno=?";
    $stmt = $mysqli->prepare($result);
    $stmt->bind_param('i',$roomno);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();
    if($count>0)
    echo "<span style='color:red'>$count. Oda zaten dolu.</span>";
    else
        echo "<span style='color:red'>oda müsait</span>";
    }
?>