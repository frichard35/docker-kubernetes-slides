<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Docker example</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
	<script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" class="init">
	
$(document).ready(function() {
	$('#example').DataTable();
} );


	</script>
</head>
<body>

    <h1>Demonstration running on <?= gethostname() ?></h1>


<?php
$link = mysqli_connect(getenv('GESTION_DB_HOST'), getenv('GESTION_DB_USER'), getenv('GESTION_DB_PASSWORD'), 'gestion');
if (mysqli_connect_errno())
{
    echo "DB : An error occured. Please try again later.";
    exit();
}
mysqli_set_charset($link, 'utf8');

$sql = "SELECT id, first_name, last_name, city, phone, email FROM Persons";
$result = $link->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    ?>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>City</th>
                <th>Phone</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
    <?php
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["id"]. "</td><td>" 
        . $row["first_name"]. "</td><td>" 
        . $row["last_name"]. "</td><td>" 
        . $row["city"]. "</td><td>" 
        . $row["phone"]. "</td><td>" 
        . $row["email"]. "</td></tr>";
    }
    ?>
        </tbody></table>
    <?php
} else {
    echo "0 results";
}
$link->close();
?>
</body>
</html>
