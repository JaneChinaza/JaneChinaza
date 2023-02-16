

<div class="hero page-inner overlay" style="background-image: url('images/hero_bg_1.jpg'); height: 150vh;">
      <div class="container">
        <div class="row justify-content-center align-items-center">
      
          <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 form1" data-aos="fade-up" data-aos-delay="20" style="opacity: 0.6 !important;">
          
          <?php if (!empty($errors)): ?>
          <div class="alert alert-danger alert-dismissible fade show tooltip-test" role="alert"> 
          <?php foreach ($errors as $error): ?> 
              <div><?php echo $error ?>
              <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
            </div>
          <?php endforeach; ?>

          </div>
          <?php endif; ?>
            
          
          <form action="/signup" method="post" class="form2" enctype="multipart/form-data">
              <h1 class="heading" data-aos="fade-up">Create an account</h1>

                <div class="form-group">
                  <label ><b>User Image</b></label><br>
                  <input type="file" name="image" class="" ><br><br>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="name" placeholder="Enter Name" value="<?php  echo $user['user_name'] ?>"><br>
                  </div>
                <div class="form-group">
                  <input type="email" class="form-control" name="email" value="<?php  echo $user['email'] ?>" placeholder="Enter email"><br>
                </div>
                <div class="form-group">
                <input type="tel"  class="form-control" name="phone_no" placeholder="Your Phone Number" value= "<?php  echo $user['phone_no'] ?>"/> <br>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" value="<?php  echo $user['password'] ?>" placeholder="Password"><br>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" value="<?php  echo $user['confirm_password'] ?>" placeholder="Confirm Password"><br>
                  </div><br>
                <button type="submit" class="btn btn-primary" value="signup">Submit</button><br><br>
                  <p>Already have an account? <a href="/login" style="color:#E30B5D;"><b>click here to login</b></a></p>
              </form>
            </div>
        </div>
      </div>
    </div>


    <!-- /.untree_co-section -->

    
