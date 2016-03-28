<?php

include "includes/connection.php";
include "includes/db-connect.php";
?>
<?php
// Script Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', '1');
?>
<?php
// Parse the form data and add inventory item to the system
if (isset($_POST['item_name'])) {

    $item_id = $_POST['thisID'];
    $item_name = $_POST['item_name'];
    $item_description = $_POST['item_description'];
    $price = $_POST['price'];
    // $date_added = mysqli_real_escape_string($_POST['date_added']);
    $category = $_POST['category'];


    // See if that product name is an identical match to another product in the system
    $sql = mysqli_query($mysqli, "UPDATE inventory_info SET item_name='$item_name',item_description='$item_description', price='$price', category='$category'  WHERE item_id='$item_id'");
    //if ($_FILES['fileField']['tmp_name'] != "") {
        // Place image in the folder
        // $newname = "$pid.jpg";
        //move_uploaded_file($_FILES['fileField']['tmp_name'], "../inventory_images/$newname");
 //   }
    header("location: admin_list.php");
    exit();
}
?>
<?php

// Gather this product's full information for inserting automatically into the edit form below on page
if (isset($_GET['item_id'])) {
    $targetID = $_GET['item_id'];


    $sql = mysqli_query($mysqli, "SELECT * FROM inventory_info WHERE item_id='$targetID' LIMIT 1");
    $productCount = mysqli_num_rows($sql); // count the output amount
    if ($productCount > 0) {
        while($row = mysqli_fetch_array($sql)){

            $item_name= $row["item_name"];
            $item_description = $row["item_description"];
            $price = $row["price"];
            //    $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
            $category = $row["category"];


        }
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Inventory List</title>
    <link rel="stylesheet" href="../style/base.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="mainWrapper">

    <div id="pageContent"><br />
       <!-- <div align="right" style="margin-right:32px;"><a href="admin_list.php#inventoryForm">+ Add New Inventory Item</a></div> -->
        <div align="left" style="margin-left:24px;">
            <h2>Inventory list</h2>

        </div>
        <hr />
        <a name="inventoryForm" id="inventoryForm"></a>
        <h3>
            &darr; Make Changes in the Inventory Item Form &darr;
        </h3>
        <form action="edit_list.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
            <table width="90%" border="0" cellspacing="0" cellpadding="6">
                <tr>
                    <td width="20%" align="right">Item Name</td>
                    <td width="80%"><label>
                            <input name="item_name" type="text" id="item_name" size="64" value="<?php echo $item_name; ?>" />
                        </label></td>
                </tr>
                <tr>
                    <td align="right">Item Description</td>
                    <td><label>
                            <textarea name="item_description" id="item_description" cols="64" rows="5"><?php echo $item_description; ?></textarea>
                        </label></td>
                </tr>
                <tr>
                    <td align="right"> Price</td>
                    <td><label>
                            $
                            <input name="price" type="text" id="price" size="12" value="<?php echo $price; ?>" />
                        </label></td>
                </tr>
                <tr>
                    <td align="right">Category</td>
                    <td><label>
                            <select name="category" id="category">
                                <option value="Clothing">Clothing</option>
                            </select>
                        </label></td>
                </tr>



                <tr>
                    <td>&nbsp;</td>
                    <td><label>
                            <input name="thisID" type="hidden" value="<?php echo $targetID; ?>" />
                            <input type="submit" name="button" id="button" value="Make Changes" />
                        </label></td>
                </tr>
            </table>
        </form>
        <br />
        <br />
    </div>

</div>
</body>
</html>