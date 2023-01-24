  <?php
  function activeLink ($pageTitle,$linkName){
    if($linkName == $pageTitle){
      echo "active";
    }
  }
  ?>
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="./resource/asset/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SACCO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="./resource/asset/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["full_name"];?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="./user.php" class="nav-link  <?php activeLink($page_title,"User");?>">
              <i class="nav-icon ion-person-stalker"></i>
              <p>
                User management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./members.php" class="nav-link <?php activeLink($page_title,"Member");?>">
              <i class="nav-icon ion-ios-people"></i>
              <p>
                Members management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./account.php" class="nav-link  <?php activeLink($page_title,"Account");?>">
              <i class="nav-icon ion-ios-people"></i>
              <p>
                Account management
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="./loan.php" class="nav-link  <?php activeLink($page_title,"Loan");?>">
              <i class="nav-icon ion-ios-people"></i>
              <p>
                Loan management
              </p>
            </a>
          </li>
          <li class="nav-item <?php if($page_title == "Branch" || $page_title == "Address") echo "menu-open"; else echo "menu-close"?>">
            <a href="#" class="nav-link <?php if($page_title == "Branch" || $page_title == "Address") echo "active"?>">
              <i class="nav-icon fas ion-gear-b"></i>
              <p>
                System management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./branch.php" class="nav-link <?php activeLink($page_title,"Branch");?>">
                  <i class="fas fa-university"></i>
                  <p>Branch</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link <?php activeLink($page_title,"Address");?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Address</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>