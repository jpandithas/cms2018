<?php
/**
 * Date: 17-Jan-18
 * Time: 8:25 PM
 */
class URL
{
    protected $action;
    protected $type;
    protected $id;

    public function __construct()
    {
        $this->readURL();
    }

    protected function readURL()
    {
        if (!empty($_GET['q']))
        {
            $url_comp_array = explode('/',$_GET['q'],4);
            // $this->sanitizeURL($url_comp_array);
            $this->updateURL($url_comp_array);
        }
    }

    protected function updateURL($url)
    {
        if(is_array($url))
        {
            $this->action = $url[0];
            if(!empty($url[1])) {$this->type = $url[1];}
            if(!empty($url[2])) {$this->id = $url[2];}
            return True;
        }
        return False;
    }

    public function GetUrlComponentArray()
    {
        $url_array['action'] = $this->action;
        if(!empty($this->type)) {$url_array['type'] = $this->type;}
        if(!empty($this->id)) {$url_array['id'] = $this->id;}
        return $url_array;
     }

    public function Redirect($path="home")
    {
        $base_path = CMS_BASE_URI;
        if (strtolower($path) == "home")
        {
            header("Location:".$base_path);
        }
        else
        {
            header("Location:".$base_path."?q=".$path);
        }
    }
}

?>