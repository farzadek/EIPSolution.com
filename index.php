<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>

	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="img/favicon.png">
	<!--[if IE]><link rel="SHORTCUT ICON" href="img/favicon.ico"/><![endif]-->
    <meta name="description" content="L'entreprise EIP.Solution vient directement en aide aux particuliers et aux entreprises. Elle propose une panoplie de services tels que le redressement de crédit, le financement et les prêts hypothécaires.">
    <link rel="alternate" hreflang="fr" href="http://eipsolution.com/" />
    <title>EIP Solution - Déclaration de revenus, Planification de budget, Redressement financier, Prêt hypothécaire</title>

    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="js/jquery.min.js"></script>

    <link rel="shortcut icon" href="http://eipmondial.com/mondial/img/icon32.png">

    <meta name="google-site-verification" content="" />
    <meta name="keyword" content="redressement de crédit, aide à l'obtention d'un prêt, dette, financement, service aux entreprises, service aux particuliers, prêts hypothécaires, planification de budget, prêt pour fond de roulement, redressement d'entreprises, service comptable, solution d'affaires">
    <meta name="msvalidate.01" content="" />
    <link rel="alternate" hreflang="fr" href="http://eipsolution.com" />
    <meta property="og:locale" content="fr-CA"/>
    <meta property="og:title" content="EIP.Solution" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.eipsolution.com" />
    <meta property="og:image" content="http://eipmondial.com/mondial/img/icon32.png" />
    <meta property="og:description" content="description" content="L'entreprise EIP.Solution vient directement en aide aux particuliers et aux entreprises. Elle propose une panoplie de services tels que le redressement de crédit, le financement et les prêts hypothécaires. EIP.Solution est la solution d'affaires." />

    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K4T8LD');</script>

</head>

<?php
include("php/connect.php");

$errPhone='';
$errName='';
$errEmail='';
$errMessage='';

$errRegPhone='';
$errRegName='';
$errRegMail='';
$errRegEmailFound = '';

$messageMail='';
$name='';
$message='';
$phone='';
$email='';
$mailErr = '';

$totalRow = 0;
$vpc = '';

$parti_name = '';
$parti_tel = '';
$parti_email = '';
$parti_famil = false;
$parti_dette = 0;
$parti_enfant = 0;
$parti_memo = '';
/*  particulier ------------------------------------------------------------------ */
if (isset($_POST["parti_submit"])) {
        $parti_name = trim($_POST['parti_name']);
        $parti_tel = trim($_POST['parti_tel']);
        $parti_email = trim($_POST['parti_email']);
        $parti_famil = $_POST['parti_famil'];
        $f ='';
        if($parti_famil==0){$f=' Célibtaire';}
        if($parti_famil==1){$f=' Conjoint de fait';}
        if($parti_famil==2){$f=' Marié';}
        if($parti_famil==3){$f=' Veuf/Veuve';}
        $parti_dette = $_POST['parti_dette'];
        $parti_enfant = $_POST['parti_enfant'];
        $parti_memo = trim($_POST['parti_memo']);
        $today = date(DATE_RFC822);

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$msg = '<html><head><title>Message from EIP.Solution</title></head><body><table style="width:400px; border:2px solid black;font-size:18px;"><tr style="background-color:#52ffed;"><p style="padding:0 5px;">Nom:<strong> '.$parti_name.'</strong></p></tr><tr><p style="padding:0 5px;">Tel: <strong>'.$parti_tel.'</strong></p></tr><tr style="background-color:#52ffed;"><p style="padding:0 5px;">Couriel: <strong>'.$parti_email.'</strong></p></tr><tr><p style="padding:0 5px;">Je suis: '.$f.'</p></tr><tr style="background-color:#52ffed;"><p style="padding:0 5px;">Dette: <strong>'.$parti_dette.'</strong>$</p></tr><tr><p style="padding:0 5px;">Enfants: <strong>'.$parti_enfant.'</strong></p></tr><tr style="background-color:#52ffed;font-size:14px;"><p style="padding:0 5px;">Message: <strong>'.$parti_memo.'</strong></p></table><p style="padding:0 5px;">'.$today.'</p></body></html>';

			mail('info@eipmondial.com','Email from Solution page - EIP website',$msg, $headers);
			$messageMailp = '<html><head><title>Message from EIP.Solution</title></head><body><h2>Mr./Mme. '.$parti_name.'</h2><p style="font-size:20px">Nous avons recu votre email.</p><p style="font-size:18px">un de nos spécialistes se fera un plaisir de vous contactez d’ici 48h.</p></body></html>';
			mail($parti_email,'EIP SOLUTION Inc. mail System',$messageMailp, $headers);
/*
		$sql = "INSERT INTO solutioncontactperson (name, tel, email, famil, dette, enfant, memo, today, img) VALUES ($parti_name, $parti_tel, $parti_email, $parti_famil, $parti_dette, $parti_enfant, $parti_memo, $today)";
		$result = mysql_query($sql, $user_con) or die(mysql_error());
		if (mysql_num_rows($result) > 0){ 
			$errRegEmailFound = 'This EMAIL already has account!';
		}*/
}

