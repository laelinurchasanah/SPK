   <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="welcome.php" class="navbar-brand"><b><?= $row_rs_config['header']; ?></b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
           
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
               
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <img src="assets/dist/img/login.png" class="user-image" alt="User Image">
                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                <?= $row_rs_config['text1']; ?>
              </a>
              <ul class="dropdown-menu">
                 
                <!-- Menu Body -->
                <li class="user-body">
                  <div class="row">
                  <div class="box-body">
                    <form action="<?php echo $loginFormAction; ?>" method="POST" name="login" autocomplete="off">
                          <div class="form-group has-feedback">
                            <input type="text" class="form-control" name="ngapainpake" placeholder="Username">
                            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                          </div>
                          <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="inspecthalaman" placeholder="Password">
                            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              <button type="submit" class="btn btn-info btn-block btn-flat">Sign In</button>
                            </div>
                            <!-- /.col -->
                          </div>
                        </form>
                  </div>
                  </div>
                  <!-- /.row -->
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                   
                   <a href="password.php" class="btn btn-default btn-block">I forgot my password</a><br>
                      
                   
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    