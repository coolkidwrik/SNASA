<!-- Original Test Oracle file for UBC CPSC304
  Created by Jiemin Zhang
  Modified by Simona Radu
  Modified by Jessica Wong (2018-06-22)
  Modified by Jason Hall (23-09-20)

  Used as a starting point for This projects by Wrik Sen, Ayush Vora, and Max Xu
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
$config["dbuser"] = "user_name";	// change to Oracle user name
$config["dbpassword"] = "password";	// change to Oracle password
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
    <title>Home | SNASA DB</title>
    <script src="../js/home.js"></script>
</head>
<body>
    <div id="headerInfo">
        <h1>Welcome to SNASA</h1>
        <h2>By: Ayush Vora, Max Xu, and Wrik Sen</h2>
    </div>
    <br>
    <div id="filter_search_1">
        <label for="select_by_filters">Choose a type:</label>
        <select id="select_by_filters">
            <option value="galaxy">Find Galaxies</option>
            <option value="satellite">Find Sattelites</option>
            <option value="planetary_system">All Planets in Galaxy</option>
            <option value="nebula">Average Magnitude of Nebula Types</option>
            <option value="black_hole">Black Hole Types</option>
            <option value="star">Average Stars per Galaxy</option>
            
            <option value="asteroid">Galaxies with Every Asteroid Composition</option>
        </select>	
        <button type="submit" id="submit_by_filters" onclick="filterButton1()">Submit</button>
    </div>
    <br>
    <div id="filter_search_2">

    </div>

	<?php
	// The following code will be parsed as PHP

	function debugAlertMessage($message) {
		global $show_debug_alert_messages;

		if ($show_debug_alert_messages) {
			echo "<script type='text/javascript'>alert('" . $message . "');</script>";
		}
	}

	function executePlainSQL($cmdstr) { //takes a plain (no bound variables) SQL command and executes it
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

	function executeBoundSQL($cmdstr, $list) {
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

    function printResult($result) {
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

	function connectToDB() {
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

	function disconnectFromDB() {
		global $db_conn;

		debugAlertMessage("Disconnect from Database");
		oci_close($db_conn);
	}

	function handleFilterRequest(){
        global $db_conn;

        if (isset($_GET['galaxyQuery'])) {
			$galaxySize = $_GET['size'];
			$comparison = $_GET['comparison'];
			$galaxyType = $_GET['type'];
			$selectString = "";
			if (isset($_GET['typeCheck']) && isset($_GET['sizeCheck'])) {
				$selectString = "*";
			} elseif (isset($_GET['sizeCheck'])) {
				$selectString = "ID, \"SIZE\"";
			} elseif(isset($_GET['typeCheck'])) {
				$selectString = "ID, TYPE";
			} else {
				$selectString = "ID";
			}
			if($galaxyType ===''){
				$query = "SELECT $selectString FROM Galaxy WHERE \"SIZE\" $comparison $galaxySize";
				if ($galaxySize ===''){
					$query = "SELECT $selectString FROM Galaxy";
				}
			}
			elseif($galaxySize===''){
				$query = "SELECT $selectString FROM Galaxy WHERE \"TYPE\" = $galaxyType";
				if ($galaxyType ===''){
					$query = "SELECT $selectString FROM Galaxy";
				}
			}
			else {
				$query = "SELECT $selectString FROM Galaxy WHERE \"SIZE\" $comparison $galaxySize AND \"TYPE\" = $galaxyType";
			}
			$result = executePlainSQL($query);
			printResult($result);
		}
		
    }

	function handleJoinRequest(){
        global $db_conn;
        if (isset($_GET['planetarySystemQuery'])) {
			$id = $_GET['galaxyId'];
			$query = "SELECT Planet.*, PlanetarySystem.galaxyID
			FROM Planet
			JOIN PlanetarySystem ON Planet.planetarySystemID = PlanetarySystem.id
			WHERE PlanetarySystem.galaxyID = '$id'";
			$result = executePlainSQL($query);
			printResult($result);
		}
    }

	function handleNebulaAggregateRequest(){
        global $db_conn;
        if (isset($_GET['nebulaQuery'])) {
			$query = 'SELECT "TYPE", AVG(magnitude) AS "Average Magnitude" FROM Nebula GROUP BY "TYPE"';
			$result = executePlainSQL($query);
			printResult($result);
		}
    }

	function handleBlackHoleAggregateRequest() {
		global $db_conn;
		$inequality = $_GET['comparison'];
		$number = $_GET['radius'];
		if (isset($_GET['blackHoleQuery'])) {
			$query = "SELECT BlackHoleMass.massType, avg(radius) as \"Average Radius\" 
			FROM (BlackHole JOIN BlackHoleMass ON BlackHoleMass.mass = BlackHole.mass)
			GROUP BY BlackHoleMass.massType
			HAVING avg(radius) $inequality $number 
			ORDER BY avg(radius)";
			$result = executePlainSQL($query);
			printResult($result);
		}
	}

	function handleStarAggregateRequest() {
		global $db_conn;
		if (isset($_GET['planetQuery'])) { // this is correct.
			$query = 'SELECT GalaxyID, SUM(Count) AS "Number of Stars"
			FROM PlanetarySystem
			JOIN (SELECT planetarySystemID AS psid, COUNT(planetarySystemID) AS Count 
				FROM Star 
				GROUP BY planetarySystemID)
			ON PlanetarySystem.id = psid
			GROUP BY GalaxyID';
			$result = executePlainSQL($query);
			printResult($result);
		}
	}

	// Every type of asteroid that appears in a Galaxy 
	function handleAsteroidDivisionRequest(){
        global $db_conn;
        if (isset($_GET['asteroidQuery'])) {
			$query = 'SELECT Galaxy.id FROM Galaxy
			JOIN Asteroid ON Galaxy.id = Asteroid.galaxyID
			JOIN AsteroidComposition ON Asteroid.composition = AsteroidComposition.composition
			GROUP BY Galaxy.id
			HAVING COUNT(DISTINCT AsteroidComposition.composition) = (SELECT COUNT(*) FROM AsteroidComposition)'; 
			$result = executePlainSQL($query);
			printResult($result);
		}
    }

	function handleDisplayRequest() {
        global $db_conn;

        $selectedType = $_GET['selectedType'];
        $result = executePlainSQL("SELECT * FROM Galaxy");
        printResult($result);
	}

	function handleRequest(){
		if (connectToDB()) {
			if ($_SERVER['REQUEST_METHOD'] === 'GET') {
				handleGETRequest();
			} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
				handlePOSTRequest();
			}

			disconnectFromDB();
		}
	}

	function handleGETRequest() {
		if (isset($_GET['countTupleRequest'])) {
			handleCountRequest();
		} elseif (isset($_GET['displayTuplesRequest'])) {
			handleDisplayRequest();
		} elseif(isset($_GET['galaxyQuery'])){
			handleFilterRequest();
		} elseif(isset($_GET['planetarySystemQuery'])){
			handleJoinRequest();
		} elseif(isset($_GET['nebulaQuery'])){
			handleNebulaAggregateRequest();
		} elseif(isset($_GET['blackHoleQuery'])){
			handleBlackHoleAggregateRequest();
		} elseif(isset($_GET['planetQuery'])){ // this is correct.
			handleStarAggregateRequest();
		} elseif(isset($_GET['asteroidQuery'])){
			handleAsteroidDivisionRequest();
		}
	}

	function handlePOSTRequest() {
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
