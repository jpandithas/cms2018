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

        $dbo = $this->dbo;  // new PDO(); //to get the methods SOS!!!

        $params = array();

        $sql = "SELECT mod_name from routes WHERE status = '1'";
        switch($UrlArrayCount)
        {
            case 1:
                $sql .= "AND action = ? LIMIT 1";
                $params[0] = $urlArray['action'];
                break;
            case 2:
                $sql .= "AND action = ? AND type = ? LIMIT 1";
                $params[0] = $urlArray['action'];
                $params[1] = $urlArray['type'];
                break;
            case 3:
                $sql .= "AND action = ? AND type = ? AND id = 1 LIMIT 1";
                $params[0] = $urlArray['action'];
                $params[1] = $urlArray['type'];
                break;
            default:
                return False;
                break;
        }

        $stmt = $dbo->prepare($sql);
        $result = $stmt->execute($params);


        if ($result)
        {
            $mod_name  = $stmt->fetch();
            return $mod_name['mod_name'];
        }

        return False;
    }

    public function GetActiveTheme()
    {
        $dbo = $this->dbo;

        $stmt = $dbo->prepare("SELECT theme_machine_name FROM themes WHERE status = 1 LIMIT 1");
        $result = $stmt->execute(array());

        if ($result)
        {
            $theme_machine_name = $stmt->fetch();
            return $theme_machine_name['theme_machine_name'];
        }
        return False;
    }

    public function DBAuthUser($username,$password)
    {
        $dbo = $this->dbo;

        if (empty($username) or empty($password)) return False;
        $usr = strip_tags($username);
        $pass = Security::CMS_Hash(strip_tags($password));

        $sql  = "SELECT `uid` from `users` WHERE `username`= ? AND `password` = ? ";
        $stmt = $dbo->prepare($sql);
        $result = $stmt->execute(array($usr,$pass));
        if ($result)
        {
            $uid = $stmt->fetch();
            return $uid['uid'];
        }
        return False;
    }

    public function GetUserDataFromID($uid)
    {
        $dbo  = $this->dbo;

        $sql = "SELECT username,userlevel FROM users WHERE uid = ? LIMIT 1";

        $stmt = $dbo->prepare($sql);
        $result  = $stmt->execute(array($uid));

        if ($result)
        {
            $user = $stmt->fetch();
            return array("username" => $user['username'],"userlevel" => $user['userlevel']);
        }
        return False;
    }

    public function GetSidebarItems()
    {
        $dbo = $this->dbo;

        $sql = "SELECT action,type,mod_real_name FROM routes WHERE status=1";

        $stmt = $dbo->prepare($sql);
        $result  = $stmt->execute(array());

        if ($result)
        {
            $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $items;
        }
    }
}

?>