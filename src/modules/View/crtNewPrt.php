<?php include($base_path . 'src\\modules\\view\\__headerForSeller.ini.php'); ?>
<a class="crtPrt" href="<?php echo $_SERVER['HTTP_REFERER'] ?>">Return to a previous page <i
        class="bi bi-arrow-left"></i></a>

<form class="edit" method="post" enctype="multipart/form-data">
    <!-- <div class="crtPrt"> -->
    <label for="label">Label:</label>
    <input name="label" type="text" placeholder="Type label" required>
    <!-- </div> -->


    <label for="displayed_photo">Displayed photo:</label>
    <div class="displayed_photo" name="displayed_photo">
        <img style="border: 3px solid #ccc;" id="photo_name"
            src="https://cdn.swisscows.com/image?url=https%3A%2F%2Ftse3.mm.bing.net%2Fth%3Fid%3DOIP.9hetfdrodOfI9KzE_g_dDAAAAA%26pid%3DApi"
            alt="" width="300px" height="300px">

        <input type="file" id="photo_name_input" name="photo_name">
    </div>


    <label for="description">Description:</label>
    <textarea name="description" id="" cols="30" rows="5" placeholder="Type description" required></textarea>
    <label for="price">Price:</label>
    <input name="price" type="text" placeholder="Type price" required>
    <label for="discount">Discount:</label>
    <input name="discount" type="text" placeholder="Type discount">
    <!-- <div class="select"> -->
    <label for="category">Choose a category:</label>
    <select name="category[]" id="category">
        <?php foreach ($category as $key => $value) { ?>
            <option value="<?php echo $value["id"] ?>"><?php echo $value["name_category"] ?>
            </option>
        <?php } ?>
    </select>
    <!-- </div> -->

    <button type="submit">submit</button>
</form>


<!-- Desplay a loaded photo-->
<script>
    const photo_name_input = document.querySelector("#photo_name_input");
    let uploaded_image = "";

    photo_name_input.addEventListener("change", (e) => {
        const reader = new FileReader();
        reader.addEventListener("load", (e) => {
            uploaded_image = reader.result;
            console.log(uploaded_image, 'upload');
            document.querySelector('#photo_name').src = `${uploaded_image}`;
        });
        reader.readAsDataURL(e.target.files[0]);
    });
</script>

<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>