/*  entreprise ------------------------------------------------------------------ */
if (isset($_POST["entreprise_submit"])) {
        $entreprise_name = trim($_POST['entreprise_name']);
        $entreprise_tel = trim($_POST['entreprise_tel']);
        $entreprise_email = trim($_POST['entreprise_courriel']);
        $entreprise_nominc = $_POST['entreprise_nominc'];
        $f = $POST['entreprise_autonome'];
        if($f==0){$e=' Travailleur autonome';}else{$e=' Incorporée';}
        $f = $POST['entreprise_autonome'];
        $entreprise_activity = $_POST['entreprise_activity'];
        $entreprise_solde1 = $POST['entreprise_solde1'];
        $entreprise_solde2 = $POST['entreprise_solde2'];
        $entreprise_retard = $POST['entreprise_retard'];
        $entreprise_annuel= $POST['entreprise_annuel'];
        $entreprise_employe= $POST['entreprise_employe'];
        $entreprise_hypotheque= $POST['entreprise_hypotheque']; 
        //$entreprise_pretvehic= $POST['entreprise_pretvehic'];   
        //$entreprise_margepret= $POST['entreprise_margepret'];
        $entreprise_memo = trim($_POST['entreprise_memo']); 
        $today = date(DATE_RFC822);

			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$msg = '<html><head><title>Message from EIP.Solution</title></head><body>
			<table style="width:400px; border:2px solid black;font-size:16px;">
				<tr style="background-color:#a1bcf7;"><p>Nom:<strong> '.$entreprise_name.'</strong></p></tr>
				<tr><p>Nom d\'entreprise:<strong> '.$entreprise_nominc.'</strong></p></tr>
				<tr style="background-color:#a1bcf7;"><p>Tel: <strong>'.$entreprise_tel.'</strong></p></tr>
				<tr><p>Couriel: <strong>'.$entreprise_email.'</strong></p></tr>
				<tr style="background-color:#a1bcf7;"><p>Type d\'entreprise: '.$e.'</p></tr>
				<tr><p>Secteur d\'activité: <strong>'.$entreprise_activity.'</strong></p></tr>
				<tr style="background-color:#a1bcf7;"><p>Solde de carte de cr&eacute;dit: <strong>'.$entreprise_solde1.'</strong>$</p></tr>
				<tr><p>Solde de la marge cr&eacute;dit <strong>'.$entreprise_solde2.'</strong>$</p></tr>
				<tr style="background-color:#a1bcf7;"><p>Retard sur les dettes gouvernementales: <strong>'.$entreprise_retard.'</strong></p></tr>
				<tr><p>Chiffre d\'affaires annuel approximatif: <strong>'.$entreprise_annuel.'</strong>$</p></tr>
				<tr style="background-color:#a1bcf7;"><p>Nombre d\'employés: <strong>'.$entreprise_employe.'</strong></p></tr>
				<tr><p>Loyer ou hypoth&egrave;que mensuel: <strong>'.$entreprise_hypotheque.'</strong></p></tr>
				<tr style="background-color:#a1bcf7;"><p>Paiment d\'un pr&ecirc;t v&eacute;hicule: <strong>'.$entreprise_pretvehic.'</strong></p></tr>
				<tr><p>Paiment d\'une m&eacute;rge de cr&eacute;dit: <strong>'.$entreprise_margepret.'</strong></p></tr>
				<tr style="background-color:#a1bcf7;"font-size:14px;"><p style="padding:0 5px;">Message: <strong>'.$entreprise_memo.'</strong></p></tr>
				</table><p style="padding:0 3px;">'.$today.'</p></body></html>';


			mail('info@eipmondial.com','Email from Solution page - EIP website',$msg, $headers);
			$messageMailp = '<html><head><title>Message from EIP.Solution</title></head><body><h2>Mr./Mme. '.$entreprise_name.'</h2><p style="font-size:20px">Nous avons recu votre email.</p><p style="font-size:18px">un de nos spécialistes se fera un plaisir de vous contactez d’ici 48h.</p></body></html>';
			mail($entreprise_email,'EIP SOLUTION Inc. mail System',$messageMailp, $headers);
/*
		$sql = "INSERT INTO solutioncontactcompany (name, tel, email, companytype, secteur, yearaffair, loan, employeeno, payvehiculeyear, ,argecredit, soldecredit, soldemargecredit, memo, img, today) VALUES ($parti_name, $parti_tel, $parti_email, $parti_famil, $parti_dette, $parti_enfant, $parti_memo, $today)";
		$result = mysql_query($sql, $user_con) or die(mysql_error());
		if (mysql_num_rows($result) > 0){ 
			$errRegEmailFound = 'This EMAIL already has account!';
		}



		*/
}

