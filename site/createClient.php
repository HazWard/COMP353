<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Website CSS style -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>


</head>
<body>
<div class="container">
    <div class="row main">
        <div class="main-login main-center">
            <h5 style="text-align: center; font-weight: bold; font-size: large">Enter client information</h5>
            <form class="" method="post" action="#">
                <div class="form-group">
                    <label for="name" class="cols-sm-2 control-label">Company Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="companyMame" id="name"  placeholder="Enter Company Name"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="cols-sm-2 control-label">Company Email</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="email" id="email"  placeholder="Enter Company Email"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Enter Representative First Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="firstName" id="firstName"  placeholder="Enter First Name"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Enter Representative Last Name</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="lastName" id="lastName"  placeholder="Enter Last Name"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="username" class="cols-sm-2 control-label">Enter Representative Middle Initial</label>
                    <div class="cols-sm-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                            <input type="text" class="form-control" name="lastName" id="lastName"  placeholder="Enter Middle Initial"/>
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
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Select a City</label>
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
                    <a href="https://ccp.cloudaccess.net/aff.php?aff=5188" target="_blank" type="button" id="button" class="btn btn-primary btn-lg btn-block login-button">Register New Client</a>
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