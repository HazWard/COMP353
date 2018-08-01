
$( document ).ready(function() {
    $('#province').change(function() {
        populateCities();
    });
});



function populateCities (){
    let cityDrop = document.getElementById("city");
    removeOptions(cityDrop);
    let provinceDrop = document.getElementById("province");
    let selectedProvince = provinceDrop.options[provinceDrop.selectedIndex].value;

    let ontarioCities = ['Toronto','Ottawa','Hamilton','Waterloo',];
    let quebecCities = ['Montreal','Quebec','Gatineau','laval'];
    let bcCities = ['Vancouver','Victoria','Surrey','Burnaby'];
    let albertaCities = ['Calgary','Edmonton','Red Deer','Lethbridge'];
    let nvCities = ['Halifax','Sydney','Truro','New Glasgow'];
    let saskCities = ['Saskatoon','Regina','Prince Albert','Moose Jaw'];
    let manitobaCities = ['Winnipeg','Brandon','Steinbach','Thompson'];
    let nbCities = ['Moncton','Bathurst','Fredericton','Dieppe'];
    let nflCities = ['St John\'s','Mount Pearl','Paradise','Labrador City'];
    let peiCities = ['Charlottetown','Summerside','Stratford','Cornwall'];

    let displayCities;
    switch(selectedProvince) {
        case 'Ontario':
            displayCities =  ontarioCities;
            break;
        case 'Quebec':
            displayCities =  quebecCities;
            break;
        case 'British Columbia':
            displayCities =  bcCities;
            break;
        case 'Alberta':
            displayCities =  albertaCities;
            break;
        case 'Nova Scotia':
            displayCities =  nvCities;
            break;
        case 'Saskatchewan':
            displayCities =  saskCities;
            break;
        case 'Manitoba':
            displayCities =  manitobaCities;
            break;
        case 'New Brunswick':
            displayCities =  nbCities;
            break;
        case 'Newfoundland and Labrador':
            displayCities =  nflCities;
            break;
        case 'Prince Edward Island':
            displayCities =  peiCities;
            break;
        default:
           displayCities = [];
    }
    let select = document.getElementById("city");
    let options = displayCities;

    for(let i = 0; i < options.length; i++) {
        let opt = options[i];
        let el = document.createElement("option");
        el.textContent = opt;
        el.value = opt;
        select.appendChild(el);
}
}

function removeOptions(selectbox)
{
    let i;
    for(i = selectbox.options.length - 1 ; i >= 0 ; i--)
    {
        selectbox.remove(i);
    }
}