/*  ----------------------------------------------------------------------------- */

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

    if (isset($_POST["submitMailReg"])) {
        $reg_name = htmlspecialchars(trim($_POST['reg_name']));
        $reg_email = htmlspecialchars(trim($_POST['reg_email']));
        $reg_phone = htmlspecialchars(trim($_POST['reg_phone']));
		$reg_phone_correct = validate_phone($reg_phone) ? $reg_phone : '';
		$errRegPhone = $reg_phone_correct ? '' : "No. de t&eacute;l&eacute;phone n'est pas correct";
		
		if(!$errRegPhone){
			$sql = "SELECT * FROM users where email='$reg_email'";
			$result = mysql_query($sql, $user_con) or die(mysql_error());
			if (mysql_num_rows($result) > 0){ 
				$errRegEmailFound = 'This EMAIL already has account!';
			}
		}	
		if(!$errRegPhone && !$errRegEmailFound){
			$sql = "SELECT 'id' FROM users";
			$result = mysql_query($sql, $user_con) or die(mysql_error());	
			$totalRow = 'guest'.mysql_num_rows($result); 
			
			$sql = "SELECT 'id' FROM users where type=3";
			$result = mysql_query($sql, $user_con) or die(mysql_error());	
			$vpc = 'GUEST'.date("y").(mysql_num_rows($result)+1); 

			$src = array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9');
			$random_keys=array_rand($src,6);
			$psw = 'gs'.$src[$random_keys[0]].$src[$random_keys[1]].$src[$random_keys[2]].$src[$random_keys[4]].$src[$random_keys[5]];

			$sql = "INSERT INTO users (username, password, type, active, name, vpcode, email) VALUES ('$totalRow','$psw',3, 1,'$reg_name','$vpc','$reg_email')";
			$result = mysql_query($sql, $user_con) or die(mysql_error());	

			$headers = "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html;\r\n";

			//$totalRow='guest1';

			$msg = 'Nous avions un(e) visiteur qui enregistre sur notre system.<br/>NAME: '.$reg_name;
			$msg.='<br/>PHONE: ';
			$msg.=$reg_phone;
			$msg.='<br/>EMAIL: ';
			$msg.=$reg_email;
			$msg.='<br/><img src="http://eipsolution.com/img/logo.png" width="180">';
			mail('info@eipmondial.com','EIP.Solution website - Register',$msg, $headers);

			$messageMail = '<html lang="fr"><head><link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" type="text/css"><link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"></head><body style="font-family:Roboto;font-size:18px;"><p>Bonjour Monsieur/Madam '.$reg_name.'</p>Nous avons recu votre email.';
			$messageMail .= '<br/>';
			$messageMail .= 'Un(e) de nos sp&eacute;cialistes se fera un plaisir de vous contactez d\'ici 48h.';
			$messageMail .= '<br/>';
			$messageMail .= '<p style="font-size:16px;line-height:14px;font-family:Roboto;padding: 10px 0;">Vous pouvez consulter de notre service temporairement</p><p>USERNAME: <strong>'.$totalRow.'</strong><br/>PASSWORD: <strong>'.$psw.'</strong></p>';
			$messageMail .= '<a href="http://eipmondial.com/mondial/php/login.php"><i class="fa fa-external-link-square" aria-hidden="true"></i> Cliquez ici</a></p><p>EIP.Solution Inc.';
			$messageMail .= '<br/><img src="http://eipsolution.com/img/logo.png" width="180"></p>'.'</html></body>';

			mail($reg_email,'EIP SOLUTION Inc. mail System',$messageMail, $headers);
			$errRegPhone = '';
		}
	}	


    if (isset($_POST["submitMail"])) {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = trim($_POST['email']);
        $phone = htmlspecialchars(trim($_POST['phone']));
        $message = htmlspecialchars(trim($_POST['message']));
		$phone = validate_phone($phone) ? $phone : '';
		$errPhone = $phone ? '' : "No. de t&eacute;l&eacute;phone n'est pas correct";
		
		if(!$errPhone){
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
			$msg = '<html><head><title>Message from EIP.Solution</title></head><body><table><tr style="font-size:14px;">'.$name.'</tr><tr style="font-size:14px;">'.$phone.'</tr><tr style="font-size:14px;">'.$email.'</tr><tr style="font-size:14px;">'.$message.'</tr></table></body></html>';
			//mail('info@eipmondial.com','Email from Solution page - EIP website',$msg, $headers);
			mail('info@eipmondial.com','Email from Solution page - EIP website',$msg, $headers);

			$messageMail = '<html><head><title>Message from EIP.Solution</title></head><body><p style="font-size:20px">Nous avons recu votre email.</p><p style="font-size:18px">un de nos spécialistes se fera un plaisir de vous contactez d’ici 48h.</p></body></html>';
			mail($email,'EIP SOLUTION Inc. mail System',$messageMail, $headers);
			$errPhone = FALSE;
		}
	}	

?>


<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-86959155-1', 'auto');
  ga('send', 'pageview');
</script>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K4T8LD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#solution-navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php"><img class="logo" alt="eipsolution logo" src="img/logo2.png"></a>
            </div>
            <div class="collapse navbar-collapse" id="solution-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="#bundles">Start-up</a>
                    </li>
                    <li>
                        <a href="#services">Nos Services</a>
                    </li>
                    <li>
                        <a href="#contactForm">Nous Joindre</a>
                    </li>
                    <li>
                        <a id="login" href="http://eipmondial.com/mondial/php/login.php">Login</a>  
                    </li>
                    <li>
                        <a id="register" style="cursor: pointer;">S'inscrire</a>  
                    </li>
                </ul>
            </div>
            
        </div>
        
    </nav>



<div id="regsiter_window">
	<div>
		<h3>s'inscrire</h3>

	<form class="form-horizontal" role="form" method="post" id="form_registre" action="php/registre.php">
		<div class="form-group">
			<label for="prename_registre" class="col-sm-2 control-label">Prénom</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="prename_registre" name="prename_registre" required="required">
			</div>
			<label for="name_registre" class="col-sm-2 control-label">Nom</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="name_registre" name="name_registre" placeholder="Nom" required="required" value="">
			</div>
		</div>
	 	<div class="form-group">
			<label for="email_registre" class="col-sm-4 control-label">Adresse courriel</label>
			<div class="col-sm-8">
				<input type="email" class="form-control" id="email_registre" name="email_registre" required="required" placeholder="example@domain.com" value="">
			</div>
		</div>
		<div class="form-group">
			<label for="phone_registre" class="col-sm-4 control-label">Numéro de téléphone</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="phone_registre" name="phone_registre" required="required" placeholder="XXX XXX XXXX" value="">
			</div>
		</div>
		<div class="form-group">
			<label for="message_registre" class="col-sm-4 control-label">Mot de passe</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="pass_registre" name="pass_registre" value="" required="required" minlength="5">
			</div>
		</div>
		<p id="err_registre" style="margin-left: 5px;font-size: 1.2em;">&nbsp;</p>
		<div class="form-group">
			<div class="col-sm-3 col-sm-offset-3 col-xs-5 col-xs-offset-1">
				<input name="submit_registre" type="submit" value="S'Inscrire" class="btn btn-xs">
			</div>
			<div class="col-sm-3 col-xs-5">
				<input id="cancelRegistre" type="button" value="Annuler" class="btn btn-xs">
			</div>
		</div>
	</form> 
	</div>
