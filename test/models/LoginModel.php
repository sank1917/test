<?php
    class LoginModel extends Model {

        public function checkUser() {
            $login = $_POST['login'];
		    $password = sha1($_POST['password']);  

            $sql = "SELECT * FROM user WHERE login = :login AND password = :password";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(":login", $login, PDO::PARAM_STR);
            $stmt->bindValue(":password", $password, PDO::PARAM_STR);
            $stmt->execute(); 

            $res = $stmt->fetch(PDO::FETCH_ASSOC);

            if(!empty($res)) {
                $_SESSION['user'] = $_POST['login'];
                header("Location: /site");
            } else {
                return false;
            }
        }

    }
?>