<?php
/*
 * Author:
 * Date: May2015
 * Name: login.class.php
 * Description: This class defines a method called "display", which displays all electronics.
 */

namespace warehouse_mvc\views\user\login;

class Login extends \warehouse_mvc\views\user\UserIndexView {
    
    
    public function display($login) {
        //display page header
        parent::displayHeader("User Login");

if (isset($_GET['ls']))
    $login_status = $_GET['ls'];

if ($login_status == 1){
    echo "<p>You are logged in as ", $_SESSION['login'], "</p>";
    echo "<a href='logout.php'>Log out</a><br />";
} else if ($login_status == 2) {
    echo "<p>Incorrect user name/password combination.</p>";    
}else if ($login_status == 3) {
    echo "<p>Thank you. Your account has been created.</p>";
    echo "<a href='logout.php'>Log out</a><br />";
}else { 
   echo "<p>You are not logged in. Please login or <a href='registrationform.php'>create</a> a new account.</p>";
       
}

if ($login_status !=1 && $login_status !=3){
  

?>
    <form id="login" method='post' action='login.php'>
        <table frame='border' style='padding:30px'>
            <tr>    
                <td>User name: </td>
                <td><input type='text' name='username'></td>
            </tr>
            <tr>
                <td>Password: </td>
                <td><input type='password' name='password'></td>
            </tr>
            <tr>
                <td colspan='2' align='center'><input type='submit' value='Log in'></td>
            </tr>
        </table>
    </form>
<?php }


    }
}