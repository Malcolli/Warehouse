<?php
/*
 * Author: Louie Zhu
 * Date: Dec. 24, 2014
 * Name: view_furniture.class.php
 * Description: This class defines a method "display"
 * The method accepts a Furniture object and displays the details of the furniture in a table.
 */

namespace warehouse_mvc\views\furniture\detail;

class Detail extends \warehouse_mvc\views\furniture\FurnitureIndexView {

    public function display($furniture, $confirm = "") {
        //display page header
        parent::displayHeader("Furniture Details");

        //retrieve furniture details by calling get methods
        $id = $furniture->getId();
        $product = $furniture->getProduct();
        $brand = $furniture->getBrand();
        $material = $furniture->getMaterial();
        $category = $furniture->getCategory();
        $price = $furniture->getPrice();
        $image = $furniture->getImage();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . FURNITURE_IMG . $image;
        }
        ?>

        <div id="main-header">Furniture Details</div>
        <hr>
        <!-- display furniture details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $product ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Product Name:</strong></p>
                    <p><strong>Brand:</strong></p>
                    <p><strong>Material:</strong></p>
                    <p><strong>Category:</strong></p>
                    <p><strong>Price:</strong></p>
                    <br>
                    <br>
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/furniture/edit/<?= $id ?>'">&nbsp;
                    </div>
                </td>
                <td>
                    <p><?= $product ?></p>
                    <p><?= $brand ?></p>
                    <p><?= $material ?></p>
                    <p><?= $category ?></p>
                    <p><?= $price ?></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <br>
        <div id="back">
        <a href="<?= BASE_URL ?>/furniture/index">Go to furniture list</a>
        </div>
        <br>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
