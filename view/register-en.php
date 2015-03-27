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
          alert('Too short name length');
          return false;
       }
       if( !(/^[a-zA-Zа-яА-Я ]+$/.test(name.value))){
           alert('The name  can contain only letters');
           return false;
         }
      if( !(/^[a-zA-Z0-9]+$/.test(password.value))){
         alert('The password can contain only letters and digits');
         return false;
        }
      if (password.value != cpassword.value){
         alert('Passwords not match');
         return false;
       }
      if (password.value.length<2){
          alert('Password must be more than 2 chars');
          return false;
      }
     if(!IsValidateEmail(email.value) || !(/^[0-9a-zA-Z@._-]+$/.test(email.value))){
        alert("E-Mail not correct");
        return false;
      }
      if(!(/^[a-zA-Zа-яА-Я ]+$/.test(name.value))){
         alert('The location  can contain only letters' );
         }
      if (location.value.length<2){
        alert('Location must be more than 2 chars');
        return false;
      }
      if ((phone.value.length<4) || !(/^[0-9]+$/.test(phone.value))){
         alert('Phone number must be more 4 digits and contain only digits');
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
        <td><a href="register.php"><img src="/wf/images/ru.gif" width="40" height="40" alt="rus"></a></td>
        <td><a href="register-en.php"><img src="/wf/images/uk.gif" width="40" height="40" alt="eng"></a></td>
      </tr>
   </tbody>
 </table>
  <br> <br> <br> <br>
<fieldset> 
 <h1 align="center">Registration</h1>
 <div align="center" style="color:#FF0000">
    <?php if (isset( $content['error']) ) {
	  echo $content['error'];
	} ?>
  </div>

 <form action="/wf/index.php?action=registration&lang=en" method="post" align="center" onsubmit="return check()">

	    <p><label for="name">Name</label>
    	    <br><input type="text" name="name" id="name" placeholder="Enter first name and surname" required autofocus size="50" maxlength="100" /></p>
    	    <p><label for="password">Password</label>
    	    <br><input type="password" name="password" id="password" placeholder="Enter password" required size="50" maxlength="20" /></p>
    	    <p><label for="password">Confirm password</label>
    	    <br><input type="password" name="cpassword" id="cpassword" placeholder="Re-enter password" required size="50"  maxlength="20" /></p>
	    <p><label for="mail">Enter Email</label>
    	    <br><input type="text" name="mail" id="mail" placeholder="example user@mail.ru" required maxlength="50" size="50"/>
	    <p><label for="location">Location</label>
    	    <br><input type="text" name="location" id="location" placeholder="City" required  maxlength="50" size="50"/>
	    <p></p>
    	    <div>
                <label for="birthday">Date of birth</label><br>
    	         <select id="birthday" name="birthday">
    	    	    <option selected="selected" value="">Day</option>
    	    	    <?php  
            	      for ($d=1;$d<32;$d++) {
            	        echo ("<option value=$d>$d</option>");
            	      }
            	    ?> 
    	         </select>
    	        <select id="birthmonth" name="birthmonth">
    	           <option selected="selected" value="">Month</option>
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
            	    <option selected="selected" value="">Year</option>
            	    <?php  
            	      for ($y=2015;$y>1910;$y--) {
            	        echo ("<option value=$y>$y</option>");
            	      }
            	    ?> 
                </select>
            </div>

	    <p>
    	    <input type="radio" name="sex" value="m" checked> Male
    	    <input type="radio" name="sex" value="w"> Female
	    <p><label for="phone">Phone number</label>
    	    <br><input type="text" name="phone" id="phone" placeholder="Example:89281234567" required autofocus maxlength="20" size="50"/>
         <div class="buttons">
            <input type="submit" name="register" value="Create Account" />
  	 </div>
      </fieldset>
 </form>
</div>
</body>
</html> 