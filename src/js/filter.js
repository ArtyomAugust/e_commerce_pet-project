
//Here we create our filter
function filter(data) { 
    const aside = document.querySelector('.checkbox');
    let content = document.querySelectorAll('.content');
    let allCategory = [];
    let dataEach = [];
    let dataCountFilter = [];
    let count = 0;


    console.log(content);

    if (content[0]) {
        content.forEach((elem) => {
            console.log(elem);
        elem.remove();
        });
    }
        
        data.forEach(({category}) => {
            allCategory.push(category);
        });
        // console.log(cotegoryData, 'cotegoryData');
        // for (const iterator of allCategory) {
        //     let answer = cotegoryData.some((item) => 
        //         iterator === item);
        //     if (answer) {
        //         dataEach.push(iterator);
        //     }
        // }
        let uniqueItems = [...new Set(allCategory)]
        console.log(uniqueItems, 'dataEach');

        //Here we count how many goods of a certain cetegory
        for (const iterator of uniqueItems) {
            let obj1 = {};
            allCategory.forEach((item) => {
                if (item === iterator) {
                    count++;
                }
            });
            obj1.nameCategory = iterator;
            obj1.countCategory = count;
            dataCountFilter.push(obj1);
            count = 0;
        }
            

        console.log(dataCountFilter, 'count222');
        //Here we fetch data into the grid
        dataCountFilter.forEach(({nameCategory, countCategory}) => {
            const newCards = document.createElement('div');
                newCards.classList.add("content")
                newCards.innerHTML = `
                <div class="form-check">
                    <input type="checkbox" class="form-check-input"
                    name="categoryFilter" value="${nameCategory}" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                    ${nameCategory} (${countCategory}) 
                    </label>
                </div>
                `;
            aside.append(newCards);        
        });

   
}

export default filter;