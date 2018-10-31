<div class="sidebar-secondary-admin">
    <ul>
        <li class="<?php echo ($menu == 'dashboard')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/dashboard'); ?>">
                <span class="icon"><i class="fa fa-tachometer"></i></span>
                <span class="title">Dashboard</span>
                <span class="subtitle">View Site Overview</span>
            </a>
        </li>

        <li class="<?php echo ($menu == 'crops')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/crops') ?>">
                <span class="icon"><i class="fa fa-pagelines"></i></span>
                <span class="title">Crops</span>
                <span class="subtitle">Manage all crops</span>
            </a>
        </li>
        <li class="<?php echo ($menu == 'user_dashboard')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/userDashboard') ?>">
                <span class="icon"><i class="fa fa-pagelines"></i></span>
                <span class="title">User Dashbaord</span>
                <span class="subtitle">Manage User Dashboard</span>
            </a>
        </li>

        <!-- <li class="<?php //echo ($menu == 'invoice_schedule')? 'active': ''; ?>">
            <a href="<?php //echo base_url('admin/invoice_schedule'); ?>">
                <span class="icon"><i class="fa fa-calendar"></i></span>
                <span class="title">Invoice Schedule</span>
                <span class="subtitle">Schedule invoice for the next stage</span>
            </a>
        </li> -->

        <li class="<?php echo ($menu == 'early_bird')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/early_bird'); ?>">
                <span class="icon"><i class="fa fa-free-code-camp"></i></span>
                <span class="title">Early Bird</span>
                <span class="subtitle">Early Bird Managemnt</span>
            </a>
        </li>
        <!-- <li class="<?php // echo ($menu == 'payment_approval')? 'active': ''; ?>">
            <a href="<?php //echo base_url('admin/payment_approval'); ?>">
                <span class="icon"><i class="fa fa-calendar-check-o"></i></span>
                <span class="title">Payment Approval</span>
                <span class="subtitle">Approve Pending payment</span>
            </a>
        </li> -->
        <li class="<?php echo ($menu == 'transactions')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/transactions'); ?>">
                <span class="icon"><i class="fa fa-money"></i></span>
                <span class="title">All Transactions</span>
                  <span class="subtitle">View all Transactions</span>
            </a>
        </li>
        <li class="<?php echo ($menu == 'users')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/users'); ?>">
                <span class="icon"><i class="fa fa-users"></i></span>
                <span class="title">All Users</span>
                  <span class="subtitle">View all registered users</span>
            </a>
        </li>
        <!-- <li class="<?php //echo ($menu == 'manual_booking')? 'active': ''; ?>">
            <a href="<?php //echo base_url('admin/manual_booking'); ?>">
                <span class="icon"><i class="fa fa-users"></i></span>
                <span class="title">Manual Booking</span>
                  <span class="subtitle">Book paid transactions manually</span>
            </a>
        </li> -->
        <li class="<?php echo ($menu == 'post')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/post'); ?>">
                <span class="icon"><i class="fa fa-pencil-square-o"></i></span>
                <span class="title">Post</span>
                  <span class="subtitle">Blog Management</span>
            </a>
        </li>
        <li class="<?php echo ($menu == 'testimonials')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/testimonials'); ?>">
                <span class="icon"><i class="fa fa-comments"></i></span>
                <span class="title">Testimonials</span>
                  <span class="subtitle">Manage Testimonials</span>
            </a>
        </li>
        <li class="<?php echo ($menu == 'site_options')? 'active': ''; ?>">
            <a href="<?php echo base_url('admin/site_options'); ?>">
                <span class="icon"><i class="fa fa-cogs"></i></span>
                <span class="title">Site Options</span>
                  <span class="subtitle">Manage your website</span>
            </a>
        </li>

        <!-- <li >
            <a href="admin-notifications.html">
                <span class="icon"><i class="fa fa-bell"></i></span>
                <span class="title">Notifications</span>
                <span class="subtitle">Alert messages</span>
            </a>
        </li> -->
    </ul>
</div><!-- /.sidebar-secondary-admin -->
