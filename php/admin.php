<!-- Original Test Oracle file for UBC CPSC304
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  Modified by Jason Hall (23-09-20)

  Used as a template for our project. Created by Wrik Sen, Ayush Vor and Max Xu
  (2023-11-20)
  The script assumes you already have a server set up All OCI commands are
  commands to the Oracle libraries. To get the file to work, you must place it
  somewhere where your Apache server can run it, and you must rename it to have
  a ".php" extension. You must also change the username and password on the
  oci_connect below to be your ORACLE username and password
-->

<?php
// The preceding tag tells the web server to parse the following text as PHP
// rather than HTML (the default)

// The following 3 lines allow PHP errors to be displayed along with the page
// content. Delete or comment out this block when it's no longer needed.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set some parameters

// Database access configuration
$config["dbuser"] = "ora_wriksen";			// change "cwl" to your own CWL
$config["dbpassword"] = "a53382818";	// change to 'a' + your student number
$config["dbserver"] = "dbhost.students.cs.ubc.ca:1522/stu";
$db_conn = NULL;	// login credentials are used in connectToDB()

$success = true;	// keep track of errors so page redirects only if there are no errors

$show_debug_alert_messages = False; // show which methods are being triggered (see debugAlertMessage())

// The next tag tells the web server to stop parsing the text as PHP. Use the
// pair of tags wherever the content switches to PHP
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin | SNASA DB</title>
    <script src="../js/admin.js"></script>