</div>

<div class="topTitle" id="topTitle">
	<h1>&Eacute;valuation gratuite</h1>
</div>  

<div class="evalTumbs">
	<div class="container">
		<div class="row">
			<div class="col-lg-1 col-sm-1 col-md-1"></div>
			<div class="col-lg-10 col-sm-10 col-md-10 col-xs-12">
				<p style="text-align: center;">Vous êtes un particulier ou une entreprise? Notre équipe multidisciplinaire se fera un plaisir de mettre à votre disposition toutes les outils et les solutions nécessaires pour un retour à l’équilibre financier. L’atteinte de vos objectifs est notre priorité.</p>
			</div>	
		</div>
		<div class="row">
			<div class="col-lg-1 col-md-1"></div>
			<div class="buttonMain col-lg-4 col-md-4 col-sm-4 col-xs-6" id="btn1">
				<div class="carddiv">
					<div class="frontofcard">
						<p>Je suis un particulier</p>
						<img src="img/man21.png" alt="eipsolution financier">
						<img src="img/line1.png" alt="eipsolution contract">
					</div>
					<div class="backofcard">Faites les premieres pas.<br/>On vous prend en main!</div>
				</div>
			</div>

			<div class="col-lg-2 col-md-2 col-sm-3 adv">
				<div id="adv">
					<ul id="slider2">
						<li class="radvert1">Ne<br/>payez pas<br/>maintenant!</li>
						<li class="radvert2">On<br/>vous<br/>aide<br/>à réussir</li>
						<li class="radvert3"><span id="refer">Référer c'est gratuit et c'est payant, <span>cliquez dès maintenant</span></span></li>
					</ul>
				</div>  	
			</div>
				
			<div class="buttonMain col-lg-4 col-md-4 col-sm-4 col-xs-6" id="btn2">
				<div class="carddiv">
					<div class="frontofcard">
						<p>Je suis une entreprise</p>
						<img src="img/man11.png" alt="eipsolution client">
						<img src="img/line1.png" alt="separator line">
					</div>
					<div class="backofcard">Faites les premieres pas.<br/>On vous prend en main!</div>
				</div>
			</div>
			<div class="col-lg-1 col-md-1"></div>
		</div>
	</div>

<div class="container" id="particulier_form">
	<form class="form-horizontal" role="form" method="post" action="index.php#evalTumbs">
	<div class="row">
		<h4>Vos Informations</h4>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="reg_name" name="parti_name" placeholder="Nom" required="required" value="<?php //if($errRegPhone || $errRegMail){//echo $reg_name;} ?>">
				</div>
			</div>
		</div>	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text"  required="required" class="form-control" id="reg_phone" name="parti_tel" placeholder="T&eacute;l&eacute;phone" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="email" class="form-control" id="reg_email" name="parti_email" placeholder="Courriel" required="required" value="<?php //if($errRegPhone || $errRegMail){//echo $reg_email;} ?>">
				</div>
			</div>
		</div>

	</div>
	
	<div class="row">	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h4>Situation familiale</h4>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<div class="radio"><label><input type="radio" name="parti_famil">Célibataire</label></div>
					<div class="radio"><label><input type="radio" name="parti_famil">Conjoint de fait</label></div>			
					<div class="radio"><label><input type="radio" name="parti_famil" checked="checked">Marié</label></div>
					<div class="radio"><label><input type="radio" name="parti_famil">Veuf/Veuve</label></div>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="number" class="form-control" id="reg_enfant" name="parti_enfant" placeholder="Nombre d'enfants &agrave; charge" min="0" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
		</div>	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h4>Situation financière</h4>
			<p>Inscrire le montant total de vos dettes incluant vos cartes de cr&eacute;dit, marges de cr&eacute;dit, pr&ecirc;ts personnel, pr&ecirc;ts automobile, dette gouvernementale ou autres. Ne pas inclure votre pr&ecirc;t hypoth&eacute;caire.</p>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="reg_dette" name="parti_dette" placeholder="Montant total de vos dettes" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
		</div>	
	</div>

	<div class="row">	
		<div class="form-group pad15">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<span>Inscrire toutes autres Informations pertinentes sur votre situation financi&egrave;re (épargne et placements, régimes enregistrés, valeurs immobilières, autres valeurs)</span>
				<textarea class="form-control" id="reg_memo" name="parti_memo"></textarea>
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
			</div>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-4 col-sm-offset-4">
			<input id="submitMailReg" name="parti_submit" type="submit" value="Soumettre" class="btn btn-primary">
		</div>
		<?php //if($errRegEmailFound) {//echo "<p class='text-danger' style='font-size:1.1em;'>".$errRegEmailFound."</p>";}?>
	</div>		
</form>
</div>

