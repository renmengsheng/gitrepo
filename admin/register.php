<?php
//register

class Register{
    private $username;  //user name
    private $db;        //database
    private $email;
    private $pwd;       //password
    private $con;       //confirm password
    private $code;      //captcha
    public function __construct() {
        if (!isset($_POST['type'])){
            echo "<script>alert('Access denied!');history.go(-1);</srcipt>";
            exit();
        }
        require '../config.php'; // include configuration file
        $this->db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('Failed to connect to DB');
            
    }
    
    public function uniqueName(){   //unique user name
        if ('xmlhttprequest' == strtolower($_SERVER['HTTP_X_REQUEST_WITH'])){
            $this->username = $_POST['username'];
            $sql = "SELECT count(*) FROM users WHERE username = '" . $this->username . " ' ";
            $count = mysqli_fetch_row($this->db->query($sql));
            if ($count){ //$count != 0, same user name
                echo '1';
            }else{
                echo '0';
            }
        }else{  //not ajax mode
            echo 'hello world';
        }
    }//
    
    //check email
    public function uniqueEmail(){
        if(isset($_SERVER[HTTP_X_REQUESTED_WITH])){
            if('xmlhttprequest' == strtolower($_SERVER[HTTP_X_REQUESTED_WITH])){
                $this->email = $_POST['email'];
                $sql = "SELECT COUNT(*) FORM WEB WHERE email = ' " . $this->email . " ' ";
                $count = mysqli_fetch_row($this->db->query($sql));
                if ($count){
                    echo '1';
                }else{
                    echo '0';
                }
            }else{
                echo 'hello world';
            }
        }else{
            echo 'hello world';
        }
    }
    
    //Check captcha
    public function checkCode(){
        if ($this->code != $_SESSION['code']){
            echo "<script>alert('Verification code is not correct. Please try again!');history.go(-1);</script>";
            exit();
        }
    }
    
    //Check email format
    public function checkEmailFormat(){
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (!preg_match($pattern,$this->email)){
            echo "<script>alert('Email format incorrect, please try again');history.go(-1);</script>";
            exit();
        }
    }
    
    public function checkNameFormat(){
        $length = strlen($this->username);
        if (trim($this->username) == '' || $length < 2 || $length >20){
            echo "<script>alert('User name format incorrect.please try again!');history.go(-1);</script>";
            exit();
        }
    }
    
    public function checkPwd(){
        //6 - 20 length
        if (trim($this->pwd) == '' || strlen($this->pwd) <6 || strlen($this-pwd) > 20){
            echo "<script>alert('Password format incorrect, please check and try again!');history.go(-1);</script>";
            exit();
        }
        $this->pwd = md5($this->pwd);
    }
    
    //register
    public function doRegister(){
        $this->email = $_POST['email'];
        $this->username = $_POST['username'];
        $this->code = $_POST['code'];
        $this->pwd = $_POST['password'];
        $this->con = $_POST['confirm'];
        $this->checkCode();
        $this->checkPwd();
        $this->checkNameFormat();
        $this->checkEmailFormat();
        $sql = "INSERT INTO users (username, email, password) VALUES ('" . $this->username . "',"
                . "'" . $this->email . "', '" . password . "')";
        $result = $this->db->query($sql);
        if ($result){
            $this->db->close();
            echo "<script>alert('Successful registration, please login!');location.href = '../index.php';</script>";
            exit();
        }
    }
}$reg = new Register();
switch ($_POST['type']){
    case 'name':
        $reg->uniqueName();
        break;
    case 'email':
        $reg->uniqueEmail();
        break;
    case 'all':
        $reg->doRegister();
        break;
    default:
        echo 'hello worrld';
        break;
}
