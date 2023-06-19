<?php
	if(ISSET($_POST['generate'])){
		$code=$_POST['barcode'];
		for ($x = 0; $x <= 10; $x++) {
			echo "<center><img alt='testing' src='barcode.php?codetype=Code39&size=50&text=".$code.$x."&print=true'/></center>";
		  }
		
	}
?>