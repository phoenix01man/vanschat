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
    <div class="wrapp">
        <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
            <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
    
                  <div class="d-flex justify-content-center py-4 ">
                    <a href="index.html" class="logo d-flex align-items-center w-auto">
                      <img src="../public/img/logo.png" alt="">
                      <span class="d-none d-lg-block">VansChat App</span>
                    </a>
                  </div><!-- End Logo -->
    
                  <div class="card mb-3">
    
                    <div class="card-body">
    
                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                        <p class="text-center small">Enter your personal details to create account</p>
                      </div>
    
                      <form class="row g-3 needs-validation" action="../includes/signup.php" method="POST" enctype="multipart/form-data" novalidate>
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
                          <label for="yourName" class="form-label">First Name</label>
                          <input type="text" name="fname" class="form-control" id="yourName" required>
                          <div class="invalid-feedback">Please, enter your name!</div>
                        </div>

                        <div class="col-12">
                            <label for="yourName" class="form-label">Last Name</label>
                            <input type="text" name="lname" class="form-control" id="yourName" required>
                            <div class="invalid-feedback">Please, enter your name!</div>
                          </div>
    
                        <div class="col-12">
                          <label for="yourEmail" class="form-label">Your Email</label>
                          <input type="email" name="email" class="form-control" id="yourEmail" required>
                          <div class="invalid-feedback">Please enter a valid Email adddress!</div>
                        </div>
    
                        <div class="col-12">
                          <label for="yourUsername" class="form-label">Username</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                            <div class="invalid-feedback">Please choose a username.</div>
                          </div>
                        </div>

                        <div class="col-12">
                            <label for="yourName" class="form-label">Phone Number</label>
                            <input type="number" name="phone" class="form-control" id="yourName" required>
                            <div class="invalid-feedback">Please, enter your Phone Number!</div>
                          </div>
    
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" id="yourPassword" required >
                          
                          <div class="invalid-feedback">Please enter your password!</div>
                        </div>

                        <div class="col-12">
                            <label for="yourPhoto" class="form-label">Select a Photo</label>
                            <input type="file" name="file" class="form-control" id="yourName" required>
                            <div class="invalid-feedback">Please, select a Profile photo!</div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                              <input class="form-check-input" name="terms" type="checkbox" value="AGREE" id="acceptTerms" required>
                              <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                              <div class="invalid-feedback">You must agree before submitting.</div>
                            </div>
                          </div>
                          <div class="col-12">
                            <button class="btn w-100" type="submit" name="submit">Create Account</button>
                          </div>
                          <div class="col-12">
                            <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                          </div>
                        </form>
                    </div>
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