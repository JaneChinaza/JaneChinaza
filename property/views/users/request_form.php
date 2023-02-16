<div class="hero page-inner overlay" style="background-image: url('/images/hero_bg_1.jpg'); height: 100vh;">
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <na v aria-label="breadcrumb" data-aos="fade-down" data-aos-delay="20">
                </nav>
                <div class="section">
                    <div class="container">
                        <div class="row">
                            <div class="container mt-4">
                                <h1 class="mt-4 mb-3 text-center text-white">Agent Request Form</h1>

                                <!-- this checks if that index is set so as not to avoid unnessary errors -->
                                <?php if (isset($_SESSION['role_id'])) : ?>
                                    <?php if ($_SESSION['role_id'] == 1) : ?>
                                        <!-- roleId 1 is for the default users -->
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row" style="margin-left: 12%;">
                                                <?php if (!empty($errors)) :  ?>
                                                    <div class="alert alert-danger col-10 alert-dismissible fade show tooltip-test" style="margin-left: 0%;" title="Click X to dismiss" role="alert">
                                                        <?php foreach ($errors as $error) : ?>
                                                            <div>
                                                                <?php echo $error   ?>
                                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                            </div>
                                                        <?php endforeach ?>
                                                    </div>
                                                <?php endif; ?>
                                                <label class="form-label">Why do you want to be part of our agents?</label>
                                                <div class=" col-10 mb-1">
                                                    <textarea type="text" name="reason" value="<?php echo $agent_request['reason'] ?>" class="form-control"></textarea>
                                                </div>
                                                <label class="form-label">Describe yourself in less than 100 words</label>
                                                <div class=" col-10 mb-1">
                                                    <textarea type="text" name="description" value="<?php echo $agent_request['description'] ?>" class="form-control"></textarea>
                                                </div>
                                                <label class="form-label">Years of experience</label>
                                                <div class=" col-10 mb-1">
                                                    <input type="number" step=".5" class="form-control" value="<?php echo $agent_request['years_of_experience'] ?>" name="years_of_experience">
                                                </div>
                                            </div>
                                            <center><button type="submit" class="btn btn-primary">Submit</button></center>
                                        </form>

                                    <?php elseif ($_SESSION['role_id'] == 2) : ?>
                                        <!-- roleId 2 is for Admin -->
                                        <p>I am Admin</p>
                                    <?php elseif ($_SESSION['role_id'] == 3) : ?>
                                        <!-- roleId 3 are for the Agents -->
                                        <div class="alert alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                                            <div>
                                                <P class="h5 text-center text-white"><em> You are already an Agent</em></P>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                    <?php else: ?>
                                        <div class="row" style="margin-left: 12%;">
                                            <div class="alert col-10 alert-danger alert-dismissible fade show tooltip-test" title="Click X to dismiss" role="alert">
                                                <div>
                                                    <P class="h5 text-center text-white"><em> You need to login or sign up to make this request</em></P>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                                </div>
                                            </div>
                                        </div>
                                <?php endif; ?> 
                            </div>


                            <style>
                                .form-label {
                                    font-size: 16px;
                                    color: white;
                                }

                                textarea.form-control {
                                    min-height: 90px;
                                    opacity: 0.6 !important;
                                    font-weight: 500;
                                }

                                .form-control {
                                    height: 38px;
                                    opacity: 0.6 !important;
                                    font-weight: 500;
                                }
                            </style>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>