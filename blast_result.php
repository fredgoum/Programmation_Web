<!-- DOCTYPE: HTML -->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>BLAST - BIO-Analysis tools</title>
  </head>

  <body>
	
	<!-- HEADER -->
	<div class="header">
		<?php include("header.php"); ?>
	</div>

	<div class="mega_container">

		<!-- MENU -->
	    <?php include("menu.php"); ?>

		<!-- MAIN -->
		<div class="main_container">
			<?php
			    $file = "{$blast}.txt";

			    if(!file_exists($file)) die("An error has occured. Please try again in a few moments.");

			    $type = filetype($file);
			    // Send file headers
			    header("Content-type: $type");
			    header("Content-Disposition: attachment;filename={$blast}.txt");
			    header("Content-Transfer-Encoding: binary"); 
			    header('Pragma: no-cache'); 
			    header('Expires: 0');
			    // Send the file contents.
			    set_time_limit(0); 
			    readfile($file);
			?>
			<button type="button" onclick="location.href='blast_result.php'">Download</button>

		</div>

	</div>

	<!-- FOOTER -->
    <footer>
        <?php include("footer.php"); ?>
    </footer>

  </body>

</html>
