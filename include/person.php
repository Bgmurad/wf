<?php
 class Person {
  public $name;
  public $mail;
  public $birthday;
  public $sex;
  public $location;
  public $phone;
  public $password;
  
 public function __construct($name,$birthday,$sex,$location,$mail,$phone, $password) {
    if (isset($name)) $this->name = $name;
    if (isset($mail)) $this->mail = $mail;
    if (isset($password)) $this->password = $password;
    if (isset($birthday)) $this->birthday = $birthday;
    if (isset($sex)) $this->sex = $sex;
    if (isset($location)) $this->location = $location;
    if (isset($phone)) $this->phone = $phone;
  }


 public function savePerson() {
      $conn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,DB_USERNAME, DB_PASSWORD);
      $sql = "insert into person (name,mail,password,birthday,sex,location,phone)  values (:name,:mail, :password,STR_TO_DATE(:birthday,'%Y-%c-%e'),:sex,:location,:phone)";
      echo ($this->birthday);
      $request = $conn->prepare($sql);
      $request->bindValue(":name",$this->name,PDO::PARAM_STR);
      $request->bindValue(":mail",$this->mail,PDO::PARAM_STR);      
      $request->bindValue(":sex",$this->sex,PDO::PARAM_STR);
      $request->bindValue(":password",$this->password,PDO::PARAM_STR);
      $request->bindValue(":birthday",$this->birthday,PDO::PARAM_STR);      
      $request->bindValue(":location",$this->location,PDO::PARAM_STR);      
      $request->bindValue(":phone",$this->phone,PDO::PARAM_STR);            

      try {
          if ($request->execute()) {
             $this->id = $conn->lastInsertId();
             $conn = null;
             return true;
          }
          else  {
             $conn = null;
             return false;
          }
     } catch (Exception $e) {
            throw new Exception("Не удалось пожключиться к базе данных!");
      }
 }
 
 public function saveAvatar($avatarfile,$mail) {
        $avatardir = "images/";
        $avatarfile = $avatardir.str_replace('@','-',$mail);
        $avatarfile = $avatarfile.strrchr($_FILES['avatar']['name'],'.');

        $conn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,DB_USERNAME, DB_PASSWORD);
        $sql = "insert into avatar (person_mail,file)  values (:person_mail, :file)";
        $request = $conn->prepare($sql);
        $request->bindValue(":person_mail",$mail,PDO::PARAM_STR);
        $request->bindValue(":file",$avatarfile,PDO::PARAM_STR);
        
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $avatarfile)) {
             $request->execute();
             echo "File is valid, and was successfully uploaded.\n";
             $conn = null;
        } else {
               echo "File uploading failed.\n";
             $conn = null;               
        }
 }
 
}
?>