<div class="container" id="entreprise_form">
	<form class="form-horizontal" role="form" method="post" action="index.php#evalTumbs">
	<div class="row">
		<h4>Vos Informations</h4>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="reg_name" name="entreprise_name" placeholder="Votre nom" required="required" value="<?php //if($errRegPhone || $errRegMail){//echo $reg_name;} ?>">
				</div>
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" required="required" class="form-control" id="entreprise_nominc" name="entreprise_nominc" placeholder="Nom de l'entreprise" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 15px;">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="reg_tel" name="entreprise_tel" placeholder="T&eacute;l&eacute;phone" value="<?php //if($errRegPhone || $errRegMail){//echo $reg_name;} ?>">
				</div>
			</div>
		</div>	

		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="entreprise_courriel" name="entreprise_courriel" placeholder="Courriel" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row">	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h4 style="padding-top: 20px;">Type d'entreprise</h4>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="form-group">
					<div class="radio"><label><input type="radio" name="entreprise_autonome" checked="checked">Travailleur autonome</label></div>
					<div class="radio"><label><input type="radio" name="entreprise_autonome">Incorpor&eacute;e</label></div>			
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="entreprise_activity" name="entreprise_activity" placeholder="Secteur d'activit&eacute;" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
			<h4 style="margin-top: 10px;">Dettes</h4>
					<input type="number" class="form-control" id="entreprise_solde1" name="entreprise_solde1" placeholder="Solde de carte de cr&eacute;dit" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
					<input type="text" class="form-control" id="entreprise_solde2" name="entreprise_solde2" placeholder="Solde de la marge cr&eacute;dit" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
					<input type="text" class="form-control" id="entreprise_retard" name="entreprise_retard" placeholder="Retard sur les dettes gouvernementales" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
		</div>	
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h4 style="padding-top: 20px;">Informations financi&egrave;re</h4>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<input type="text" class="form-control" id="reg_dette" name="entreprise_annuel" placeholder="Chiffre d'affaires annuel approximatif" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
					<input type="text" class="form-control" id="reg_dette" name="entreprise_employe" placeholder="Nombre d'employ&eacute;s" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
					<input type="text" class="form-control" id="reg_dette" name="entreprise_hypotheque" placeholder="Loyer ou hypoth&egrave;que mensuel" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
					<input type="text" class="form-control" id="reg_dette" name="entreprise_pretvehic" placeholder="Paiment d'un pr&ecirc;t v&eacute;hicule" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
			<div class="form-group">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top: 15px;">
					<input type="text" class="form-control" id="reg_dette" name="entreprise_margepret" placeholder="Paiment d'une marge de cr&eacute;dit" value="<?php //if($errRegPhone){//echo '';}?>">
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
				</div>
			</div>
		</div>	
	</div>

	<div class="row">	
		<div class="form-group" style="padding: 15px;">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<span>Autres Informations pertinentes &agrave; votre situation</span>
				<textarea class="form-control" id="reg_memo" name="entreprise_memo"></textarea>
							<?php //if($errRegPhone) {//echo "<p class='text-danger' style='font-size:1.1em;'>$errRegPhone</p>";}?>
			</div>
		</div>
	</div>
	
	<div class="form-group" style="margin-top: 15px;">
		<div class="col-sm-4 col-sm-offset-4">
			<input id="submitMailReg" name="entreprise_submit" type="submit" value="Soumettre" class="btn btn-primary">
		</div>
		<?php //if($errRegEmailFound) {//echo "<p class='text-danger' style='font-size:1.1em;'>".$errRegEmailFound."</p>";}?>
	</div>		
	</form>
</div>

