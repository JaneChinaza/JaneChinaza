
<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg'); height: 100vh;">
      <div class="container">
        <div class="row justify-content-center align-items-center">
        
            
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 form1" data-aos="fade-up" data-aos-delay="200" style="opacity: 0.6 !important;">

          <?php if (!empty($errors)): ?>
          <div class="alert alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert""> 
          <?php foreach ($errors as $error): ?> 
              <div>
                <?php echo $error ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
              </div>
          <?php endforeach; ?>

          </div>
          <?php endif; ?>
            
            <form action="/login" class="form2" method="post">
            <h1 class="heading" data-aos="fade-up">Input your details</h1>
                <div class="form-group">
                  <input type="email" class="form-control" required="required"  placeholder="Enter email" name="email" value="<?php  echo $user['email'] ?>"> <br>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" required="required" placeholder="Password" name="password" value="<?php  echo $user['password'] ?>"><br>
                </div>
                
                <button type="submit" value="Login" class="btn btn-primary">Login</button><br><br>

                <?php if (!isset($_SESSION['role_id'])):?>
                  <p>Don't have an account? <a href="/signup" style="color:#E30B5D;"><b>Sign up now!</b></a></p>
                  <?php endif; ?> 

                  <?php if (isset($_SESSION['role_id'])):?>
                            <p class="h6 text-warning mt-3" data-aos="fade-up"><em>You are logged in already</em> </p>
                    <?php endif; ?>
              </form>
            
          </div>
        </div>
      </div>
    </div>




