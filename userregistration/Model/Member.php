<?php
namespace Phppot;

class Member
{

    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/../lib/DataSource.php';
        $this->ds = new DataSource();
    }


    /**
     * to signup / register a user
     *
     * redirects to home page after registration
     */
    public function registerMember()
    {
    	
    	session_start();
    	$memberRecord = $this->getMember($_POST["username"]);
    	$_SESSION["username"] = $memberRecord[0]["username"];
    	session_write_close();
    	header("Location: http://localhost/userregistration/home.php");
    	
		    }

		    /**
		     * rerive user details from Database
		     *
		     * @return records from Database for specified username
		     */
		    
    public function getMember($username)
    {
        $query = 'SELECT * FROM tbl_member where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }
}