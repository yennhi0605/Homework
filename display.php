<?php
	$server = "localhost";
	$user = "root";
	$pwd = "";
	$dbName = "imagemanagement";
	$db = new mysqli($server, $user, $pwd, $dbName);

	$sql = "SELECT * from images";
	$result = $db->query($sql)->fetch_all();
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">

		.line{
			display: flex;
			justify-content: space-between;
			width: 70%;
			align-items: center;
			text-align: center;
			border-bottom: center;
			margin-top: 10px;
			margin-left: 170px;
			border-radius: 20px;
			color: black;
			height: 40px;
			border-collapse: collapse;
		  	border: 2px solid gray;
		}

		table{
			width: 65%;
			text-align: center;
			margin-left: 200px;
			margin-top: 20px;
			background-color: lightyellow;
		}

		table,th,td{
			border:1px solid black;
			border-collapse: collapse;
		}

		body{
			align-items: center;
			justify-content: center;
			border-radius: 3px;
			border-bottom: center;
			text-align: center;
		}

		button{
			margin-top: 20px;
		}

		img{
			width: 50px;
		}

		h1{
			text-align: center;
			color: red;
		}

	</style>
</head>
<body>
	<h1>My Photos</h1>
	<table>
		<tr>
			<th><h2>Id</h2></th>
			<td><h2>Image</h2></td>
		</tr>
		<?php	
			for ($i = 0; $i < count($result); $i++) {
		?>
			<form class="line" action="display.php" method="post">
				<tr>
					<td><h3><?php echo $result[$i][0] ?></h3></td>
					<td><?php echo "<img src=".$result[$i][1].">" ?></td>
				</tr>
		<?php
			}		
		?>
	</table>
</body>
</html>