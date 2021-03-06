<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Bootstrap Admin Theme</title>

    <!-- Bootstrap Core CSS -->
    <link href={{asset("bower_components/bootstrap/dist/css/bootstrap.min.css")}} rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href={{asset("bower_components/metisMenu/dist/metisMenu.min.css")}} rel="stylesheet">

    <!-- Custom CSS -->
    <link href={{asset("dist/css/sb-admin-2.css")}} rel="stylesheet">

    <!-- Custom Fonts -->
    <link href={{asset("bower_components/font-awesome/css/font-awesome.min.css")}} rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Register</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="register" method="post">
                            <fieldset>
							      <div class="form-group">
								  <?php echo $errors->first('name'); ?>
                                    <input class="form-control" placeholder="Name" name="name"   autofocus value={{Input::old('name')}} >
                                </div>
								<div class="form-group">
								<?php echo $errors->first('user_name'); ?>
                                    <input class="form-control" placeholder="Username" name="user_name"  value="{{Input::old('user_name')}}" autofocus>
                                </div>
								<div class="form-group">
								<?php  echo $errors->first('password'); ?>
                                    <input class="form-control" placeholder="Password" name="password"  value="{{Input::old('password')}}"  type="password" autofocus>
                                </div>
								<div class="form-group">
								<?php echo $errors->first('cfm_password'); ?>
                                    <input class="form-control" placeholder="Confirm Password" name="cfm_password"  value="{{Input::old('cfm_password')}}"  type="password" autofocus>
                                </div>
                                <div class="form-group">
								     <?php echo $errors->first('mobile'); ?>
                                    <input class="form-control" placeholder="Mobile" name="mobile" value="{{Input::old('mobile')}}"  autofocus>
                                </div>
                                <div class="form-group">
								      <?php echo $errors->first('email'); ?>
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" value="{{Input::old('email')}}" >
                                </div>
								
                               
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit"  class="btn btn-lg btn-success btn-block" value="Register">
							
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src={{asset("bower_components/jquery/dist/jquery.min.js")}}></script>

    <!-- Bootstrap Core JavaScript -->
    <script src={{asset("bower_components/bootstrap/dist/js/bootstrap.min.js")}}></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src={{asset("/bower_components/metisMenu/dist/metisMenu.min.js")}}></script>

    <!-- Custom Theme JavaScript -->
    <script src={{asset("/dist/js/sb-admin-2.js")}}></script>

</body>

</html>
