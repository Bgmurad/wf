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
 <header><h1 align="center">Добро пожаловать!</h1></header>
 <div align="center" style="color:#FF0000">
    <?php if (isset( $content['error'])) {
     echo $content['error']; }?>
 </div>
 <br>
  <form action="index.php?action=login" method="post">

      <div  align="center">
             <div>
               <label for="user"><u>Л</u>огин</label>
               <input id="user" name="user" type="text" placeholder="Введите Ваш E-mail" required  value="">
             </div><br>
             <div>
               <label for="password"><u>П</u>ароль</label>
               <input id="password"  name="password" type="password" placeholder="Введите пароль" required>
             </div>
             <br>
	     <div>
	          <input type="submit" name="login" value="Войти" />
	     </div>
             
              <div>
                 <p>Еще не зарегистрированы у нас на сайте? <br>  Перейдите по <a href="view/register.php"> ссылке </a> для регистрации </p>
            </div>
        </div>
    <div>
    </div>
  </fieldset>
 </form>
</div>
</body>
</html>