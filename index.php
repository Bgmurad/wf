/*
* Контроллер, обработчик  запросов пользователя. По умолчанию октрывается страничка с приветствием и запросом логина и пароля.
* Для не зарегистрированных  пользователей, отображается ссылка на регистрационную форму.
*/

<?php
require ("config.php");
require("include/person.php");

session_start();
$action = isset($_GET['action']) ? $_GET['action'] : "";
$user = isset($_SESSION['user']) ? $_SESSION['user'] : "";

 if ($action != "login" && $action != "logout" && !$user) {
   login();
     exit;
     }

 switch ( $action ) {
  case 'login':
      login();
      break;
  case 'logout':
      logout();
      break;
  case 'registration':
      registration();
      break;
  default:
      login();
  }


 function login() {

     if ( isset($_POST['login'] ) ) {
         // Пользователь получает форму входа: попытка авторизировать пользователя
         $user = cleanStr($_POST['user']);
         $user = filter_var($user, FILTER_SANITIZE_EMAIL);
         $pass = cleanStr($_POST['password']);
         if (checkUser($user,$pass)) {
         // Вход прошел успешно: создаем сессию и перенаправляем на страницу администратора
             $_SESSION['user'] = $_POST['user'];
             if (isset($_GET['lang']) && ($_GET['lang']=='en')) {
                 require("view/profile-en.php");
                }
            else require("view/profile.php");
        } else {
             // Ошибка входа: выводим сообщение об ошибке для пользователя
            $content['error'] = "Извините, имя пользователя или пароль неверны - пожалуйста, попробуйте еще раз.";
            if (isset($_GET['lang']) && ($_GET['lang']=='en')) {
                require("view/login-en.php");
                }
            else require("view/login.php");
            }
     } else {
             // Пользователь еще не получил форму: выводим форму
              if (isset($_GET['lang']) && ($_GET['lang']=='en')) {
                  require("view/login-en.php");
                 }
              else require("view/login.php");

           }
 }

 function logout() {
    unset( $_SESSION['user'] );
    header( "Location: index.php" );
    exit;
  }
  
 function registration() {

  if (isset($_POST['name'],$_POST['password'],$_POST['birthday'],$_POST['birthmonth'],$_POST['birthyear'],$_POST['mail'],$_POST['sex'],$_POST['location'],$_POST['phone'])) {
    $name = cleanStr($_POST['name']);
    $password = cleanStr($_POST['password']);
    $birthday = cleanStr($_POST['birthyear'])."-".cleanStr($_POST['birthmonth'])."-".cleanStr($_POST['birthday']);
    $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
    $sex = cleanStr($_POST['sex']);
    $location = cleanStr($_POST['location']);
    $phone = cleanStr($_POST['phone']);
   }
   else {
       $content['error'] = "Внимание! Остались не заполненые поля. Повторите ввод, пожалуйста!";   
       if (isset($_GET['lang']) && ($_GET['lang']=='en')) {
           $content['error'] = "Error! There are not filled fields. Re-enter, please!";
           require("view/register-en.php");
           exit;
           }
       else  {
    	    require("view/register.php");
	   exit;
	   }
   }
   
     $imageinfo = getimagesize($_FILES['avatar']['tmp_name']);
     if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
        echo "Только  GIF или  JPEG картинки";
        exit;
        }
     else {
         $blacklist = array(".php", ".phtml", ".php3", ".php4", ".php5");
	 foreach ($blacklist as $item) {
    	    if(preg_match("/$item\$/i", $_FILES['avatar']['name'])) {
        	echo "Нельзя загружать PHP файлы\n";
                exit;
             }
          }
     }

  try {
      $persona = new Person($name,$birthday,$sex,$location,$mail,$phone, $password);
        if ($persona->savePerson()) {
            $persona->saveAvatar($_FILES['avatar']['name'],$mail);
           $_SESSION['user'] = $mail;
           require("view/profile.php");
           exit;
           }
        else {
            $content['error'] = "Такой E-mail уже существует!";
	    if (isset($_GET['lang']) && ($_GET['lang']=='en')) {
        	$content['error'] = "Such email . Re-enter, please!";
                require("view/register-en.php");
                exit;
             }
            else {
        	require("view/register.php");
                return;    	
            }
        }
   } catch (Exception $e) {
           require("view/error.php" );
    } 

 }
 
 function cleanStr($string)
 {
    $filtred = filter_var($string, FILTER_SANITIZE_STRING);
    $detagged = strip_tags($filtred);
    $escaped = addslashes($detagged);
    return $escaped;
 }
 
 function checkUser($login,$passwd) {
    $conn = new PDO(DB_TYPE.":host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,DB_USERNAME, DB_PASSWORD);
    $sql = "select id from person where mail=:mail and password=:password";
    $request = $conn->prepare($sql);
    $request->bindValue(":mail",$login,PDO::PARAM_STR);
    $request->bindValue(":password",$passwd,PDO::PARAM_STR);
    try {
         $request->execute();
         if (count($request->fetchAll())) {
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

?>