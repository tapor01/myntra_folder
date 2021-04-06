<?php 
	$conn=oci_connect("lehar","lehar","localhost/ myntra_product");
	If (!$conn)
		echo 'Failed to connect to Oracle';
	?>