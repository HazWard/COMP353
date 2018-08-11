<!DOCTYPE html>
<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="js/contractAssign.js"></script>
    <title>Employee Pref</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script> </script>
</head>
<body>
<div class="header">
    <h2>Enter a Maanger ID to view their satisfaction scores</h2>
    <input type="text" placeholder="Manager ID" id="manager_id">
    <button value="submit1" id="submit1">View Scores</button>
</div>


<div class="header">
    <p id = "employeeContracts"></p>
</div>
<form method="post" action="../site/assignContract.php">
    <input type="text" placeholder="ContractID" id="contract_id" name="contract_id">
    <input type="hidden" id="hiddenID" value="0" name="hiddenID">
    <input type="submit"  value="Assign employee">
</form>

</body>
</html>
