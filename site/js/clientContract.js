$( document ).ready(function() {
    $( "#submit1" ).click(function() {
        getClientContracts();
    });
});
function getClientContracts(){
    let xmlhttp = new XMLHttpRequest();
    let contractArray = [];
    let companyName = document.getElementById("companyName").value;

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            contractArray = JSON.parse(this.responseText);
            output = "";
            for(let obj of contractArray){
                let xmlhttp = new XMLHttpRequest();
                let managerArray = [];
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        managerArray = JSON.parse(this.responseText);
                        managerName = managerArray.firstName + " " + managerArray.lastName;

                        output += "Company Name: " + companyName + ", Contract Category: " + obj.category + ", Contract ID " + "<h3>" +obj.id + "</h3>" +" Contract Type "
                            + obj.serviceType +" ACV: " + obj.acv + "$"+" Initial Amount:  " + obj.initialAmount + "$ " + "Manager: " + managerName +"<hr>";

                        document.getElementById("clientContracts").innerHTML = output;

                    }
                };
                xmlhttp.open("GET", "/COMP353/api/index.php/employees/" + obj.manager, true);
                xmlhttp.send();

            }
        }
        else{
            output = "<h1>No contracts found, refresh page and try again</h1>";
        }

    };
    xmlhttp.open("GET", encodeURI("/COMP353/api/index.php/clients/"+ companyName +"/contracts"), true);
    xmlhttp.send();
}



