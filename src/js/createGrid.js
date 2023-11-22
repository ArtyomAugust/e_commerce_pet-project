function createGridFHome(data) {

    const newData = data;
    let grid = document.querySelector("#demoB");
    let productCards = document.querySelectorAll('.product-card');

    //remove excess in the grid 
    console.log(newData);
    if (grid.children[0]) {
        productCards.forEach((elem) => {
            // console.log(elem);
        elem.remove();
        });
    }
        

    newData.forEach(({
        label, 
        description, 
        photo_name,
        category,
        hot,
        price,
        discount
        }) => {
        const newCards = document.createElement('div');
            newCards.classList.add("product-card");
            if (hot) {
                newCards.innerHTML += '<div class="badge">Hot</div>'
            }
            newCards.innerHTML += `
            <div class="product-tumb">
                <img src="/pet_project/src/pictures/${photo_name}" alt="${label}">
            </div>
            <div class="product-details">
                <span class="product-catagory">${category}</span>
                <h4><a href="">${label}</a></h4>
                <p>${description}</p>
                `;

            if (discount) {
                newCards.innerHTML += `<div class="product-bottom-details">
                <div class="product-price"><small>${price}</small>${discount} &euro;</div>
                        <div class="product-links">
                            <a href=""><i class="bi bi-heart-fill"></i></a>
                            <a href=""><i class="bi bi-cart-fill"></i></a>
                        </div>
                    </div>
                </div>`;
            } else {
                newCards.innerHTML += `<div class="product-bottom-details">
                <div class="product-price">${price} &euro;</div>
                        <div class="product-links">
                            <a href=""><i class="bi bi-heart-fill"></i></a>
                            <a href=""><i class="bi bi-cart-fill"></i></i></a>
                        </div>
                    </div>
                </div>`;
            }
        grid.append(newCards);        
    });
}

function createGridFSeller(data) {

    const newData = data;
    let tbody = document.querySelector("tbody");

    newData.forEach(({
        id,
        label, 
        description, 
        photo_name,
        category,
        price,
        discount,
        uploaded
        }) => {
        const newCards = document.createElement("tr");
                // newCards.classList.add("grid-container");
            
                newCards.innerHTML = `
                    <td>${label}</td>
                    <td>${description}</td>
                    <td><img style="width: 200px" src="/pet_project/src/pictures/${photo_name}" alt="${label}"></td>
                    <td>${category}</td>
                    <td>${price}</td>
                    <td>${discount}</td>
                    <td>${uploaded}</td>
                    <td><a class="sellerPageEdit" href="/pet_project/sellerpage/edit?edit_id=${id}">edit</a></td>
                    <td><a class="sellerPageDelete" href="/pet_project/sellerpage?delete_id=${id}">delete</a></td>
                    `;

        tbody.append(newCards);        
    });
}

export {createGridFHome, createGridFSeller};
