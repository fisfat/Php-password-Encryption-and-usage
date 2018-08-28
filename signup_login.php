<?php 

class core{
    public $db;

    //Database connection should be stored in the db variable
            //signup
public function signup($email, $password){
    
   $encryptedPassword = password_hash($password, PASSWORD_BCRYPT);

     $sql = "INSERT INTO table_name (email, password) VALUES(:email, :password)";
     $stmt = $this->db->prepare($sql);
     $stmt->execute(array(':email'=>$email, ':password'=>$encryptedPassword));
     echo $stmt ? 'signed up' : 'failed' ;

    }



            // Login
public function login($email, $pass){
    $sql = "SELECT password,status FROM users WHERE email = :email"; //status indicates maybe an account has been verified
    $stmt = $this->db->prepare($sql);
    $stmt->execute(array(':email'=>$email));
    if ($stmt->rowCount() == 1) {
                $row = $stmt->fetch();
                $password = $row[0];
                $status = $row[1];
         if ($status == false) {
                echo '<div class="alert alert-danger text-center">Email account have not been verified</div>';
        }else {
            if (password_verify($pass, $password)) {
                $sql2 = "SELECT id FROM users WHERE email = :email";
                $stmt2 = $this->db->prepare($sql2);
                $stmt2->execute(array(':email'=>$email));
                    if ($stmt2->rowCount() == 1) {
                            $row = $stmt2->fetch();
                            $id = $row[0];
                            return $id;
                    }else {
                            //errror message;
                    }
            }else {
                 echo '<div class="alert alert-danger text-center"> password incorrect </div>';      
            }
        }
    }else {
        echo '<div class="alert alert-danger text-center"> Email doesnt exist in database</div>';
        }
      }
}
