<?php include($base_path . 'src\\modules\\view\\__headerForSeller.ini.php'); ?>
<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Return to a previous page</a>

<form class="edit" method="post">
        <label for="label">Label</label>
        <input name="label" type="text" value="<?php echo !empty($result['label']) ? $result['label'] : ''; ?>"
                required>
        <!-- <label for="filename">Upload phpto</label>
        <input type="file" id="myFile" name="photo_name"> -->
        <label for="description">Description</label>
        <textarea name="description" id="" cols="30" rows="5"
                required><?php echo !empty($result['description']) ? $result['description'] : ''; ?>"</textarea>
        <label for="price">Price</label>
        <input name="price" type="text" value="<?php echo !empty($result['price']) ? $result['price'] : ''; ?>"
                required>
        <label for="discount">Discount</label>
        <input name="discount" type="text"
                value="<?php echo !empty($result['discount']) ? $result['discount'] : ''; ?>">
        <!-- <div class="select"> -->
        <label for="category">Choose a category:</label>
        <select name="category[]" id="category">
                <?php foreach ($category as $key => $value) { ?>
                        <?php if ($result['category_id'] === $value['id']) { ?>
                                <option value="<?php echo $value["name_category"] ?>" selected><?php echo $value["name_category"] ?>
                                </option>
                                <?php continue;
                        } ?>
                        <option value="<?php echo $value["name_category"] ?>"><?php echo $value["name_category"] ?>
                        </option>
                <?php } ?>
        </select>
        <!-- </div> -->

        <button type="submit">submit</button>
</form>
<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>