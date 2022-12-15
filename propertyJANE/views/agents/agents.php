    <div
      class="hero page-inner overlay"
      style="background-image: url('images/hero_bg_1.jpg'); height:50vh;"
    >
      <div class="container">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-9 text-center mt-5">
            <h1 class="heading" data-aos="fade-up">All Agents</h1>

            <nav
              aria-label="breadcrumb"
              data-aos="fade-up"
              data-aos-delay="200"
            >
              <ol class="breadcrumb text-center justify-content-center">
                <li class="breadcrumb-item"></li>
                <li
                  class="breadcrumb-item active text-white-50"
                  aria-current="page"
                >
                <a href="/">Home</a>
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>

    <!-- <div class="section">
      <div class="container">
        <div class="row mb-5 align-items-center">
          
        </div>
      </div>
    </div> -->
    <div class="section section-properties">
      <div class="container">
        <div class="row">
          <?php  foreach ($agents as $i => $item): ?>
          <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4 mb-3">
             <div class="property-item">
              <div class="box">
                    <img src="/<?php  echo $item['user_image'];  ?>" alt="...Property image" class="img-fluid" style="width: 360px; height:350px;" />
              </div>
              <div class="property-content">
                      <span class="city d-block mb-3">Agent <?php  echo $item['first_name']." ".$item['last_name']; ?></span>
                      <span class="d-block mb-3"><?php  echo $item['email_address']; ?></span>
                      <a
                        href="/agent_property?agent=<?php echo $item['id'] ?>"
                        class="btn btn-primary py-2 px-3"
                        >View properties by agent</a
                      >
                    </div>
                  </div>
            </div>
            
            <!-- .item -->
          
          <?php  endforeach; ?>
        </div>
        <?php if(empty($agents)): ?>
                <div class="alert alert-warning alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                <center><strong>No agent</strong></center>
                <button type="button" class="btn-close" data-bs-dismiss="alert" ></button>
                </div>
                <?php endif; ?>
                <?php if(isset($_SESSION['roleId'])) :?>
                          <?php if($_SESSION['roleId'] == 3): ?>
                            <a href="/agent_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
                        <?php if(isset($_SESSION['roleId'])) :?>
                          <?php if($_SESSION['roleId'] == 2): ?>
                            <a href="/admin_dashboard" class="btn  btn-warning">Go back</a>
                          <?php endif; ?>
                        <?php endif; ?>
        </div>  
      </div>
  
