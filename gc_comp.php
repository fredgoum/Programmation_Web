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

		<!-- MENU -->
	    <?php include("menu.php"); ?>

		<!-- FORM -->

		<?php /*CONVERT FUNCTION*/
		$exist = 0;
		$result = "";
		if ((isset($_POST['sequence'])) && ($_POST['sequence'] != '')){
			$sequence_0 = strtoupper($_POST['sequence']);
			$sequence = preg_replace("/(\r\n|\n|\r )/","",$sequence_0);
			$g="G";$c = "C";
			$offset = 0;
			$exist = 1;
			if (preg_match("/^[AGCTU]+$/",$sequence)){		/*U for RNA and T for DNA*/
				$result = 0;					/*INIT*/
				$tot_len = strlen($sequence);			/*Count sequence's length*/
				$gcnb = substr_count($sequence, $g,$offset,$tot_len);		/*Offset = 0, counts the "G"*/
				$gcnb += substr_count($sequence, $c, $offset,$tot_len);		/*Counts the "C"*/
				$result = $gcnb/$tot_len;				
			}else{
				$result = "This sequence is neither DNA or RNA. Please check your input.";
			}
		}else{
			$sequence = "";
		} ?>	

		<!-- MAIN -->

		<div class="main_container">
			<p><p style="text-align:center"><b>G/C percentage</b></style></p>
			<br><br><br>
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
				<p><p style="text-align:center">Please input a sequence (either in DNA or RNA) in the box below.</style></p>
				<textarea type="text" name="sequence" rows="20" cols="133"><?php echo $sequence;?></textarea>
				<input type="submit" name="compute" value="Compute">
				<br><br><br>
				<p><p style="text-align:center">The G/C percentage of this sequence is:</style></p>
				<p><p style="text-align:center"><?php
				if($exist == 1){
					 echo $result;
				} ?></style></p>
				<br><br><br>
			</form>
			<p><i><a href="main.php">Back to homepage</a></i></p>
			<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		</div>
	</div>
	
	<!-- FOOTER -->
    <footer>
        <?php include("footer.php"); ?>
    </footer>

  </body>
</html>
