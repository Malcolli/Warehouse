<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


namespace warehouse_mvc\views\user\create;

class Create extends \warehouse_mvc\views\user\UserIndexView {
    
    public function display($user, $confirm = "") {
        //display page header
        parent::displayHeader("Creat A User ");

        //retrieve electronic details by calling get methods
        $id = $user->getId();
        $firstname = $user->getFirstName();
        $lastname = $user->getLastName();
        $username = $user->getUserName();
        $password = $user->getPassword();
        $role = $user->getRole();
    }
}
?>
<div id="main-header">Create a new Warehouse User Account</div>
<p>All fields are required.</p>

<form action="create_user" method="post">
    <table width="300" cellspacing="0" cellpadding="3" style="border: 1px solid #000000; padding:5px; margin-bottom: 10px">
  <tr>
      <td align="right" width="80">First Name: </td>
    <td><input name="firstname" type="text" required placeholder="Enter a first name" /></td>
  </tr>
  <tr>
      <td align="right" width="80">Last Name: </td>
    <td><input name="lastname" type="text" required placeholder="Enter a last name" /></td>
  </tr>
        <tr>
      <td align="right" width="80">User Name: </td>
    <td><input name="username" type="text" required placeholder="Enter a valid Username" /></td>
  </tr>
  <tr>
    <td align="right">Password</td>
    <td><input name="password" type="password" required placeholder="Enter a valid password" /></td>
  </tr>
 
</table>
    <input type="submit" name="Submit" id="Submit" value="Register" />
</form>