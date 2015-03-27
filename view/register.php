<html>

 <head>
    <title>Registration form</title>
    <link rel="stylesheet" type="text/css" href="/wf/style.css" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <?php header( 'Content-Type: text/html; charset=utf-8' );?>
 </head>
 
 <script type="text/javascript">

 function IsValidateEmail(email) {
     var atpos=email.indexOf("@");
     var dotpos=email.lastIndexOf(".");
   if (atpos<1 || dotpos<atpos+2 || dotpos+2>=email.length)
    {
      return false;
     }
  return true;
 }

 function check() {
      var name = document.getElementById('name');
      var email = document.getElementById('mail');
      var location = document.getElementById('location');
      var password = document.getElementById('password');  
      var cpassword = document.getElementById('cpassword');       
      var sex = document.getElementsByName('sex');       
      var birthday = document.getElementsByName('birthday');
      var birthmonth = document.getElementsByName('birthmonth');      
      var birthyear = document.getElementsByName('birthyear');      
      var phone = document.getElementById('phone');             
                                                                                   
      if (name.value.length<4){
          alert('Имя не может быть меньше 4-х символов!');
          return false;
       }
      if( !(/^[a-zA-Zа-яА-Я ]+$/.test(name.value))){
          alert('Имя должено состоять из комбинации букв!');
          return false;
      }
      if( !(/^[a-zA-Z0-9]+$/.test(password.value))){
          alert('Пароль должен состоять из комбинации латинских букв!');
          return false;
      }
      if (password.value != cpassword.value){
         alert('Пароли не совпадают!');
         return false;
       }
      if (password.value.length<2){
          alert('Пароль не может быть меньше двух символов!');
          return false;
      }
     if(!IsValidateEmail(email.value) || !(/^[0-9a-zA-Z@.-_]+$/.test(email.value))){
        alert("E-Mail указан неверно!");
        return false;
      }
     if (location.value.length<2){
        alert('Место проживания не может быть меньше двух символов');
        return false;
      }
      if(!(/^[a-zA-Zа-яА-Я ]+$/.test(location.value))){	
          alert('Место проживание  должено состоять из комбинации букв!');
          return false;
      }
      if ((phone.value.length<4) || !(/^[0-9]+$/.test(phone.value))){
         alert('Номер телефона не может быть меньше 4-х цифр и должен состоять только из цифр');
         return false;
       }
   return true;
 }
 </script>

<body>
 <div class="reg-form">
 <p align="right">Choose language:</p>
 <table align="right">
   <tbody>
      <tr>
        <td><a href="/wf/view/register.php"><img src="/wf/images/ru.gif" width="40" height="40" alt="rus"></a></td>
        <td><a href="/wf/view/register-en.php"><img src="/wf/images/uk.gif" width="40" height="40" alt="eng"></a></td>
      </tr>
   </tbody>
 </table>
 <br> <br> <br> <br>
 <fieldset>
 <h1 align="center">Регистрация</h1>
 <div align="center" style="color:#FF0000">
    <?php 
     include("../config.php");
      $_SESSION['publickey'] = publickey;
      if (isset( $content['error']) ) {
	  echo $content['error'];
	} ?>
  </div>

 <form action="/wf/index.php?action=registration" method="post" align="center" onsubmit="return check()" ENCTYPE="multipart/form-data">

	    <p><label for="name">Фамилия Имя</label>
    	    <br><input type="text" name="name" id="name" placeholder="Введите имя пользователя" required autofocus size="50" maxlength="100" /></p>
    	    <p><label for="password">Пароль</label>
    	    <br><input type="password" name="password" id="password" placeholder="Введите пароль" required size="50" maxlength="20" /></p>
    	    <p><label for="password">Повторите пароль</label>
    	    <br><input type="password" name="cpassword" id="cpassword" placeholder="Повторно введите пароль, для подтверждения" required size="50"  maxlength="20" /></p>
	    <p><label for="mail">Ваш электронный адрес</label>
    	    <br><input type="text" name="mail" id="mail" placeholder="E-mail, например user@mail.ru" required maxlength="50" size="50"/>
	    <p><label for="location">Место проживания</label>
    	    <br><input type="text" name="location" id="location" placeholder="Место проживания" required  maxlength="50" size="50"/>
	    <p></p>
    	    <div>
                <label for="birthday">Дата рождения</label><br>
    	         <select id="birthday" name="birthday">
    	    	    <option selected="selected" value="">День</option>
    	    	    <?php
    	    	      for ($d=1;$d<32;$d++) {
    	    	        echo ("<option value=$d>$d</option>");
    	    	      }
    	    	    ?>
    	         </select>
    	        <select id="birthmonth" name="birthmonth">
    	           <option selected="selected" value="">Месяц</option>
    	    	    <option value="1">Январь</option>
    	    	    <option value="2">Февраль</option>
    	    	    <option value="3">Март</option>
    	    	    <option value="4">Апрель</option>
    	    	    <option value="5">Май</option>
    	    	    <option value="6">Июнь</option>
    	    	    <option value="7">Июль</option>
    	    	    <option value="8">Август</option>
    	    	    <option value="9">Сентябрь</option>
    	    	    <option value="10">Октябрь</option>
    	    	    <option value="11">Ноябрь</option>
    	    	    <option value="12">Декабрь</option>
    	        </select>
                <select id="birthyear" name="birthyear">
            	    <option selected="selected" value="">Год</option>
            	    <?php
    	    	      for ($y=2015;$y>1910;$y--) {
    	    	        echo ("<option value=$y>$y</option>");
    	    	      }
    	    	    ?>
                </select>
            </div>
	    <p>
    	    <input type="radio" name="sex" id="sexm" value="m"> Мужской
    	    <input type="radio" name="sex" id="sexw" value="w"> Женский
	    <p><label for="phone">Ваш номер телефона</label>
    	    <br><input type="text" name="phone" id="phone" placeholder="Пример:89281234567" required autofocus maxlength="20" size="50"/>
    	    <br><p>Ваше фото: <input type="file" name="avatar" id="avatar"></p>
          <div class="buttons">
             <input type="submit" name="register" value="Зарегистрироваться" />
	  </div>
       </fieldset>
 </form>
</div>
</body>
</html>