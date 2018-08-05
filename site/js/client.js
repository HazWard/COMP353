
$( document ).ready(function() {
    $('#province').change(function() {
        getCities();
    });
});

function getCities(){
    let xmlhttp = new XMLHttpRequest();
    let cityArray = [];
    let provinceDrop = document.getElementById("province");
    let selectedProvince = provinceDrop.options[provinceDrop.selectedIndex].value;
    let province = getProvinceAbbrev(selectedProvince);
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            cityArray = JSON.parse(this.responseText);
            populateCities(cityArray,selectedProvince);
        }
    };
    xmlhttp.open("GET", "/COMP353/api/index.php/locations/cities?province=" + province, true);
    xmlhttp.send();

}

function getProvinceAbbrev(selectedProvince){
    switch(selectedProvince) {
            case 'Ontario':
                return 'ON';
            case 'Quebec':
                return 'QC';
            case 'British Columbia':
                return 'BC';
            case 'Alberta':
                return 'AB';
            case 'Nova Scotia':
                return 'NS';
            case 'Saskatchewan':
                return 'SK';
            case 'Manitoba':
                return 'MB';
            case 'New Brunswick':
                return 'NB';
            case 'Newfoundland and Labrador':
                return 'NL';
            case 'Prince Edward Island':
                return 'PE';
            case 'Nunavut':
                return 'NU';
            case 'Yukon':
                return 'YT';
            case 'Northwest Territories':
                return 'NT';
        }
}

function populateCities (cityArray,province){
    let cityDrop = document.getElementById("city");
    removeOptions(cityDrop);
    let displayCities = cityArray;

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