<?php
/*
 * Author: Louie Zhu
 * Date: Dec. 24, 2014
 * Name: view_electronic.class.php
 * Description: This class defines a method "display".
 * The method accepts a Electronic object and displays the details of the electronic in a table.
 */

namespace warehouse_mvc\views\electronic\detail;

class Detail extends \warehouse_mvc\views\electronic\ElectronicIndexView {

    public function display($electronic, $confirm = "") {
        //display page header
        parent::displayHeader("Electronic Details");

        //retrieve electronic details by calling get methods
        $id = $electronic->getId();
        $product = $electronic->getProduct();
        $category = $electronic->getCategory();
        $year_model = new \DateTime($electronic->getYearModel());
        $sku = $electronic->getSKU();
        $model = $electronic->getModel();
        $price = $electronic->getPrice();
        $image = $electronic->getImage();


        if (strpos($image, "http://") === false AND strpos($image, "https://") === false) {
            $image = BASE_URL . '/' . ELECTRONIC_IMG . $image;
        }
        ?>

        <div id="main-header">Electronic Details</div>
        <hr>
        <!-- display electronic details in a table -->
        <table id="detail">
            <tr>
                <td style="width: 150px;">
                    <img src="<?= $image ?>" alt="<?= $product ?>" />
                </td>
                <td style="width: 130px;">
                    <p><strong>Product:</strong></p>
                    <p><strong>Category:</strong></p>
                    <p><strong>Year Model:</strong></p>
                    <p><strong>SKU:</strong></p>
                    <p><strong>Model:</strong></p>
                    <p><strong>Price:</strong></p>
                    <br>
                    <br>
                    
                    <div id="button-group">
                        <input type="button" id="edit-button" value="   Edit   "
                               onclick="window.location.href = '<?= BASE_URL ?>/electronic/edit/<?= $id ?>'">&nbsp;
                    </div>
                </td>
                <td>
                    <p><?= $product ?></p>
                    <p><?= $category ?></p>
                    <p><?= $year_model->format('m-d-Y') ?></p>
                    <p><?= $sku ?></p>
                    <p><?= $model ?></p>
                    <p><?= $price ?></p>
                    <p></p>
                    <div id="confirm-message"><?= $confirm ?></div>
                </td>
            </tr>
        </table>
        <br>
        <div id="back">
        <a href="<?= BASE_URL ?>/electronic/index">Return to electronics list</a>
        </div>
        <br>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}
