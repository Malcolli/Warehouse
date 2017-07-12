<?php
/*
 * Author: Louie Zhu
 * Date: Oct 28, 2012
 * File: error.class.php
 * Description:
 *
 */
namespace warehouse_mvc\views\electronic\error;
class Error extends \warehouse_mvc\views\electronic\ElectronicIndexView {

    public function display($message) {

        //display page header
        parent::displayHeader("Error");
        ?>

        <div id="main-header">Error</div>
        <hr>
        <table style="width: 100%; border: none">
            <tr>
                <td style="vertical-align: middle; text-align: center; width:100px">
                    <img src='<?= BASE_URL ?>/www/img/error.jpg' style="width: 80px; border: none"/>
                </td>
                <td style="text-align: left; vertical-align: top;">
                    <h3> Sorry, but an error has occurred.</h3>
                    <div style="color: red">
                        <?= urldecode($message) ?>
                    </div>
                    <br>
                </td>
            </tr>
        </table>
        <br><br><br><br><hr>
        <a href="<?= BASE_URL ?>/electronic/index">Back to electronic list</a>
        <?php
        //display page footer
        parent::displayFooter();
    }

}