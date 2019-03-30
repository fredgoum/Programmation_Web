<!-- DOCTYPE: HTML -->

<html lang="en">
  <head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="base.css">
	<title>G/C percentage computer - BIO-Analysis tools</title>
  </head>

  <body>
	<div class="header">
	<p><i><font color="#FFFFFF">Insert image here</font></i></p>
	</div>

	<div class="mega_container">

		<!-- Le Menu du site web -->
	    <?php include("menu.php"); ?>

		<!-- FORM -->

		<?php /*CONVERT FUNCTION*/
		$exist = 0;
		$result = "";
		if ((isset($_POST['sequence'])) && ($_POST['sequence'] != '')){
			$sequence_0 = strtoupper($_POST['sequence']);			/*In all caps*/
			$sequence = preg_replace("/(\r\n|\n|\r )/","",$sequence_0);	/*Remove unnecessary characters*/
			$t = '/T*/'; $u = 'U';
			$result = preg_replace($t,$u,$sequence);			/*Converting DNA into RNA, T becomes U*/
			$exist = 1;
			if (preg_match("/^[^AGCTU]+$/",$sequence)){
				$result = "This sequence is not DNA. Please check your input.";
			}
		}else{
			$sequence = "";
		} ?>	

		<!-- MAIN -->

		<div class="main_container">
			<p><p style="text-align:center"><b>DNA to RNA conversion</b></style></p>
			<br><br><br>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:center">Please input a DNA sequence in the box below.</style></p>
				<textarea type="text" name="sequence" rows="20" cols="133"><?php echo $sequence;?></textarea>
				<input type="submit" name="compute" value="Convert">
				<br>
				<p><p style="text-align:center">RNA output:</style></p>
				<textarea type="text" readonly name="result" rows="20" cols="133"><?php if ($exist ==1){echo $result;} ?></textarea>
				<br><br><br>
			</form>
			<p><i><a href="main.php">Back to homepage</a></i></p>
			<br><br>
		</div>
	</div>
	
	<!-- FOOTER -->
    <footer>
        <?php include("footer.php"); ?>
    </footer>

  </body>
</html>
