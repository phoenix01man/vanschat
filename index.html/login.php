<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Favicons -->
    <link href="../public/img/apple-touch-icon.png" rel="icon">
    <link href="../public/img/favicon.png" rel="apple-touch-icon">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../index.css/index.css">
    <link rel="stylesheet" href="../assets/fontawesome-free-6.4.2-web/css/all.min.css">
    <title>VansChat</title>
</head>
<body>
    <div class="container">

        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
        
                        <div class="d-flex justify-content-center py-4">
                            <a href="index.html" class="logo d-flex align-items-center w-auto">
                                <img src="../public/img/logo.png" alt="">
                                <span class="d-none d-lg-block">VansChat App</span>
                            </a>
                        </div><!-- End Logo -->
    
                        <div class="card mb-3">
        
                            <div class="card-body">
            
                                <div class="pt-4 pb-2">
                                <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                                <p class="text-center small">Enter your username & password to login</p>
                            </div>
        
                            <form class="row g-3 needs-validation" action="../includes/loginsub.php" method="POST" novalidate>
                                <?php if(isset($_GET['error'])){ ?>
                                    <div class="alert alert-danger alert-dismissible">
                                        <button class="btn-close" data-bs-dismiss="alert"></button>
                                        <p><?=$_GET['error']; ?></p>
                                    </div>
                                <?php } else if(isset($_GET['success'])){ ?>
                                    <div class="alert alert-success alert-dismissible">
                                        <button class="btn-close" data-bs-dismiss="alert"></button>
                                        <p><?=$_GET['success']; ?></p>
                                    </div>
                                <?php } ?>
                                <div class="col-12">
                                    <label for="yourUsername" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                                    <input type="text" name="username" class="form-control" id="yourUsername" required>
                                    <div class="invalid-feedback">Please enter your username.</div>
                                    </div>
                                </div>
            
                                <div class="col-12">
                                    <label for="yourPassword" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                                    <div class="invalid-feedback">Please enter your password!</div>
                                </div>
            
                                <div class="col-12">
                                    <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                                    <label class="form-check-label" for="rememberMe">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn w-100" name="submit">Login</button>
                                </div>
                                <div class="col-12">
                                    <p class="small mb-0">Don't have account? <a href="index.php">Create an account</a></p>
                                </div>
                            </form>
  
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
<script src="../index.js/index.js"></script>
<script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>