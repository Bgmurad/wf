
<?php
 function getUser($login) {
    $conn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,DB_USERNAME, DB_PASSWORD);
    $sql = "select name,birthday,mail,location,phone from person where mail=:mail";
    $request = $conn->prepare($sql);
    $request->bindValue(":mail",$login,PDO::PARAM_STR);
    try {
         $request->execute();
         $result = $request->fetchAll();
         if (count($result)) {
            $conn = null;
            return $result[0];
         }
         else  {
           $conn = null;
           return 0;
         }
      } catch (Exception $e) {
    throw new Exception("Не удалось пожключиться к базе данных!");
     }
    
 }
 
  function getAvatar($login) {
    $conn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,DB_USERNAME, DB_PASSWORD);
    $sql = "select file from avatar where person_mail=:mail";
    $request = $conn->prepare($sql);
    $request->bindValue(":mail",$login,PDO::PARAM_STR);
    try {
         $request->execute();
         $result = $request->fetchAll();
         if (count($result)) {
            $conn = null;
            return $result[0];
         }
         else  {
           $conn = null;
           return 0;
         }
      } catch (Exception $e) {
    throw new Exception("Не удалось пожключиться к базе данных!");
     }
    
 }
 
 

?>



<html>
 <head>
    <title>Вход в систему</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php header( 'Content-Type: text/html; charset=utf-8' );?>
    <link rel="stylesheet" type="text/css" href="/wf/style.css" />
 </head>

<body>
<div class="login-form">
 <p align="right">Choose language:</p>
 <table align="right">
 <tbody><tr>
 <td><a href="/wf/index.php"><img src="/wf/images/ru.gif" width="40" height="40" alt="rus"></a></td>
 <td><a href="/wf/index.php?lang=en"><img src="/wf/images/uk.gif" width="40" height="40" alt="eng"></a></td>
 </tr>
 </tbody></table>
  <br> <br> <br> <br>
 <fieldset>

 <div align="center" style="color:#FF0000">
    <?php if (isset( $content['error'])) {
     echo $content['error']; }?>
 </div>
 <br>
  <form action="index.php?action=logout" method="post">
   <?php 
     $account = getUser($_SESSION['user']);
   ?>
      <div  align="center">
       <header><h1 align="center">Добро пожаловать <?php echo($account["name"])?>!</h1></header>
             <div>
                Ваши профиль <br><br>
               Дата рождения: <?php echo ($account["birthday"]);?><br><br>
               E-mail: <?php echo ($account["mail"]);?><br><br>
               Номер телефона: <?php echo ($account["phone"]);?><br><br>
               Место нахождение: <?php echo ($account["location"]);?><br><br>
             </div><br>
             <br>
             <div>
               <img src=<?php echo(getAvatar($account["mail"])['file']); ?> > </img>
             </div>
	     <div>
	          <input type="submit" name="logout" value="Выйти" />
	     </div>
        </div>
    <div>
    </div>
  </fieldset>
 </form>
</div>
</body>
</html>

