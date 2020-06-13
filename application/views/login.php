<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Admin Login</title>
        <link href="<?=base_url()?>public/css/styles.css" rel="stylesheet" />
        <script src="<?=base_url()?>public/js/all.min.js"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                                    <div class="card-body">
									<?php
            if ($error == 1) { echo "Too Many Login Attempts"; }
            if ($error == 2) { echo "Invalid Login Credentials."; }
        ?>
                                        <form class="form-signin" action="<?=base_url()?>login" method="POST">
                                            <div class="form-group"><label class="small mb-1" for="inputEmailAddress">User Name</label><input name="username" class="form-control py-4" id="inputEmailAddress" type="text" placeholder="User Name" /></div>
                                            <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter password" /></div>
											<div class="form-group">
											<input class="btn btn-lg btn-primary btn-block" type="submit" value="Sign in">
											</div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2019</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?=base_url()?>public/js/jquery-3.4.1.min.js"></script>
        <script src="<?=base_url()?>public/js/bootstrap.bundle.min.js"></script>
        <script src="<?=base_url()?>public/js/scripts.js"></script>
    </body>
</html>