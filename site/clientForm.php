<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/client.js"></script>
    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>
</head>

<?php include('head.php'); ?>
<body>
<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h5 style="text-align: center; font-weight: bold; font-size: large">Enter client information</h5>
            <form class="" method="post" action="../api/clients/createClient.php">
                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Company Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="companyName" id="name"  placeholder="Enter Company Name" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="number" class="cols-sm-2 control-label">Company Number</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="companyNumber" id="number"  placeholder="Enter Company Number" minlength="10" maxlength="10" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Company Email</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="email" id="email"  placeholder="Enter Company Email" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="FN" class="cols-sm-2 control-label">Enter Representative First Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="firstName" id="firstName"  placeholder="Enter First Name" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="LN" class="cols-sm-2 control-label">Enter Representative Last Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="lastName" id="lastName"  placeholder="Enter Last Name" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="MI" class="cols-sm-2 control-label">Enter Representative Middle Initial</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="middleInitial" id="middleInitial"  placeholder="Enter Middle Initial" maxlength="1" required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="LOB" class="cols-sm-2 control-label">Enter Line of Business</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-briefcase fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="LOB" id="LOB"  placeholder="Line of Business"  required/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select a Province</label>
                    <select class="form-control" id="province" name="province">
                        <option value="" disabled selected>Select a Province</option>
                        <option>Ontario</option>
                        <option>British Columbia</option>
                        <option>Quebec</option>
                        <option>Alberta</option>
                        <option>Nova Scotia</option>
                        <option>Saskatchewan</option>
                        <option>Manitoba</option>
                        <option>New Brunswick</option>
                        <option>Newfoundland and Labrador</option>
                        <option>Prince Edward Island</option>
                        <option>Nunavut</option>
                        <option>Northwest Territories</option>
                        <option>Yukon</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Select a City</label>
                    <select class="form-control" id="city" name="city">
                        <option value="" disabled selected>Select a City</option>
                        <!--add logic to populate cities based on province selection-->
                    </select>
                </div>
                <div class="form-group">
                    <label for="password" class="cols-sm-2 control-label">Enter Password</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                            <input type="password" class="form-control" name="password" id="password"  placeholder="Enter Password"/>
                        </div>
                    </div>
                </div>
                <div class="form-group ">
                    <input type="submit" class="btn btn-primary btn-lg btn-block login-button" value="Register New Client">
                </div>

            </form>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
</body>
</html>