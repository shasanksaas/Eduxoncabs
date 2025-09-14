<?php
class dbquery extends SiteData {	
	
	function exeCute($qry){
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME); 
        $conn=$this->getConnection();
		

		$sql_query = mysqli_query($mysqli_conn, $qry);
		$res_data = [];
		while($data = mysqli_fetch_array($sql_query, MYSQLI_ASSOC)){
			$res_data[] = $data; 
		}
		return $res_data;
	}	

// 	function fetch_data($tbl_nm, $condition="", $order="", $limit="") {
// 		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
// 		$select = "SELECT * FROM $tbl_nm";
// 		if ($condition != "") $select .= " WHERE $condition";
// 		if ($order != "") $select .= " ORDER BY $order";
// 		if ($limit != "") $select .= " LIMIT $limit";

// 		$res = mysqli_query($mysqli_conn, $select);
// 		$res_data = [];
// 		while($res_row = mysqli_fetch_array($res, MYSQLI_ASSOC)){
// 			$res_data[] = $res_row; 
// 		}
// 		return $res_data;
// 	}
function fetch_data($tbl_nm, $condition="", $order="", $limit="") {
    $mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();

    $select = "SELECT * FROM $tbl_nm";
    if ($condition != "") $select .= " WHERE $condition";
    if ($order != "") $select .= " ORDER BY $order";
    if ($limit != "") $select .= " LIMIT $limit";

    // Use the WADB method instead of mysqli_query()
    $res = $conn->selectRecords($select);
    
    return $res;
}

// 	function insertToDb($sSql) {
// 		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
// 		$exe = $this->insert($sSql);
// 		return ['oDATA' => $exe ? 1 : 0];
// 	}
	
	function insertToDb($tbl, $fields) {
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();
		$insert = "INSERT INTO $tbl SET $fields";
		$exe = $this->insert($insert);
		return ['oDATA' => $exe ? 1 : 0];
	}
	
	function insertToDblastId($tbl, $fields) {
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();
		$insert = "INSERT INTO $tbl SET $fields";
		$exe = $this->insert($insert);
		return $exe ? mysqli_insert_id($mysqli_conn) : 0;
	}

	function updateToDb($tbl, $fields, $condition) {
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();
		$update = "UPDATE $tbl SET $fields WHERE $condition";
		$exe = $this->update($update);
		return $exe ? 1 : 0;
	}
	
	function selectFromDb($tbl, $fields = "*", $condition = "", $order = "", $limit = "") {
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();
		$select = "SELECT $fields FROM $tbl";
		if ($condition != "") $select .= " WHERE $condition";
		if ($order != "") $select .= " $order";
		if ($limit != "") $select .= " LIMIT $limit";
		
		$exe = $this->exeCute($select);
		return $exe;
	}

	function delete($tbl, $condition) {
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();
		$select = "DELETE FROM $tbl WHERE $condition";
		$sql = mysqli_query($mysqli_conn, $select);
		return $sql ? true : false;
	}
	
// 	function countRec($tbl_nm, $condition="") {
// 		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
// 		$select = "SELECT COUNT(*) AS count FROM $tbl_nm";
// 		if ($condition != "") $select .= " WHERE $condition";

// 		$row_query = mysqli_query($mysqli_conn, $select);
// 		$result = mysqli_fetch_assoc($row_query);
// 		return $result['count']; 
// 	}
function countRec($tbl_nm, $condition="") {
    $mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME); 
    $conn=$this->getConnection(); // This is a WADB object, NOT mysqli

    $select = "SELECT COUNT(*) AS count FROM $tbl_nm";
    if ($condition != "") $select .= " WHERE $condition";

    // Use WADB's method instead of mysqli_query()
    $row_query = $conn->selectRecords($select);

    return $row_query[0]['count'] ?? 0; // Ensure proper indexing for result
}

	function fetchSingleLatest($tbl_nm, $condition = "", $key = "") {
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();// This is a WADB object, NOT mysqli
		$select = "SELECT * FROM $tbl_nm";
		if ($condition != "") $select .= " WHERE $condition";
		if ($key != "") $select .= " ORDER BY $key DESC LIMIT 1"; 
		
		$qry_exe = mysqli_query($mysqli_conn, $select);
		return mysqli_fetch_array($qry_exe, MYSQLI_ASSOC);
	}

	function checkDuplicate($tbl_nm, $condition) {
		$mysqli_conn = mysqli_connect(SYSTEM_DBHOST, SYSTEM_DBUSER, SYSTEM_DBPWD, SYSTEM_DBNAME);
    $conn=$this->getConnection();
		$select = "SELECT COUNT(*) AS count FROM $tbl_nm WHERE $condition";
		$sql = mysqli_query($mysqli_conn, $select);
		$result = mysqli_fetch_assoc($sql);
		return ($result['count'] > 0) ? 1 : 0;
	}
}
?>
