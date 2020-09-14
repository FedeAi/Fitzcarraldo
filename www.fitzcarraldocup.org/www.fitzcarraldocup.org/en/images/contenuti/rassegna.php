<?php 

$anno=$HTTP_GET_VARS['anno']; 
$img=$HTTP_GET_VARS['img'];
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Rassegna</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>

<body>
<img name="img" src="RassegnaStampa<?php echo $anno ?>/<?php echo $img ?>" alt="">
</body>
</html>
