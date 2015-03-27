<html>

 <head>
    <title>Enter</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php header( 'Content-Type: text/html; charset=utf-8' );?>
    <link rel="stylesheet" type="text/css" href="/wf/style.css" />
 </head>

<body>
<div   class="login-form">
 <p align="right">Choose language:</p>
 <table align="right">
 <tbody><tr>
 <td><a href="/wf/index.php"><img src="/wf/images/ru.gif" width="40" height="40" alt="rus"></a></td>
 <td><a href="/wf/index.php?lang=en"><img src="/wf/images/uk.gif" width="40" height="40" alt="eng"></a></td>
 </tr>
 </tbody></table>
  <br> <br> <br> <br>
 <fieldset>
 <header><h1 align="center">Welcome!</h1></header>
 <div align="center" style="color:#FF0000">
    <?php if (isset( $content['error'])) {
     echo $content['error']; }?>
 </div>
 <br>
  <form action="index.php?action=login&lang=en" method="post">
     <div align="center">
              <div>
               <label for="user">Login&nbsp&nbsp&nbsp&nbsp</label>
               <input id="user" name="user" type="text" placeholder="Enter your E-mail" required  value="">
             </div> <br>
             <div>
               <label for="password">Password</label>
               <input id="password"  name="password" type="password" placeholder="Enter password" required>
             </div>
             <br>
	     <div>
	          <input type="submit" name="login" value="Enter" />
	     </div>
             <div>
                 <p>You are not yet registered? <br> Follow the <a href="view/register-en.php"> link </a> for registration</p>
            </div>
        </div>
    <div>
    </div>
  </fieldset>
 </form>
</div>
</body>
</html>