<div class="services container" id="services">

	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 servicesDiv1">
			<h4>Services aux particuliers</h4>
			<p>Chaque personne possède sa propre situation financière. C’est pourquoi nous privilégions un service personnalisé à l’aide de recommandations simples, pratiques, mais surtout efficace. Les experts d’EIP Solution vous accompagneront dans l’évaluation de votre situation actuelle. L’équipe vous aidera à définir les nouveaux objectifs de santé financière et à les réaliser. Nous offrons les services suivants à nos clients :
			</p>
			<p>
				<li style="color: #3aa244;"><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Déclaration de revenus</li>
				<li><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Planification de budget</li>
				<li style="color: #528bd8;"><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Redressement financier</li>
				<li><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Prêt hypothécaire</li>
			</p>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 servicesDiv11">
			<img src="img/services4.jpg" alt="financial service">
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
	</div>

	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 servicesDiv2">
			<img src="img/services5.jpg" alt="service clientele" style="margin-top: 15px;">
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 servicesDiv21">
			<h4>Services aux entreprises</h4>
			<p>Chaque entreprise dispose d’une situation financière qui lui est propre. C’est pourquoi EIP Solution privilégie un service personnalisé à l’aide de nos experts qui vous accompagneront dans l’évaluation de votre situation actuelle. L’équipe vous aidera à définir de nouveaux objectifs individuels de santé financière et à les réaliser à l’aide de recommandations simples, pratiques, mais surtout efficaces. Les services suivants sont offerts à chacun de nos clients :
			</p>
			<div id="login1" class="col-lg-6 col-md-6 col-sm-6">
				<div class="radio-startup">
					<ul>
						<li style="height: 55px;">
					    <input type="radio" id="bdl1" name="selector">
					    <label for="bdl1">Démarrage d’entreprise<span style="font-size:.7em;display: block;">(1 &agrave; 4 employés)</span></label>  
					    <div class="check"></div>
					  	</li>			
					</ul>	
				</div>
				<div id="list1" style="position:relative;background-color: #eee; padding: 0 5px;">
					<p class="etape1">&Eacute;tape 1</p>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 15px;"></i>
						<span class="check-title">Évaluation de projet</span>
						<span id="itm11"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm11">Rencontre avec l'équipe de EIP Solution afin de bien saisir votre projet d'entreprenariat.</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Évaluation de projet</span>
						<span id="itm11"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm11">Rencontre avec l'équipe de EIP Solution afin de bien saisir votre projet d'entreprenariat.</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Solution d’affaires</span>
						<span id="itm12"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm12">Création d'un rapport avec des recommandations. Explications détaillées sur l'approche idéale pour réussir votre projet.</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Développement et mise en papier</span>
						<span id="itm13"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm13">- plan de création<br/>- stratégie<br/>- plan d'affaires<br/>- gestion légale</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Préparation, formation et aide au financement</span>
						<span id="itm14"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm14">Formation pour que vous puissiez démarrer votre projet</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Infographie d’entreprise</span>
						<span id="itm15"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm15">Création de votre image d'entreprise</p>
					</div>
					<p class="etape1">&Eacute;tape 2</p>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title" style="font-size: 20px;">Création d’articles promotionnels</span>
						<span id="itm16"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm16">Carte d'affaires, article publicitaire de tout genre</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Site web</span>
						<span id="itm17"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm17">Création de votre Site Web personnalisé pour votre entreprise</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Ouverture de ligne I.P 1-888</span>
						<span id="itm18"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm18">Offre d'une ligne 1-888 chez nous, sans frais pour les six prochains mois</p>
					</div>
					<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
						<span class="check-title">Mise en marché</span>
						<span id="itm19"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
						<p id="p_itm19">Mise en action puisque vous êtes prêt à rentrer en affaire</p>
					</div> 
				</div>
			</div>			
			<div id="login2" class="col-lg-6 col-md-6 col-sm-6">
				<div class="radio-startup">
					<ul>
						<li style="height: 55px;">
					    <input type="radio" id="bdl2" name="selector">
					    <label for="bdl2">Démarrage d’entreprise<span style="font-size:.7em;display: block;">(1 &agrave; 4 employés)</span></label>  
					    <div class="check"></div>
					  	</li>			
					</ul>	
				</div>
				<div id="list2" style="position:relative;background-color: #eee; padding: 0 5px;">
						<p class="etape1">&Eacute;tape 1</p>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Évaluation de projet</span>
							<span id="itm11"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm11">Rencontre avec l'équipe de EIP Solution afin de bien saisir votre projet d'entreprenariat.</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Solution d’affaires</span>
							<span id="itm12"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm12">Création d'un rapport avec des recommandations. Explications détaillées sur l'approche idéale pour réussir votre projet.
							</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title" style="font-size: 20px;">Développement et mise en papier</span>
							<span id="itm13"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm13">plan de création, stratégie, plan d'affaires, gestion légale.</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Préparation, formation et aide au financement</span>
							<span id="itm14"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm14">Formation pour que vous puissiez démarrer votre projetInfographie d’entreprise.</p>
						</div>
						<p class="etape1"> &Eacute;tape 2</p>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title" style="font-size: 20px;">Création d’articles promotionnels</span>
							<span id="itm16"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm16">Carte d'affaires, article publicitaire de tout genre.</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Site web</span>
							<span id="itm17"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm17">Création de votre Site Web personnalisé pour votre entreprise.</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Ouverture de ligne I.P 1-888</span>
							<span id="itm18"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm18">Offre d'une ligne 1-888 chez nous, sans frais pour les six prochains mois.</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Système de gestion</span>
							<span id="itm19"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm19">Gestion de dossier avec accès direct pour votre service client ou employé (12 mois)</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Mise en marché</span>
							<span id="itm19"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>
							<p id="p_itm19">Mise en action puisque vous êtes prêt à rentrer en affaire.</p>
						</div>
						<div style="margin-bottom:8px;"><i class="fa fa-check-square" aria-hidden="true" style="font-size: 18px;"></i>
							<span class="check-title">Vidéo promotionnelle</span>
						</div>
				</div>
			</div>			
		</div>
	</div>

	<div class="row" style="margin-top:10px; margin-bottom: 10px;">
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-1"></div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-10"><a href="http://www.eipmondial.com" target="_black"><img src="img/logo_eip1.jpg" alt="eipmondial logo" style="width:100%;"></a></div>
		<div class="col-lg-4 col-sm-4 col-md-4 col-xs-1"></div>
	</div>

	<div class="row">
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 servicesDiv3">
			<h4>Financement d’entreprise</h4>
			<p>Les petites et les moyennes entreprises représentent la grande majorité des entreprises québécoises. Malheureusement, celles-ci ne sont pas le principal créneau des institutions financières. Les banques et les caisses aident de moins en moins ce type d’entreprise.
	La difficulté d’obtenir du crédit pour beaucoup d’entreprises en croissance diminue drastiquement les liquidités pour financer leurs activités. Les entreprises éprouvent donc de la difficulté à se maintenir la tête hors de l’eau et à grossir davantage. C’est pourquoi nous offrons à nos clients ces types prêts :
			</p>
			<p>
				<li style="color: #3aa244;"><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Prêt pour fond de roulement</li>
				<li style="color: orange;"><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Marge de crédit commercial</li>
				<li style="color: #528bd8;"><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Prêts hypothécaires</li>
				<li style="color: #42dca3;"><i class="fa fa-check-square-o" aria-hidden="true" style="color: black;"></i> Services-conseils en financement commercial</li>
			</p>
		</div>
		<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 servicesDiv31">
			<img src="img/services6.jpg" alt="client satisfaction">
		</div>
		<div class="col-lg-1 col-md-1 col-sm-1"></div>
	</div>


