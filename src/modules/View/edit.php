<?php include($base_path . 'src\\modules\\view\\__headerForSeller.ini.php'); ?>
<a href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Return to a previous page</a>

<form class="edit" method="post" enctype="multipart/form-data">
        <label for="label">Label</label>
        <input name="label" type="text" value="<?php echo !empty($result['label']) ? $result['label'] : ''; ?>"
                required>
        <div>
                <label for="photo">Photo</label>
                <div id="photo_name" name="photo">
                        <img src="<?php echo $photo = !empty($result['photo_name']) ? '/pet_project/src/pictures/' . $result['photo_name'] : ''; ?>"
                                alt="no photo" width="300">
                </div>
        </div>
        <label for="photo_name">Upload phpto</label>
        <input type="file" id="photo_name_input" name="photo_name">
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
<script>
        const photo_name_input = document.querySelector("#photo_name_input");
        let uploaded_image = "";

        photo_name_input.addEventListener("change", (e) => {
                const reader = new FileReader();
                reader.addEventListener("load", (e) => {
                        uploaded_image = reader.result;
                        console.log(uploaded_image, 'upload');
                        document.querySelector('#photo_name').style.backgroundImage = `url(${uploaded_image})`;
                        document.querySelector('#photo_name').style.width = '300px';
                });
                reader.readAsDataURL(e.target.files[0]);
        });
</script>
<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>