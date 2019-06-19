<?php include 'config.php';
    
    function db($params = array())
    {
        if (isset($params['hostname'])) {
            $hostname = $params['hostname'];
        } else {
            $hostname = CONF_HOSTNAME;
        }

        if (isset($params['username'])) {
            $username = $params['username'];
        } else {
            $username = CONF_USERNAME;
        }

        if (isset($params['password'])) {
            $password = $params['password'];
        } else {
            $password = CONF_PASSWORD;
        }

        if (isset($params['database'])) {
            $database = $params['database'];
        } else {
            $database = CONF_DATABASE;
        }

        $conn = new mysqli($hostname, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }

    function Q_array($sql = null)
    {
        $db = db();
        
        if ($sql === null) {
            return null;
        } else {
            if ($result = $db->query($sql)) 
            {
                return $result->fetch_all(MYSQLI_ASSOC);

                $result->free();
            }

            /* close connection */
            $db->close();
        }
    }

    function Q_execute($sql = null)
    {
        $db = db();
        
        if ($sql === null) {
            return null;
        } else {
            if ($result = $db->query($sql)) 
            {
                return $result;

                $result->free();
            }

            /* close connection */
            $db->close();
        }
    }

    function Q_count($sql = null)
    {
        $db = db();
        
        if ($sql === null) {
            return null;
        } else {
            if ($result = $db->query($sql)) 
            {
                return $result->num_rows;

                $result->free();
            }

            /* close connection */
            $db->close();
        }
    }

    function Q_mres($param = null){
        $db = db();

        if ($param === null) {
            return null;
        } else {
            return mysqli_real_escape_string($db, $param); 
        }
    }

    function redirect_to($page=null, $time=0.1)
    {
        if($page !== null){
            echo "<meta http-equiv='refresh' content='". $time ."; url=". $page ."'>";
        }
    }

    function site_url($slash=false)
    {
        $dir_project = CONF_DIR_PROJECT;
        $http_host = $_SERVER['HTTP_HOST'];
        $https_check = (!empty($_SERVER['HTTPS']) ? 'https' : 'http');

        if($slash){
            $siteurl =  $https_check . '://' . $http_host . '/' .$dir_project.'/';
        } else {
            $siteurl =  $https_check . '://' . $http_host . '/' .$dir_project;
        }

        return $siteurl;
    }

    function your_position(){
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $actual_link;
    }

    function session_me(){
        if(isset($_SESSION['login'])){
            if($_SESSION['login']){
                return true;
            }
        }

        return false;
    }

    /*function base_url($extnd = null)
    {
        $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';
        $url = str_replace("/index.php","", $_SERVER['SCRIPT_NAME']);
        $parse_url = explode("/", $url);
        $parse_url_end = end($parse_url);
        $clean_url = str_replace($parse_url_end, "", $url);

        if ($extnd == null)
        {
            $final_url = $clean_url;
        } else {
            $final_url = $clean_url . "" . $extnd;
        }

        $ret = "$http" . $_SERVER['SERVER_NAME'] . "" . $final_url;

        return  $ret;
    }

    function site_url($extnd = null)
    {
        $http = 'http' . ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? 's' : '') . '://';
        $url = str_replace("/index.php","", $_SERVER['SCRIPT_NAME']);

        if ($extnd == null)
        {
            $final_url = $url;
        } else {
            $final_url = $url."/".$extnd;
        }

        $ret = "$http" . $_SERVER['SERVER_NAME'] . "" . $final_url;

        return $ret;
    }*/
    