<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modern Business - Start Bootstrap Template</title>



</head>

<body>
<?php
$parti_name = 'farzad';
$parti_tel = '5141234567';
$parti_email = 'sdfgh@wer.com';
$parti_famil = true;
$parti_dette = 500;
$parti_enfant = 1;
$parti_memo = 'jfgkfjg jsgjkngjkn jnsfgkjn ;jnsg;uohrayj nkjng kjgjn kjnfgjh jkng; jn;ghjgoi; huisgiuh';
?>

<h3>Formulaire Evaluation - Particulier</h3>
<div style="width:480px;border:1px solid black;color:#eee;background-color: #0897ea;">
    <p>Nom: <span style="color: black;"><?php echo $parti_name ?></span></p>
    <p>Tel: <span style="color: black;"><?php echo $parti_tel ?></span></p>
    <p>Courriel: <span style="color: black;"><? echo php $parti_email ?></span></p>
    <p>famil: <span style="color: black;"><?php echo $parti_famil ?></span></p>
    <p>Enfant: <span style="color: black;"><?php echo $parti_enfant ?></span></p>
    <p>Dette: <span style="color: black;"><?php echo $parti_dette ?></span></p>
    <p><span style="color: black;"><?php echo $parti_memo ?></span></p>
</div> 

</body>

</html>
