<?php include($base_path . 'src\\modules\\view\\__headerForSeller.ini.php'); ?>
<h1>Seller:
    <?php echo $_SESSION['user_name'] ?>
</h1>

<!-- The Modal -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h3>Do you want to delete that product?</h3>
        <p id="dLabel" style="padding: 10px;margin-right: 10px;"></p>
        <button class="deleteBtn" id="deleteBtn">DELETE</button>
    </div>

</div>
<!-- The Modal -->


<div class="table-container">
    <table class="fixed-table">
        <thead>
            <tr>
                <th>Label</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Category</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Uploaded</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</div>

<script type="module">
    import { createGridFSeller } from "./src/js/createGrid.js";
    const data = <?php echo $context ?>;


    createGridFSeller(data);


    // const delete_id = document.getElementById("delete_id");
    const modal = document.getElementById("myModal");
    const btns = document.querySelectorAll("#deleteButton");
    const deleteBtn = document.getElementById("deleteBtn");
    const span = document.getElementsByClassName("close")[0];
    const dLabel = document.querySelector("#dLabel");

    // console.log(btn);

    // for (let index = 1; index <= data.length; index++) {
    //     const element = array[index];

    // }
    let className = '';
    btns.forEach(btn => {
        btn.addEventListener("click", (e) => {
            e.preventDefault();
            modal.style.display = "block";
            let className = e.currentTarget.className;
            let char = className.charAt(34);


            for (const iterator of data) {
                // console.log(iterator, 'data');
                const { id, label } = iterator;
                // console.log(id, char);
                if (id == char) {
                    dLabel.innerHTML = String(label);
                }
            }

            deleteBtn.addEventListener("click", (e) => {
                e.preventDefault();

                // console.log(className);
                window.location.href = String(className);
            });

        });


    });



    span.addEventListener("click", (e) => {
        e.preventDefault();
        modal.style.display = "none";
    });

</script>

<script>



    // // Get the modal
    // var modal = document.getElementById("myModal");

    // // Get the button that opens the modal
    // var btn = document.getElementById("myBtn");

    // // Get the <span> element that closes the modal
    // var span = document.getElementsByClassName("close")[0];

    // // When the user clicks the button, open the modal
    // btn.onclick = function() {
    //   modal.style.display = "block";
    // }

    // // When the user clicks on <span> (x), close the modal
    // span.onclick = function() {
    //   modal.style.display = "none";
    // }

    // // When the user clicks anywhere outside of the modal, close it
    // window.onclick = function(event) {
    //   if (event.target == modal) {
    //     modal.style.display = "none";
    //   }
    // }
</script>


<?php include($base_path . 'src\\modules\\view\\__footer.inc.php'); ?>