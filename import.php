<?php

include('connection.php');

if(isset($_POST["Import"])){
		$con = getdb();

		echo $filename=$_FILES["file"]["tmp_name"];
		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	         while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {

	           $sql = "INSERT INTO `testedb`.`servidor`
			   (`numero`,
			   `up`,
			   `risp`,
			   `nome_servidor`,
			   `masp`,
			   `cargo`,
			   `data_da_confirmacao`,
			   `status_servidor`,
			   `tipo_de_teste`,
			   `dias_de_afastamento`,
			   `retorno_previsto`,
			   `exame_recebido`,
			   `cidade_moradia`)
			   VALUES ('$getData[0]','$getData[1]','$getData[2]','$getData[3]','$getData[4]','$getData[5]','$getData[6]','$getData[7]','$getData[8]','$getData[9]','$getData[10]','$getData[11]','$getData[12]')";
				var_dump($sql);
				exit();
	         //we are using mysql_query function. it returns a resource on true else False on error
	           $result = $con->query($sql);
				if(!$result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						</script>";		
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";	
			
		 }
	}	 
?>		 
