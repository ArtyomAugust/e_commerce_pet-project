function createGrid(data) {

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
                <img src="${photo_name}" alt="${label}">
            </div>
            <div class="product-details">
                <span class="product-catagory">${category}</span>
                <h4><a href="">${label}</a></h4>
                <p>${description}</p>
            `;

            if (discount) {
                newCards.innerHTML += `
                <div class="product-price"><small>${price}</small>${discount}</div>
                        <div class="product-links">
                            <a href=""><i class="bi bi-heart"></i></a>
                            <a href=""><i class="bi bi-bag"></i></a>
                        </div>
                    </div>
                </div>
                 `;
            } else {
                newCards.innerHTML += `
                <div class="product-price">${price}</div>
                        <div class="product-links">
                            <a href=""><i class="bi bi-heart"></i></a>
                            <a href=""><i class="bi bi-bag"></i></a>
                        </div>
                    </div>
                </div>
                 `;
            }
        grid.append(newCards);        
    });
}

export default createGrid;
