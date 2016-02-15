<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<h1>TODOLIST</h1>
	</header>
	
	<main>
		<section class="1">
			<?php
			$servername = "localhost";
			$username = "root";
			$password = "";
			$DBname = "todo";

			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $DBname);

			// Check connection
			if (!$conn) {
			    die("Connection failed: ".mysqli_connect_error());
			}
			echo "Connected successfully <br>";

			// New record
			$input = isset($_POST['input']) ? $_POST['input'] : NULL;
			
			if ($input != NULL){
				$insert = "INSERT INTO todolist (omschrijving) VALUES ('$input')";
				if (mysqli_query($conn, $insert)) {
					echo "New record created successfully <br>";
				} else {
					 echo "Error: ".$insert."<br>".mysqli_error($conn);
				}
			}
			
			// Record verwijderen
			$id = isset($_POST['id']) ? $_POST['id'] : NULL;
			
			if($id != NULL){
				$delete = "DELETE FROM todolist WHERE id=$id";
				if (mysqli_query($conn, $delete)) {
			    	echo "Record deleted successfully"."<br>";
				} else {
		  		  	echo "Error deleting record: " . mysqli_error($conn)."<br>";
				}
			}
			
			//Updaten
			$idupdate = isset($_POST['idupdate']) ? $_POST['idupdate'] : NULL;
			$omschrijving = isset($_POST['omschrijving']) ? $_POST['omschrijving'] : NULL;

			$update = "UPDATE todolist SET omschrijving='$omschrijving' WHERE id=$idupdate";
			
			if ($conn->query($update) === TRUE) {
			    echo "Record updated successfully"."<br>";
			} else {
			   //echo "Error updating record: " . $conn->error."<br>";
			}

			// Records displayen
			$select = "SELECT * FROM todolist";
			$result = mysqli_query($conn, $select);

			if (mysqli_num_rows($result) > 0) {
			    // output data of each row
			    while($row = mysqli_fetch_assoc($result)) {
			        echo "id: " . $row["id"]. " - Name: " . $row["omschrijving"]. " ". "<br>";
			    }
			} else {
			    echo "0 results";
			}
			?>
		</section>
			
		<section class="2">
			<form action="index.php" method="post" accept-charset="utf-8">
			
				<fieldset>
					<legend>New record.</legend>
					</label>Omschrijving:</label> <input type="text" name="input"/><br>
				</fieldset>

				<fieldset>
					<legend>update record</legend>
					</label>Id: , Nieuwe omschrijving</label> <input type="text" name="omschrijving"><input type="text" name="idupdate"/>
				</fieldset>
				
				<fieldset>
					<legend>Record te verwijderen.</legend>
					</label>Id:</label> <input type="text" name="id"/><br>
				</fieldset>

				<fieldset>
					<legend>Submit.</legend>
					<input type="submit"/><br>
				</fieldset>
			</form>
			
			<?php
			// Connectie sluiten
			mysqli_close($conn);
			?>
		</section>
	</main>	

	<footer></footer>
</body>
</html>