<?php
include('connection.php');
$con = getdb();


   if(isset($_POST["Import"])){		
		echo $filename=$_FILES["file"]["tmp_name"];	

		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	           $sql = "INSERT INTO servidor (numero,up,risp,nome_servidor,masp,cargo,data_da_confirmacao,status_servidor,tipo_de_teste,dias_de_afastamento,retorno_previsto,exame_recebido,cidade_moradia) values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."','".$getData[5]."','".$getData[6]."','".$getData[7]."','".$getData[8]."','".$getData[9]."','".$getData[10]."','".$getData[11]."','".$getData[12]."')";
	           $result = mysqli_query($con, $sql);
			    // var_dump(mysqli_error_list($con));
			    // exit();
				if(!isset($result))
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"index.php\"
						  </script>";		
				}
				else {
					  echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"index.php\"
					</script>";
				}
	         }
			
	         fclose($file);	
		 }
	}	 
	
	 if(isset($_POST["Export"])){
		 
      header('Content-Type: text/csv; charset=utf-8');  
      header('Content-Disposition: attachment; filename=data.csv');  
      $output = fopen("php://output", "w");  
      fputcsv($output, array('ID', 'NUMERO', 'UP', 'RISP', 'NOME SERVIDOR', 'MASP', 'CARGO', 'DATA DA CONFIRMACAO', 'STATUS SERVIDOR', 'TIPO DE TESTE', 'DIAS DE AFASTAMENTO', 'RETORNO PREVISTO', 'EXAME RECEBIDO', 'CIDADE MORADIA', 'DATA CRIAÇAO'));  
      $query = "SELECT * from servidor ORDER BY id DESC";  
      $result = mysqli_query($con, $query);  
      while($row = mysqli_fetch_assoc($result))  
      {  
           fputcsv($output, $row);  
      }  
      fclose($output);  
 }  
	
function get_all_records(){
    $con = getdb();

    $Sql = "SELECT * FROM servidor";
    $result = mysqli_query($con, $Sql);  

    if (mysqli_num_rows($result) > 0) {
     echo "<div class='table-responsive'><table id='myTable' class='table table-striped table-bordered'>
     <thead>
		<tr>
			<th>ID</th>
			<th>NUMERO</th>
			<th>UP</th>
			<th>RISP</th>
			<th>NOME SERVIDOR</th>
			<th>MASP</th>
			<th>CARGO</th>
			<th>DATA DA CONFIRMACAO</th>
			<th>STATUS SERVIDOR</th>
			<th>TIPO DE TESTE</th>
			<th>DIAS DE AFASTAMENTO</th>
			<th>RETORNO PREVISTO</th>
			<th>EXAME RECEBIDO</th>
			<th>CIDADE MORADIA</th>
			<th>DATA CRIACAO</th>
		</tr>
	</thead><tbody>";

     while($row = mysqli_fetch_assoc($result)) {


		 echo "<tr>
					<td>" . $row['id']."</td>
					<td>" . $row['numero']."</td>
					<td>" . $row['up']."</td>
					<td>" . $row['risp']."</td>
					<td>" . $row['nome_servidor']."</td>
					<td>" . $row['masp']."</td>
					<td>" . $row['cargo']."</td>
					<td>" . $row['data_da_confirmacao']."</td>
					<td>" . $row['status_servidor']."</td>
					<td>" . $row['tipo_de_teste']."</td>
					<td>" . $row['dias_de_afastamento']."</td>
					<td>" . $row['retorno_previsto']."</td>
					<td>" . $row['exame_recebido']."</td>
					<td>" . $row['cidade_moradia']."</td>
					<td>" . $row['data_criacao']."</td>
				</tr>";
         
     }
	//  echo "<tr> <td><a href='' class='btn btn-danger' id='status_btn' data-loading-text='Changing Status..'>Export</a></td></tr>";
     echo "</tbody></table></div>";
	 
} else {
     echo "you have no recent pending orders";
}
}

?>
