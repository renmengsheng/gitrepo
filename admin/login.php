<?php
/**** Login ****/
class Login{
    private $email;
    private $password;
    private $code;
    public function __construct() {
        if (!isset($_POST['login'])){ //Not POST method
            echo "<script>alert('The page is not exist!');history.go(-1);</script>";
            exit();
    }
    require'../config.php';
    $this->email = $_POST['email'];
    $this->password = $_POST['password'];
    $this->code = $_POST['code'];
    
    
    }
    
    public function checkEmailFormat(){
        $pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
        if (!preg_match($pattern,$this->email)){
            echo "<script>alert('Email format incorrect, please try again');history.go(-1);</script>";
            exit();
        }
    }
    
    public function checkPwd(){
        if (!trim($this->password) == ''){
            $strlen = strlen($this->password);
            if ($strlen < 6 || $strlen > 20){
                echo "<script>alert('Password length illegal. please try again!');history.go(-1);</script>";
                exit();
            }else{
                $this->password = md5($this->password);
            }
        }else{
            echo "<script>alert('Password cannot be blank, please try again!');history.go(-1);";
            exit();
        }
    }
    
    //user name
    public function checkUser(){
        $db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('Failed to connect to db!');
        $sql = "SELECT username FROM users WHERE email = '" . $this->emai . "' AND password = '" . $this->password . "'";
        $result = mysqli_fetch_row($db->query($sql));
        if (!$result){
            echo "<script>alert('Email or password is incorrect, please try again!');history.go(-1);";
            exit();
        }else{
            $_SESSION['user'] = $result;
            $db->close();
            echo "<script>alert('Login successfully!');Location.href = 'localhost:8080';</script>";
            exit();
        }
    }
    
    public function doLogin(){
        $this->checkCode();
        $this->checkMail();
        $this->checkPwd();
        $this->checkUser();
    }
}

$login = new Login();
$login->doLogin();