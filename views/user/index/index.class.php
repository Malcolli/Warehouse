<?php
/*
 * Author: Louie Zhu
 * Date: Dec. 24, 2014
 * Name: index.class.php
 * Description: This class defines a method called "display", which displays all electronics.
 */

namespace warehouse_mvc\views\user\index;

class Index extends \warehouse_mvc\views\user\UserIndexView {
    /*
     * the display method accepts an array of electronic objects and displays
     * them in a grid.
     */

    public function display($users) {
        //display page header
        parent::displayHeader("Login");
        ?>
        <div id="main-header">Electronics in the Warehouse</div>

        <div class="grid-container">
            
           <h2>Create a new Warehouse account</h2>
           
<p>All fields are required.</p>

<form action="register.php" method="post">
    <table width="300" cellspacing="0" cellpadding="3" style="border: 1px solid #000000; padding:5px; margin-bottom: 10px">
  <tr>
      <td align="right" width="80">First Name: </td>
    <td><input name="firstname" type="text" /></td>
  </tr>
  <tr>
      <td align="right" width="80">Last Name: </td>
    <td><input name="lastname" type="text" /></td>
  </tr>
        <tr>
      <td align="right" width="80">User Name: </td>
    <td><input name="username" type="text" /></td>
  </tr>
  <tr>
    <td align="right">Password</td>
    <td><input name="password" type="password" /></td>
  </tr>
 
</table>
    <input type="submit" name="Submit" id="Submit" value="Register" />
</form>

                   
                 
        </div>
       
        <?php
    }

    public static function displayFooter() {
        parent::displayFooter();
    }
}
