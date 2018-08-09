$( document ).ready(function() {
    $( "#submit1" ).click(function() {
        getReports();
    });
});
function getReports(){
    let xmlhttp = new XMLHttpRequest();
    let contractArray = [];
    let employeeID = document.getElementById("employee_id").value;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            contractArray = JSON.parse(this.responseText);
            output = "";
            console.log(contractArray);
            obj = contractArray[0];

            for(let obj of contractArray){
                output += "Company Name: " + obj.company_name + ", Contract Category: " + obj.contract_category + ", Contract ID " + "<h3>" +obj.contract_id + "</h3>" +" Contract Type "
                    + obj.type_of_service + "<hr>";
            }
        }
        else{
            output = "<h1>No contracts found, refresh page and try again</h1>";
        }
        document.getElementById("employeeContracts").innerHTML = output;
        $('#hiddenID').val(employeeID);
    };
    xmlhttp.open("GET", "/COMP353/api/index.php/employees/" +employeeID +"/preferences", true);
    xmlhttp.send();
}
