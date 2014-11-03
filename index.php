<?session_start();?>
<!DOCTYPE html>
<html>
<head>
<link type="image/x-icon" href="img/favicon.ico" rel="shortcut icon"/>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-select.css" />
<link rel="stylesheet" type="text/css" href="css/bootstrap-social.css" />
<link rel="stylesheet" type="text/css" href="css/font-awesome.css" />
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

    <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/jquery.bootstrap-autohidingnavbar.js"></script>
    <script type="text/javascript" src="js/bootstrap-dialog.js"></script>
    <script type="text/javascript" src="js/bootstrap-select.js"></script>
    <script type="text/javascript" src="js/func.js"></script>
	<title>.:VenAyuda:.</title>
</head>
<body>
<div id="wrap">
<form id="form1" name="form1" class="form" role="form">
<?
	if(empty($_REQUEST["va"])){
	    include("includes/inicio.php");
	}
	else if($_REQUEST["va"]==1){
	    include("donacion/donacion.php");
	}
	include("includes/menu.php");
 ?>
</form>
</div>
<?include("includes/footer.php");?>
</body>
</html>