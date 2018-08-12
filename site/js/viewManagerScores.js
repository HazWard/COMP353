$( document ).ready(function() {
    $( "#submit1" ).click(function() {
        getManagerScores();
    });
});
function getManagerScores(){
    let xmlhttp = new XMLHttpRequest();
    let managerID = document.getElementById("mid").value;
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            managerObject = JSON.parse(this.responseText);
            console.log(managerObject);
            output = "";

            for(let obj of managerObject.contracts){
                if(obj.score !== null){
                    output += "Contract ID: " + obj.id + ", Satisfaction Score: " + obj.score + "<hr>";
                }
                else{
                    output += "Contract ID: " + obj.id + ", Satisfaction Score: " + "N/A" + "<hr>";
                }
            }
            output+= "<h1>Average Score: " + managerObject.average + "</h1>";
        }
        else{
            output = "<h1>No contracts found, refresh page and try again</h1>";
        }
        document.getElementById("managerScores").innerHTML = output;
    };
    xmlhttp.open("GET", "/api/index.php/managers/"+ managerID + "/scores", true);
    xmlhttp.send();
}