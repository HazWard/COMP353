
$( document ).ready(function() {
        getManagers();
        getClients();
});

function getManagers(){
    let xmlhttp = new XMLHttpRequest();
    let managerArray = [];
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            managerArray = JSON.parse(this.responseText);
            populateDropbox(managerArray,'manager');
        }
    };
    xmlhttp.open("GET", "/COMP353/api/index.php/managers", true);
    xmlhttp.send();

}

function getClients(){
    let xmlhttp = new XMLHttpRequest();
    let clientArray = [];
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            clientArray = JSON.parse(this.responseText);
            populateDropbox(clientArray,'company');
        }
    };
    xmlhttp.open("GET", "/COMP353/api/index.php/clients", true);
    xmlhttp.send();
}

function populateDropbox (dropArray,dropID){
    let drop = document.getElementById(dropID);
    removeOptions(drop);
    
        for(let i = 0; i < dropArray.length; i++) {
            let opt = dropArray[i];
            let el = document.createElement("option");
            if(dropID == 'manager'){
                el.textContent = opt.firstName + " " + opt.lastName;
                el.value = opt.id;
            }
            else{
                el.textContent = opt;
                el.value = opt
            }
            drop.appendChild(el);
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