</div>

<!--
<div class="sloganDiv">
	<div class="container">
		<div class="col-lg-1 col-sm-1 col-md-1"></div>
		<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
			<img src="img/slide2.jpg" alt="eipsolution slogan">
		</div>
	</div>
</div>
-->

<section id="bundles" class="gpm">
    <div class="container">
		<div class="row">
		</div>			


		<div class="footMenu">
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<h4><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Services aux particuliers</h4>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Déclaration de revenus personnelle</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Conseils en redressement financier</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Négociation avec vos créations</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Prêts hypothécaires</li>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<h4><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> Services aux entreprises</h4>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Comptabilité et tenue de livres</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Redressement d’entreprise</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Financement d’entreprise</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Déclaration de revenus et états financiers</li>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
					<h4><i class="fa fa-chevron-circle-right" aria-hidden="true"></i> EIP Solution</h4>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Service comptable</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Redressement</li>
					<li><i class="fa fa-caret-square-o-right" aria-hidden="true"></i> Financement</li>
				</div>
		</div>		


		<div class="buttonMain1">
			<div class="carddiv1">
				<div class="frontofcard1">
					<p>Besoin d’aide? Venez nous rencontrer et l’on s’occupe du reste!</p>
				</div>
				<div class="backofcard1">
					<div class="backofcard1inside">
						<span1>On vous prend en main!</span1>
						<img src="img/backflip1.jpg" alt="customer satisfaction">
					</div>
				</div>
			</div>		
		</div>

        </div>

</section>



<section id="contactForm" class="content-section text-center">
	<div id="joindre">
		<h1>NOUS JOINDRE</h1>
	</div>
	<form class="form-horizontal" role="form" method="post" action="index.php#contactForm">
		<div class="row contact1">
	        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-1 col-md-offset-1 col-sm-offset-1">
				<div class="form-group">
					<label for="name" class="col-sm-4 control-label contact_label">Nom</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php if($mailErr == 'y'){echo $name;} ?>"><?php if($mailErr == 'y') {echo "<span class='text-danger' style='font-size:.9em;'>$errName</span>";}?>
					</div>
				</div>
	 			<div class="form-group">
					<label for="email" class="col-sm-4 control-label">Adresse courriel</label>
					<div class="col-sm-8">
						<input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?php if($mailErr == 'y'){echo $email;} ?>">
							<?php if($mailErr == 'y'){echo "<span class='text-danger' style='font-size:.9em;'>$errEmail</span>";}?>
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-4 control-label">Numéro de téléphone</label>
					<div class="col-sm-8">
							<input type="text" class="form-control" id="phone" name="phone" autocomplete="off"> placeholder="000 000 0000" value="<?php if($mailErr == 'y'){echo $phone;}?>">
								<?php if($mailErr == 'y') {echo "<span class='text-danger' style='font-size:.9em;'>$errPhone</span>";}?>
					</div>
				</div>
				<div class="form-group">
					<label for="message" class="col-sm-4 control-label">Message</label>
					<div class="col-sm-8">
						<textarea class="form-control" rows="4" name="message"><?php if($mailErr == 'y'){echo $message;}?></textarea>
								<?php if($mailErr == 'y') {echo "<span class='text-danger' style='font-size:.9em;'>$errMessage</span>";}?>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-6 col-sm-offset-3" style="padding: 0 10%;">
						<input id="submitMail" name="submitMail" type="submit" value="Envoyer le mail" class="btn btn-primary">
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-10 col-sm-offset-2 contact_message">
						<?php if($mailErr == 'n'){echo $messageMail;} ?>    
					</div>
				</div>
	        </div>
			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<a href="tel:-18883688949" class="phone"><span><i class="fa fa-phone-square"></i> T&eacute;l&eacute;phone : </span>514-461-3475</a>
				<a href="https://www.facebook.com/eip-mondial-inc-1704373986486308/?ref=hl" target="_blank" class="btn btn-default btn-lg facebook"><i class="fa fa-facebook fa-fw"></i> <span class="network-name">Facebook</span></a>
				<div class="whour">
					<h3>Horaire de travail</h3>
					<table>
						<tr><td>Lundi -</td><td>10h à 17h</td></tr>
						<tr><td>Mardi -</td><td>10h à 17h</td></tr>
						<tr><td>Mercredi - </td><td>10h à 17h</td></tr>
						<tr><td>Jeudi - </td><td>10h à 17h</td></tr>
						<tr><td>Vendredi - </td><td>10h à 15h</td></tr>
					</table>
				</div>
			</div>
		</div>
	</form> 
</section>


<footer>
    <img src="img/logo1.png" alt="eipsolution logo" height="50"> Copyright <sup>&copy;</sup> E.I.P Solution 2001
    <a href="php/politic.html" target="_blank">Politique de Confidentialit&eacute;</a>
</footer>

    </div>

<script src="js/bootstrap.min.js"></script>
<link href="css/solution.css" rel="stylesheet">

