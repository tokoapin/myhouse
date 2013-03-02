<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Error</title>
</head>
<body>
	<h1>
		<?php echo validation_errors(); ?>
	</h1>
	<h2>
		<?php if(!empty($message)) echo $message; ?>
	</h2>
</body>
</html>

    