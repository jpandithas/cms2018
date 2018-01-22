<?php
/**
 * Date: 22-Jan-18
 * Time: 7:20 PM
 */

class DB
{

    protected $dbo;

    public function __construct()
    {
        try {
            $this->dbo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
        }
        catch(PDOException $e)
        {
            $this->dbo = $e->errorInfo;
        }
    }

    public function testDB()
    {
        if (is_a($this->dbo,'PDO',True))
        {
            return True;
        }
        return False;
    }

    public function GetModuleFromDB(URL $url)
    {
        $urlArray = $url->GetUrlComponentArray();
        $UrlArrayCount  = count($urlArray);

        $stmt = $this->dbo;

        $sql = "SELECT mod_name from routes WHERE status = '1'";
        switch($UrlArrayCount)
        {
            case 1:
                $sql .= "AND action = ? LIMIT 1";
                break;
            case 2:
                $sql .= "AND action = ? AND type = ? LIMIT 1";
                break;
            case 3:
                $sql .= "AND action = ? AND type = ? AND id = 1 LIMIT 1";
                break;
            default:
                return False;
                break;
        }


    }

}

?>