<script>
$(function () {

    $('#particulier_form').hide();
    $('#entreprise_form').hide();
    $('#list1').hide();
    $('#list2').hide();
	$('#regsiter_window').hide();
          // Slideshow 1
    /*  $("#slider1").responsiveSlides({
        maxwidth: 800,
        speed: 3800
      }); */
    $("#login").click(function(){
    	<?php $_SESSION['place']='sut';?>
    });  

    $("span[id^='itm']").click(function () {
        if ($(this).next().is(':visible')) {
            $(this).next().css("visibility:hidden");
            $(this).next().slideUp(400);
            $(this).html('<i class="fa fa-plus-square-o" aria-hidden="true"></i>');
        }
        else {
            $(this).next().css("visibility:visible");
            $(this).next().slideDown(400);
            $(this).html('<i class="fa fa-minus-square-o" aria-hidden="true"></i>');
        }
    });

    $(".check-title").click(function () {
        if ($(this).next().next().is(':visible')) {
            $(this).next().next().css("visibility:hidden");
            $(this).next().next().slideUp(400);
            $(this).next().html('<i class="fa fa-plus-square-o" aria-hidden="true"></i>');
        }
        else {
            $(this).next().next().css("visibility:visible");
            $(this).next().next().slideDown(400);
            $(this).next().html('<i class="fa fa-minus-square-o" aria-hidden="true"></i>');
        }
    });

    $("#bdl1").click(function () {
        if ($('#list1').is(':visible')) {
            $('#list1').css("visibility:hidden");
            $('#list1').slideUp(400);
            $('#list1').css("display:none");
        }
        else {
            $('#list1').css("display:block");
            $('#list1').css("visibility:visible");
            $('#list1').slideDown(400);
        }
        if ($('#list2').is(':visible')) {
            $('#list2').css("visibility:hidden");
            $('#list2').slideUp(400);
            $('#list2').css("display:none");
        }
    });

    $("#bdl2").click(function () {
        if ($('#list2').is(':visible')) {
            $('#list2').css("visibility:hidden");
            $('#list2').slideUp(400);
            $('#list2').css("display:none");
        }
        else {
            $('#list2').css("display:block");
            $('#list2').css("visibility:visible");
            $('#list2').slideDown(400);
        }
        if ($('#list1').is(':visible')) {
            $('#list1').css("visibility:hidden");
            $('#list1').slideUp(400);
            $('#list1').css("display:none");
        }
    });

    $("#btn1").click(function () {
        if ($('#particulier_form').is(':visible')) {
            $('#particulier_form').css("visibility:hidden");
            $('#particulier_form').slideUp(400);
            $('#particulier_form').css("display:none");
        }
        else {
            $('#particulier_form').css("display:block");
            $('#particulier_form').css("visibility:visible");
            $('#particulier_form').slideDown(400);
            $(document.body).scrollTop($('#particulier_form').offset().top-50);
        }
        if ($('#entreprise_form').is(':visible')) {
            $('#entreprise_form').css("visibility:hidden");
            $('#entreprise_form').slideUp(400);
            $('#entreprise_form').css("display:none");
        }
    });


    $("#btn2").click(function () {
        if ($('#entreprise_form').is(':visible')) {
            $('#entreprise_form').css("visibility:hidden");
            $('#entreprise_form').slideUp(400);
            $('#entreprise_form').css("display:none");
        }
        else {
            $('#entreprise_form').css("display:block");
            $('#entreprise_form').css("visibility:visible");
            $('#entreprise_form').slideDown(400);
            $(document.body).scrollTop($('#entreprise_form').offset().top);
        }
        if ($('#particulier_form').is(':visible')) {
            $('#particulier_form').css("visibility:hidden");
            $('#particulier_form').slideUp(400);
            $('#particulier_form').css("display:none");
        }    
    });

    $("#register , #refer").click(function () {
        if ($('#regsiter_window').not(':visible')) {
            $('#regsiter_window').css("display:block");
            $('#regsiter_window').css("visibility:visible");
            $('#regsiter_window').slideDown(500);
        }
    });
	$("#cancelRegistre").click(function () {
		$("#prename_registre").val("");
		$("#name_registre").val("");
		$("#email_registre").val("");
		$("#phone_registre").val("");
		$("#pass_registre").val("");
        $('#regsiter_window').css("visibility:hidden");
        $('#regsiter_window').slideUp(400);
        $('#regsiter_window').css("display:none");
    });

// ==========================================================================================
$('form#form_registre').submit(function(event) {
	    var formData = {
	        'prename' : $('input[name=prename_registre]').val(),
	        'name' : $('input[name=name_registre]').val(),
	        'email' : $('input[name=email_registre]').val(),
	        'phone' : $('input[name=phone_registre]').val(),
	        'pass' : $('input[name=pass_registre]').val()
	        };

	        $.ajax({
	            type : 'POST', 
	            url : 'php/registre.php', 
	            data : formData, 
	            dataType : 'json', 
	            encode : true
	        })
	            .done(function(data) {
	            	if(data.success){
	                	$("#err_registre").css({"color": "white"});
	                	$("#err_registre").text("Nous avons bien recu votre message!");
						$("#name_registre").val("");
						$("#email_registre").val("");
						$("#phone_registre").val("");
						$("#message_registre").val("");
    					$("#err_registre").text("success!");				        
    					$('#regsiter_window').delay(2000).css("visibility:hidden");
				        $('#regsiter_window').slideUp(400);
				        $('#regsiter_window').css("display:none");
						$("#prename_registre").val("");
						$("#pass_registre").val("");
	                	$( location ).attr("href", "http://eipmondial.com/mondial/php/login.php");
	                }
	                else{
	                	$("#err_registre").css({"color": "#f4dd00"});
	                	if(!data.errors.name){data.errors.name='';}
	                	$("#err_registre").text(data.errors.name);
	                }
	            })
	            .fail(function(data) {
        			$("#err_registre").text("ERROR FAIL");
    			})
	        event.preventDefault();
	});

// ==========================================================================================



});


</script>

</body>

</html>