</head>
<body>
    <h1>SNASA Admin Page</h1>
    <p>Here, you can add, remove, and edit the database information</p>
    <br>

    <h2>Add Data</h2>
    <hr>
    <label for="add_type">Choose a type:</label>
    <select id="add_type", name="add_type">
        <option value="galaxy">Galaxy</option>
        <option value="star">Star</option>
        <option value="planet">Planet</option>
        <option value="satellite">Satellite</option>
        <option value="asteroid">Asteroid</option>
        <option value="blackhole">Black Hole</option>
        <option value="nebula">Nebula</option>
        <option value="planetarysystem">Planetary System</option>
    </select>
    <input type="submit" id="add_type_button" onclick="addTypeButton()">
    <br>
    <div id="add_data">
    </div>
    <br>

    <h2>Update Data</h2>
     <hr>
    <label for="update_type">Choose a type:</label>
    <select id="update_type">
        <option value="galaxy">Galaxy</option>
        <option value="star">Star</option>
        <option value="planet">Planet</option>
        <option value="satellite">Satellite</option>
        <option value="asteroid">Asteroid</option>
        <option value="blackhole">Black Hole</option>
        <option value="nebula">Nebula</option>
        <option value="planetarysystem">Planetary System</option>
    </select>
    <input type="submit" id="update_button" onclick="updateButton()">
    <br>
    <div id="update_data">
    </div>
    <br>

    <h2>Remove Data</h2>
	<hr>
    <label for="remove_type">Choose a type:</label>
    <select id="remove_type">
        <option value="galaxy">Galaxy</option>
        <option value="star">Star</option>
        <option value="planet">Planet</option>
        <option value="satellite">Satellite</option>
        <option value="asteroid">Asteroid</option>
        <option value="blackhole">Black Hole</option>
        <option value="nebula">Nebula</option>
        <option value="planetarysystem">Planetary System</option>
    </select>
    <input type="submit" id="remove_button" onclick="removeButton()">
    <br>
    <div id="remove_data">
    </div>
    <br>

    <h2>View Data</h2>
    <hr>
    <label for="view_type">Choose a type:</label>
    <form method="GET" action="admin.php">
        <input type="hidden" id="displayTuplesRequest" name="displayTuplesRequest">
        <select id="view_type" name="selectedType">
            <option value="galaxy">Galaxy</option>
            <option value="galaxyType">Galaxy Type</option>
            <option value="star">Star</option>
            <option value="starTemperature">Star Temperature</option>
            <option value="planet">Planet</option>
            <option value="satellite">Satellite</option>
            <option value="moon">Moon</option>
            <option value="asteroid">Asteroid</option>
            <option value="meteor">Meteor</option>
            <option value="blackhole">Black Hole</option>
            <option value="blackholemass">Black Hole Mass</option>
            <option value="nebula">Nebula</option>
            <option value="planetarysystem">Planetary System</option>
        </select>
        <input type="submit" name="displayTuples">
    </form>


	<?php
	// The following code will be parsed as PHP

	function debugAlertMessage($message)
	{
		global $show_debug_alert_messages;

		if ($show_debug_alert_messages) {
			echo "<script type='text/javascript'>alert('" . $message . "');</script>";
		}
	}

	function executePlainSQL($cmdstr)
	{ //takes a plain (no bound variables) SQL command and executes it
		//echo "<br>running ".$cmdstr."<br>";
		global $db_conn, $success;

		$statement = oci_parse($db_conn, $cmdstr);
		//There are a set of comments at the end of the file that describe some of the OCI specific functions and how they work

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn); // For oci_parse errors pass the connection handle
			echo htmlentities($e['message']);
			$success = False;
		}

		$r = oci_execute($statement, OCI_DEFAULT);
		if (!$r) {
			echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
			$e = oci_error($statement); // For oci_execute errors pass the statementhandle
			echo htmlentities($e['message']);
			$success = False;
		}

		return $statement;
	}

	function executeBoundSQL($cmdstr, $list)
	{
		/* Sometimes the same statement will be executed several times with different values for the variables involved in the query.
		In this case you don't need to create the statement several times. Bound variables cause a statement to only be
		parsed once and you can reuse the statement. This is also very useful in protecting against SQL injection.
		See the sample code below for how this function is used */

		global $db_conn, $success;
		$statement = oci_parse($db_conn, $cmdstr);

		if (!$statement) {
			echo "<br>Cannot parse the following command: " . $cmdstr . "<br>";
			$e = OCI_Error($db_conn);
			echo htmlentities($e['message']);
			$success = False;
		}

		foreach ($list as $tuple) {
			foreach ($tuple as $bind => $val) {
				//echo $val;
				//echo "<br>".$bind."<br>";
				oci_bind_by_name($statement, $bind, $val);
				unset($val); //make sure you do not remove this. Otherwise $val will remain in an array object wrapper which will not be recognized by Oracle as a proper datatype
			}

			$r = oci_execute($statement, OCI_DEFAULT);
			if (!$r) {
				echo "<br>Cannot execute the following command: " . $cmdstr . "<br>";
				$e = OCI_Error($statement); // For oci_execute errors, pass the statementhandle
				echo htmlentities($e['message']);
				echo "<br>";
				$success = False;
			}
		}
	}

    function printResult($result)
    {
        echo "<br>Retrieved data from the table:<br>";
        echo "<table border='1'>";

        // Fetch the column names from the result set
        $numColumns = oci_num_fields($result);

        // Display table headers
        echo "<tr>";
        for ($i = 1; $i <= $numColumns; $i++) {
            $columnName = oci_field_name($result, $i);
            echo "<th>$columnName</th>";
        }
        echo "</tr>";

        // Display table rows
        while ($row = OCI_Fetch_Array($result, OCI_ASSOC)) {
            echo "<tr>";
            foreach ($row as $columnName => $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }

        echo "</table>";
    }

	function connectToDB()
	{
		global $db_conn;
		global $config;

		// Your username is ora_(CWL_ID) and the password is a(student number). For example,
		// ora_platypus is the username and a12345678 is the password.
		// $db_conn = oci_connect("ora_cwl", "a12345678", "dbhost.students.cs.ubc.ca:1522/stu");
		$db_conn = oci_connect($config["dbuser"], $config["dbpassword"], $config["dbserver"]);

		if ($db_conn) {
			debugAlertMessage("Database is Connected");
			return true;
		} else {
			debugAlertMessage("Cannot connect to Database");
			$e = OCI_Error(); // For oci_connect errors pass no handle
			echo htmlentities($e['message']);
			return false;
		}
	}

	function disconnectFromDB()
	{
		global $db_conn;

		debugAlertMessage("Disconnect from Database");
		oci_close($db_conn);
	}




	function handleUpdateRequest()
    {
        global $db_conn;

        if (isset($_POST['updateQueryRequest'])) {

            $type = $_POST['updateTableName'];
            $id = $_POST['oldId'];

            if ($type === 'galaxy') {
                $newSize = $_POST['newSize'];
                $newType = $_POST['newType'];

                $query = "UPDATE Galaxy SET \"SIZE\" = $newSize, \"TYPE\" = '$newType' WHERE id = '$id'";
                echo "Galaxy updated successfully!";
            } elseif ($type === 'satellite') {
                $newMass = $_POST['newMass'];
                $newPlanetId = $_POST['newPlanetId'];

                $query = "UPDATE Satellite SET planetId = '$newPlanetId', mass = $newMass WHERE id = '$id'";
                echo "Satellite updated successfully!";

                $moonCheckQuery = "SELECT * FROM Moon WHERE id = '$id'";
                $moonCheckResult = executePlainSQL($moonCheckQuery);
                $moonExists = oci_fetch_assoc($moonCheckResult);

                if ($moonExists) {
                    $moonUpdateQuery = "UPDATE Moon SET planetId = '$newPlanetId' WHERE id = '$id'";
                    echo "Moon updated successfully!";
                    executePlainSQL($moonUpdateQuery);
                }
            } else {

            }

            executePlainSQL($query);
            oci_commit($db_conn);
        }
    }




    function handleRemoveRequest()
    {
        global $db_conn;

        if (isset($_POST['removeQueryRequest'])) {

            $type = $_POST['removeTableName'];
            $id = $_POST['removeId'];

            $query = "DELETE FROM $type WHERE id = '$id'";
            echo "$type removed successfully!";

            executePlainSQL($query);
            oci_commit($db_conn);
        }
    }




	function handleInsertRequest()
    {
        global $db_conn;

        if (isset($_POST['insertQueryRequest'])) {
            // The form has been submitted

            $type = $_POST['insertTableName'];

            // Construct an INSERT query based on the selected type
            if ($type === 'galaxy') {
                $id = $_POST['id'];
                $size = $_POST['SIZE'];
                $galaxyType = $_POST['TYPE'];

                $query = "INSERT INTO Galaxy VALUES ('$id', $size, '$galaxyType')";
                executePlainSQL($query);
                echo "Galaxy inserted successfully!";
            } elseif ($type === 'satellite') {
                $satelliteId = $_POST['id'];
                $planetId = $_POST['planetId'];
                $mass = $_POST['mass'];

                // Check if it's a Moon
                if (isset($_POST['ismoon'])) {
                    $radius = $_POST['radius'];

                    $moonQuery = "INSERT INTO Moon VALUES ('$satelliteId', '$planetId', $radius)";
                }
                $query = "INSERT INTO Satellite VALUES ('$satelliteId', '$planetId', $mass)";
                executePlainSQL($query);
                echo "Sattelite inserted successfully!";
                executePlainSQL($moonQuery);
                echo "Moon inserted successfully!";

            } elseif ($type === 'asteroid') {
                $asteroidId = $_POST['id'];
                $composition = $_POST['composition'];
                $galaxyID = $_POST['galaxyID'];

                $query = "INSERT INTO Asteroid VALUES ('$asteroidId', '$composition', '$galaxyID')";
                executePlainSQL($query);
                echo "Asteroid inserted successfully!";
            } elseif ($type === 'planetarysystem') {
                $systemId = $_POST['id'];
                $systemType = $_POST['systemType'];
                $age = $_POST['age'];
                $galaxyID = $_POST['galaxyID'];

                $query = "INSERT INTO PlanetarySystem VALUES ('$systemId', '$systemType', $age, '$galaxyID')";
                executePlainSQL($query);
                echo "Planetary System inserted successfully!";
            } elseif ($type === 'planet') {
                $planetId = $_POST['id'];
                $declination = $_POST['declination'];
                $rightAscension = $_POST['rightAscension'];
                $mass = $_POST['mass'];
                $radius = $_POST['radius'];
                $planetType = $_POST['planetType'];
                $planetarySystemId = $_POST['planetarySystemId'];

                $query = "INSERT INTO Planet VALUES ('$planetId', $declination, $rightAscension, $mass, $radius, '$planetType', '$planetarySystemId')";
                executePlainSQL($query);
                echo "Planet inserted successfully!";
            } elseif ($type === 'meteor') {
                $meteorId = $_POST['id'];
                $planetEnteredId = $_POST['planetEnteredId'];

                $query = "INSERT INTO Meteor VALUES ('$meteorId', '$planetEnteredId')";
                executePlainSQL($query);
                echo "Meteor inserted successfully!";
            } elseif ($type === 'nebula') {
                $nebulaId = $_POST['id'];
                $nebulaType = $_POST['TYPE'];
                $nebulaMagnitude = $_POST['magnitude'];
                $galaxyID = $_POST['galaxyID'];

                $query = "INSERT INTO Nebula VALUES ('$nebulaId', '$nebulaType', $nebulaMagnitude, '$galaxyID')";
                executePlainSQL($query);
                echo "Nebula inserted successfully!";
            } elseif ($type === 'star') {
                $starId = $_POST['id'];
                $declination = $_POST['declination'];
                $rightAscension = $_POST['rightAscension'];
                $mass = $_POST['mass'];
                $radius = $_POST['radius'];
                $temperature = $_POST['temperature'];
                $luminosity = $_POST['luminosity'];
                $planetarySystemID = $_POST['planetarySystemID'];

                $query = "INSERT INTO Star VALUES ('$starId', $declination, $rightAscension, $mass, $radius, $temperature, $luminosity, '$planetarySystemID')";
                executePlainSQL($query);
                echo "Star inserted successfully!";
            } elseif ($type === 'blackhole') {
                $blackHoleId = $_POST['id'];
                $radius = $_POST['radius'];
                $mass = $_POST['mass'];
                $galaxyID = $_POST['galaxyID'];

                $blackHoleMassCheckQuery = "SELECT * FROM BlackHoleMass WHERE id = '$mass'";
                $blackHoleMassCheckResult = executePlainSQL($blackHoleMassCheckQuery);
                $blackHoleMassExists = oci_fetch_assoc($blackHoleMassCheckResult);
                if (!$blackHoleMassExists) {
                    if ($mass<=1000) {
                        $massType='Stellar';
                    } else if ($mass<=100000) {
                        $massType='Intermediate';
                    } else { //supermasive
                        $massType='Supermassive';
                    }
                    $query = "INSERT INTO BlackHoleMass VALUES ('$massType', '$mass')";
                    executePlainSQL($query);
                    echo "Black Hole Mass inserted successfully!";
                }
                $query = "INSERT INTO BlackHole VALUES ('$blackHoleId', $radius, $mass, '$galaxyID')";
                executePlainSQL($query);
                echo "Black Hole inserted successfully!";

            } else {
                // Handle other types
            }
            oci_commit($db_conn);
        }
    }

	// function handleCountRequest()
	// {
	// 	global $db_conn;

	// 	$result = executePlainSQL("SELECT Count(*) FROM demoTable");

	// 	if (($row = oci_fetch_row($result)) != false) {
	// 		echo "<br> The number of tuples in demoTable: " . $row[0] . "<br>";
	// 	}
	// }

	function handleDisplayRequest()
	{
        global $db_conn;

        $selectedType = $_GET['selectedType'];
        $result = executePlainSQL("SELECT * FROM $selectedType");
        printResult($result);
	}

function handleRequest()
{
    if (connectToDB()) {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            handleGETRequest();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            handlePOSTRequest();
        }

        disconnectFromDB();
    }
}

function handleGETRequest()
{
    if (isset($_GET['countTupleRequest'])) {
        handleCountRequest();
    } elseif (isset($_GET['displayTuplesRequest'])) {
        handleDisplayRequest();
    }
}

function handlePOSTRequest()
{
    if (isset($_POST['updateQueryRequest'])) {
        handleUpdateRequest();
    } elseif (isset($_POST['removeQueryRequest'])) {
        handleRemoveRequest();
    } elseif (isset($_POST['insertQueryRequest'])) {
        handleInsertRequest();
    }
}

handleRequest();

	// End PHP parsing and send the rest of the HTML content
	?>
</body>

</html>