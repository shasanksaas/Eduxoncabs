<?php
class WADB {
    /* Database Properties */
    public $sDbHost;
    public $sDbName;
    public $sDbUser;
    public $sDbPwd;
    public $iNoOfRecords;
    public $oQueryResult;
    public $bSelectRecords;
    public $aArrRec;
    public $bInsertRecords;
    public $iInsertRecId;
    public $bUpdateRecords;
    private $oDbLink;

    /* Constructor */
    function __construct($sDbHost, $sDbName, $sDbUser, $sDbPwd) {
        // Connect to MySQL Database
        $this->oDbLink = mysqli_connect($sDbHost, $sDbUser, $sDbPwd, $sDbName);
        
        // Check connection
        if (!$this->oDbLink) {
            die("Database Connection Failed: " . mysqli_connect_error() . "<br>Host: $sDbHost<br>User: $sDbUser<br>Database: $sDbName");
        }
    }
    function db_connect(){
        return $this->oDbLink;
    }

    /* Select Records */
    function selectRecords($sSqlQuery) {
        unset($this->bSelectRecords);
        $this->oQueryResult = mysqli_query($this->oDbLink, $sSqlQuery);
        
        if (!$this->oQueryResult) {
            die("Query Failed: " . mysqli_error($this->oDbLink));
        }

        $this->iNoOfRecords = mysqli_num_rows($this->oQueryResult);
        if ($this->iNoOfRecords > 0) {
            while ($oRow = mysqli_fetch_assoc($this->oQueryResult)) {
                $this->bSelectRecords[] = $oRow;
            }
            mysqli_free_result($this->oQueryResult);
        }
        $this->aArrRec = $this->bSelectRecords;
        return $this->aArrRec;
    }

    /* Get Number of Records */
    function getNumberOfRecords() {
        return $this->iNoOfRecords;
    }

    /* Insert Records */
    // function insertRecords($sSqlQuery) {
    //     $this->bInsertRecords = mysqli_query($this->oDbLink, $sSqlQuery);
        
    //     if (!$this->bInsertRecords) {
    //         die("Insert Failed: " . mysqli_error($this->oDbLink));
    //     }

    //     $this->iInsertRecId = mysqli_insert_id($this->oDbLink);
    //     return $this->iInsertRecId;
    // }
    
    function insertRecords($sSqlQuery) {
        if (!is_string($sSqlQuery) || empty($sSqlQuery)) {
    die("SQL Error: Query is not a valid string. Query: " . var_export($sSqlQuery, true));
    }
    if (!$this->oDbLink) {
        die("Database connection is not valid.");
    }
    // $this->bInsertRecords = mysqli_query($this->oDbLink, $query);
        $this->bInsertRecords = mysqli_query($this->oDbLink, $sSqlQuery);
        
        if (!$this->bInsertRecords) {
            die("Insert Failed: " . mysqli_error($this->oDbLink));
        }

        $this->iInsertRecId = mysqli_insert_id($this->oDbLink);
        return $this->iInsertRecId;
    }


    /* Update Records */
    function updateRecords($sSqlQuery) {
        $result = mysqli_query($this->oDbLink, $sSqlQuery);
        
        if (!$result) {
            die("Update Failed: " . mysqli_error($this->oDbLink));
        }

        return mysqli_affected_rows($this->oDbLink);
    }

    /* Delete Records */
    function deleteRecords($sSqlQuery) {
        $result = mysqli_query($this->oDbLink, $sSqlQuery);
        
        if (!$result) {
            die("Delete Failed: " . mysqli_error($this->oDbLink));
        }

        return $result;
    }

    /* Destructor - Close Connection */
    function __destruct() {
        if ($this->oDbLink) {
            mysqli_close($this->oDbLink);
        }
    }
}
?>
