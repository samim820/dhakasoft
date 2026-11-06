  


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->

       <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">Smart ISP</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

         
                    <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                DASHBOARD
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="loginmsg.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Login Msg</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Online User (ALL)</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="onlineuser.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Online User (STD)</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="billcollection.php" class="nav-link">
              <i class="nav-icon fas fa fa-coins"></i>
              <p>
                Collection Bill
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>

<?php if ($isMain): ?>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
            <i class="nav-icon fa fa-users"></i>
              <p>
                 STD/ZONE
                <i class="fas fa-angle-left right"></i>
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crate ZONE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List ZONE</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payments</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ZONE Cust Summ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ZONE Coll Summ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>STD Coll Summ</p>
                </a>
              </li>
            </ul>
          </li>

<?php endif; ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              
              <i class="nav-icon fas fa-sitemap"></i>
              <p>
                HOME/SOHO
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="adduser.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="userlist.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="payments.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Payments</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="package.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Package</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="pop.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>POP</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="area.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Area</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="thana.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thana</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="distric.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Distric</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="billingcycle.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Billing Cycle</p>
                </a>
              </li>

<?php if ($isMain): ?>
                <li class="nav-item">
                <a href="importuser.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Import User</p>
                </a>
              </li>
            <?php endif; ?>


                <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cust summ</p>
                </a>
              </li>
                <li class="nav-item">
                <a href="" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add User</p>
                </a>
              </li>
            </ul>
          </li>
                  <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                TICKET
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crate Ticket</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>New Connection</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Ticket</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>My Ticket</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Summary Graph</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Topics</p>
                </a>
              </li>
            </ul>
          </li>
           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-sms"></i>
              <p>
                SMS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="smsreports.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reports</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="sms_setings.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SMS Template</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="send_sms.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Send SMS</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bulk SMS</p>
                </a>
              </li>

              <?php if ($isMain): ?>

                 <li class="nav-item">
                <a href="sms_api.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>API Setings</p>
                </a>
              </li>
<?php endif;?>

            </ul>
          </li>
                     <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file-invoice"></i>
              <p>
                ACCOUNTS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="cost.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Running Cost</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="cost_category.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
            </ul>
          </li>

          

<?php if ($isMain): ?>

            <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-graduate"></i>
              <p>
                SUPER USER
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="superuserlist.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
            </ul>
          </li>

                               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-line"></i>
              <p>
                REPORTS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
            </ul>
          </li>
                               <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-network-wired"></i>
              <p>
                FTTH
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/charts/chartjs.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ChartJS</p>
                </a>
              </li>
            </ul>
          </li>

          
        <?php endif; ?>

          <?php if ($isMain): ?>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fas fa-server"></i>
              <p>
                Device
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="nas.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>NAS Device</p>
                </a>
              </li>
            </ul>
          </li>

        <?php endif; ?>


        <?php if ($isMain): ?>

          <li class="nav-header">SETINGS</li>
          <li class="nav-item">
            <a href="" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                PAYMENT GATEWAY
              </p>
            </a>
          </li>
            <li class="nav-item">
            <a href="syslog.php" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Sys Log
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mail
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
           
            </ul>
          </li>
                <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
               SETINGS
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
           
            </ul>
          </li>

        <?php endif;?>

          <li class="nav-item">
            <a href="" class="nav-link">

              <p>
               Version 1.0.0
              </p>
            </a>
          </li>
          
          
      
 
        


        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>