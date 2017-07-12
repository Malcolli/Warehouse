<?php
/*
 * Author: Louie Zhu
 * Date: Oct 27, 2012
 * File: edit.class.php
 * Description:
 *
 */
namespace warehouse_mvc\views\electronic\edit;

class Edit extends \warehouse_mvc\views\electronic\ElectronicIndexView {

    public function display($electronic) {
        //display page header
        parent::displayHeader("Edit Product");

        //get movie ratings from a session variable
        if (isset($_SESSION['electronic_categories'])) {
            $categories = $_SESSION['electronic_categories'];
        }
        
        //retrieve movie details by calling get methods
        $id = $electronic->getId();
        $product = $electronic->getProduct();
        $category = $electronic->getCategory();
        $year_model = $electronic->getYearModel();
        $sku = $electronic->getSKU();
        $model = $electronic->getModel();
        $price = $electronic->getPrice();
        $image = $electronic->getImage();
        ?>

        <div id="main-header">Edit Product Details</div>

        <!-- display movie details in a form -->
        <form class="new-media"  action='<?= BASE_URL . "/electronic/update/" . $id ?>' method="post" style="border: 1px solid #bbb; margin-top: 10px; padding: 10px;">
          <input type="hidden" name="id" value="<?= $id ?>">
            <p><strong>Product</strong><br>
                <input name="product" type="text" size="100" value="<?= $product ?>" required autofocus></p>
            <p><strong>Category</strong></p>
             <?php
                foreach ($categories as $m_category => $m_id) {
                    $checked = ($category == $m_category ) ? "checked" : "";
                    echo "<input type='radio' name='category' value='$m_id' $checked> $m_category &nbsp;&nbsp;";
                }
                ?>
            <p><strong>Year</strong>:<input name="year_model" type="text" size="40" value="<?= $year_model ?>" required=""></p>
            <p><strong>SKU</strong>:<input name="sku" type="text" size="40" value="<?= $sku ?>" required=""></p>
            <p><strong>Model</strong>:<input name="model" type="text" size="40" value="<?= $model ?>" required=""></p>
            <p><strong>Price</strong>:<input name="price" type="text" size="40" value="<?= $price ?>" required=""></p>
            <p><strong>Image</strong>: url (http:// or https://) or local file including path and file extension<br>
                <input name="image" type="text" size="100" required value="<?= $image ?>"></p>
            
            <input type="submit" name="action" value="Update Product">
            <input type="button" value="Cancel" onclick='window.location.href = "<?= BASE_URL . "/electronic/detail/" . $id ?>"'>  
        </form>
        <?php
        //display page footer
        parent::displayFooter();
    }

//end of display method
}

