    
import {createGridFHome} from './createGrid.js';

function fetchWFilter(dataFServe) {
    let clusterFFilter = [];


    setTimeout(() => {
        const fromFilter = document.querySelectorAll("#flexCheckDefault");
        console.log(fromFilter, 'fromFilter');
        fromFilter.forEach((checkbox) => {
            checkbox.addEventListener("click", (e) => {
                let checkboxValue = String(checkbox.value);


                clusterFFilter.push(checkboxValue);
                console.log(clusterFFilter, 'clusterFFilter');
                if (checkbox.checked) {
                    let result = [];
                        for (const iterator of clusterFFilter) {
                            function filterByCategory(item) {
                                if (item.category === iterator) {
                                    return true;
                                }
                        }

                        const arrayData = dataFServe.filter(filterByCategory);
                        arrayData.forEach((item) => {
                            result.push(item);
                        });
                        console.log(result, 'result');
                        
                    }
                    createGridFHome(result);
                }
                else {
                    let result = [];
                    const clusterFFilterResult = clusterFFilter.filter((item) => item !== checkbox.value);
                    clusterFFilter = clusterFFilterResult;
                    if (clusterFFilter.length === 0) {
                        createGridFHome(dataFServe);
                    } else {
                        for (const iterator of clusterFFilterResult) {
                            function filterByCategory(item) {
                                if (item.category === iterator) {
                                    return true;
                                }
                            }
                            const arrayData = dataFServe.filter(filterByCategory);
                            arrayData.forEach((item) => {
                                result.push(item);
                            });
                            console.log(result, 'result');
                    
                        }
                        createGridFHome(result);
                    }
                }
            });
        });
    }, 500);
}
export default fetchWFilter;
    