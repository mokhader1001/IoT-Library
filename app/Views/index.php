<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?php echo base_url(); ?>public/uploads/favicon.png" type="image/x-icon"/>

	<!-- Fonts and icons -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {"families":["Public Sans:300,400,500,600,700"]},
			custom: {"families":["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['http://localhost/lib/public/assets/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/plugins.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/kaiadmin.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/assets/css/demo.css">
</head>
<body>
	<div class="wrapper">
		<!-- Sidebar -->
		<div class="sidebar" data-background-color="dark">
			<div class="sidebar-logo">
				<!-- Logo Header -->
				<div class="logo-header" data-background-color="dark">

					<a href="<?php echo base_url(); ?>/body" class="logo">
<img src="<?php echo base_url(); ?>public/uploads/logo.png" 
     alt="navbar brand" 
     class="navbar-brand" 
     height="70" 
     width="auto" 
     style="object-fit: contain;">
					</a>
					<div class="nav-toggle">
						<button class="btn btn-toggle toggle-sidebar">
							<i class="gg-menu-right"></i>
						</button>
						<button class="btn btn-toggle sidenav-toggler">
							<i class="gg-menu-left"></i>
						</button>
					</div>
					<button class="topbar-toggler more">
						<i class="gg-more-vertical-alt"></i>
					</button>

				</div>
				<!-- End Logo Header -->	
			</div>	
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
	<div class="sidebar-content">
		<ul class="nav nav-secondary">

			<!-- Dashboard -->
		<li class="nav-item active">
    <a href="<?= base_url('body') ?>" class="nav-link">
        <i class="fas fa-home"></i>
        <p>Dashboard</p>
    </a>
</li>


	

			
			<li class="nav-item">
				<a data-bs-toggle="collapse" href="#base" class="collapsed" aria-expanded="false">
					<i class="fas fa-book"></i> <!-- Book icon -->
					<p>Books</p>
					<span class="caret"></span>
				</a>
				<div class="collapse" id="base">
					<ul class="nav nav-collapse">
						<li><a href="<?php echo base_url(); ?>Authors"><span class="sub-item">Authors</span></a></li>
						<li><a href="<?php echo base_url(); ?>books"><span class="sub-item">Books</span></a></li>
						
						
					</ul>
				</div>
			</li>

	<!-- Sidebar Layouts -->
<li class="nav-item">
	<a data-bs-toggle="collapse" href="#sidebarLayouts" class="collapsed" aria-expanded="false">
		<i class="fas fa-users"></i> <!-- Changed to fa-users for Library Users -->
		<p>Library Users</p>
		<span class="caret"></span>
	</a>
	<div class="collapse" id="sidebarLayouts">
		<ul class="nav nav-collapse">
			<li><a href="<?php echo base_url(); ?>lib"><span class="sub-item">Add Users</span></a></li>
		</ul>
	</div>
</li>


			<!-- Forms -->
			<li class="nav-item">
    <a data-bs-toggle="collapse" href="#libraryStaffMenu" class="collapsed" aria-expanded="false">
        <i class="fas fa-user-tie"></i> <!-- 👈 Changed icon to user-tie (professional staff icon) -->
        <p>Library Staff</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="libraryStaffMenu">
        <ul class="nav nav-collapse">
            <li>
                <a href="<?= base_url(); ?>staff/users">
                    <span class="sub-item">Manage Staff</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Library Roles & Policies -->
<li class="nav-item">
	<a data-bs-toggle="collapse" href="#libraryRoles" class="collapsed" aria-expanded="false">
		<i class="fas fa-user-shield"></i> <!-- Professional icon for roles/policies -->
		<p>Library Roles & Policies</p>
		<span class="caret"></span>
	</a>
	<div class="collapse" id="libraryRoles">
		<ul class="nav nav-collapse">
			<li>
				<a href="<?= base_url(); ?>libaray/rules">
					<span class="sub-item">Manage Roles & Access</span>
				</a>
			</li>
		</ul>
	</div>
</li>



<li class="nav-item">
    <a data-bs-toggle="collapse" href="#finance" class="collapsed" aria-expanded="false">
        <i class="fas fa-coins"></i>
        <p>Finance & Penalties</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="finance">
        <ul class="nav nav-collapse">
            <li>
                <a href="<?= base_url(); ?>finance/charges">
                    <span class="sub-item">Penalty & Damage Charges</span>
                </a>


				<a href="<?= base_url(); ?>cancel_cahrge">
                    <span class="sub-item">Cancel Charge</span>
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- User Logs -->
<li class="nav-item">
    <a data-bs-toggle="collapse" href="#userLogsMenu" class="nav-link" role="button" aria-expanded="false">
        <i class="fas fa-user-clock"></i>
        <p>User Logs</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="userLogsMenu">
        <ul class="nav flex-column ms-3">
            <li class="nav-item">
                <a href="<?= base_url('Admin/loginLogs') ?>" class="nav-link">
                    <i class="fas fa-sign-in-alt"></i> Login History
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('user-logs/activity') ?>" class="nav-link">
                    <i class="fas fa-tasks"></i> Activity Logs
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Finance -->
<li class="nav-item">
    <a data-bs-toggle="collapse" href="#financeMenu" class="nav-link" role="button" aria-expanded="false">
        <i class="fas fa-coins"></i>
        <p>Finance</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="financeMenu">
        <ul class="nav flex-column ms-3">
            <li class="nav-item">
                <a href="<?= base_url('finance/payment') ?>" class="nav-link">
                    <i class="fas fa-arrow-down"></i> Income
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('finance/expenses') ?>" class="nav-link">
                    <i class="fas fa-arrow-up"></i> Expenses
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('fetch_all_transactions') ?>" class="nav-link">
                    <i class="fas fa-exchange-alt"></i> Transactions
                </a>
            </li>
        </ul>
    </div>
</li>

<!-- Reports -->
<li class="nav-item">
    <a data-bs-toggle="collapse" href="#reportsMenu" class="nav-link" role="button" aria-expanded="false">
        <i class="fas fa-chart-line"></i>
        <p>Reports</p>
        <span class="caret"></span>
    </a>
    <div class="collapse" id="reportsMenu">
        <ul class="nav flex-column ms-3">
            <li class="nav-item">
                <a href="<?= base_url('Report/unreturned_books_report') ?>" class="nav-link">
                    <i class="fas fa-book-reader"></i> Borrowed Books
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="<?= base_url('reports/finance-summary') ?>" class="nav-link">
                    <i class="fas fa-chart-pie"></i> Finance Summary
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('reports/daily') ?>" class="nav-link">
                    <i class="fas fa-calendar-day"></i> Daily Report
                </a>
            </li> -->
        </ul>
    </div>
</li>


	<!-- Logout -->
<li class="nav-item">
    <a href="<?= base_url('logout') ?>" class="nav-link text-danger">
        <i class="fas fa-sign-out-alt"></i>
        <p>Logout</p>
    </a>
</li>


		</ul>
	</div>
</div>

		</div>
		<!-- End Sidebar -->

		<div class="main-panel">
			<div class="main-header">
				<div class="main-header-logo">
					<!-- Logo Header -->
					<div class="logo-header" data-background-color="dark">

						<a href="<?php echo base_url(); ?>public/index.html" class="logo">
							<img src="<?php echo base_url(); ?>public/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20">
						</a>
						<div class="nav-toggle">
							<button class="btn btn-toggle toggle-sidebar">
								<i class="gg-menu-right"></i>
							</button>
							<button class="btn btn-toggle sidenav-toggler">
								<i class="gg-menu-left"></i>
							</button>
						</div>
						<button class="topbar-toggler more">
							<i class="gg-more-vertical-alt"></i>
						</button>

					</div>
					<!-- End Logo Header -->
				</div>
				<!-- Navbar Header -->
				<nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">

					<div class="container-fluid">
						<nav class="navbar navbar-header-left navbar-expand-lg navbar-form nav-search p-0 d-none d-lg-flex">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pe-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Search ..." class="form-control">
							</div>
						</nav>

						<ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
							<li class="nav-item topbar-icon dropdown hidden-caret d-flex d-lg-none">
								<a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="<?php echo base_url(); ?>public/#" role="button" aria-expanded="false" aria-haspopup="true">
									<i class="fa fa-search"></i>
								</a>
								<ul class="dropdown-menu dropdown-search animated fadeIn">
									<form class="navbar-left navbar-form nav-search">
										<div class="input-group">
											<input type="text" placeholder="Search ..." class="form-control">
										</div>
									</form>
								</ul>
							</li>
							<li class="nav-item topbar-icon dropdown hidden-caret">
								<a class="nav-link dropdown-toggle" href="<?php echo base_url(); ?>public/#" id="messageDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-envelope"></i>
								</a>
							
							</li>
							<li class="nav-item topbar-icon dropdown hidden-caret">
								<a class="nav-link dropdown-toggle" href="<?php echo base_url(); ?>public/#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<i class="fa fa-bell"></i>
									<span class="notification">4</span>
								</a>
							
							</li>
							<li class="nav-item topbar-icon dropdown hidden-caret">
								<a class="nav-link" data-bs-toggle="dropdown" href="<?php echo base_url(); ?>public/#" aria-expanded="false">
									<i class="fas fa-layer-group"></i>
								</a>
								<div class="dropdown-menu quick-actions animated fadeIn">
								
									
								</div>
							</li>
							
							<li class="nav-item topbar-user dropdown hidden-caret">
	<a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
		<div class="avatar-sm">
		<img 
		src="<?= base_url('public/uploads/staff/' . (session()->get('image') ?? 'default.jpg')) ?>" 
		alt="profile image" 
				class="avatar-img rounded"
				>
		</div>
		<span class="profile-username">
			<span class="op-7">Hi,</span>
			<span class="fw-bold"><?= session()->get('username') ?></span>
		</span>
	</a>
	<ul class="dropdown-menu dropdown-user animated fadeIn">
		<div class="dropdown-user-scroll scrollbar-outer">
		<li>
	<div class="user-box">
		<div class="avatar-lg">
			<img 
				src="<?= base_url('public/uploads/staff/' . (session()->get('image') ?? 'default.jpg')) ?>" 
				alt="profile image" 
				class="avatar-img rounded"
			>
		</div>
		<div class="u-text">
			<h4><?= session()->get('username') ?></h4>
			<p class="text-muted"><?= session()->get('email') ?></p>
			<a href="<?php echo base_url(); ?>user/view_profile" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
		</div>
	</div>
</li>

			<li>
				<div class="dropdown-divider"></div>
				
 			</li>
		</div>
	</ul>
</li>

						</ul>
					</div>
				</nav>
				<!-- End Navbar -->
			</div>
			
			<div class="page-wrapper" style="display: block;">

<?= $this->renderSection('content'); ?>



</div>
		<footer class="footer mt-4">
    <div class="container d-flex justify-content-center align-items-center">
        <div class="text-muted text-center w-100">
            &copy; <?= date('Y') ?> — 
            Provided by <a href="https://smartlibraray.live/" target="_blank">SmartLibrary</a> 
            to <strong>Dhobaale Library</strong>.
        </div>
    </div>
</footer>


		</div>
		
		<!-- Custom template | don't include it in your project! -->
		<div class="custom-template">
			<div class="title">Settings</div>
			<div class="custom-content">
				<div class="switcher">
					<div class="switch-block">
						<h4>Logo Header</h4>
						<div class="btnSwitch">
							<button type="button" class=" selected changeLogoHeaderColor" data-color="dark"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
							<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Navbar Header</h4>
						<div class="btnSwitch">
							<button type="button" class="changeTopBarColor" data-color="dark"></button>
							<button type="button" class="changeTopBarColor" data-color="blue"></button>
							<button type="button" class="changeTopBarColor" data-color="purple"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
							<button type="button" class="changeTopBarColor" data-color="green"></button>
							<button type="button" class="changeTopBarColor" data-color="orange"></button>
							<button type="button" class="changeTopBarColor" data-color="red"></button>
							<button type="button" class="selected changeTopBarColor" data-color="white"></button>
							<br/>
							<button type="button" class="changeTopBarColor" data-color="dark2"></button>
							<button type="button" class="changeTopBarColor" data-color="blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="purple2"></button>
							<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
							<button type="button" class="changeTopBarColor" data-color="green2"></button>
							<button type="button" class="changeTopBarColor" data-color="orange2"></button>
							<button type="button" class="changeTopBarColor" data-color="red2"></button>
						</div>
					</div>
					<div class="switch-block">
						<h4>Sidebar</h4>
						<div class="btnSwitch">
							<button type="button" class="changeSideBarColor" data-color="white"></button>
							<button type="button" class="selected changeSideBarColor" data-color="dark"></button>
							<button type="button" class="changeSideBarColor" data-color="dark2"></button>
						</div>
					</div>
				</div>
			</div>
			<div class="custom-toggle">
				<i class="icon-settings"></i>
			</div>
		</div>
		<!-- End Custom template -->

	</div>
	<!--   Core JS Files   -->
	<script src="<?php echo base_url(); ?>public/assets/js/core/jquery-3.7.1.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/core/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Chart JS -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/chart.js/chart.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Chart Circle -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/chart-circle/circles.min.js"></script>

	<!-- Datatables -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/datatables/datatables.min.js"></script>

	<!-- Bootstrap Notify -->
	<!-- <script src="<?php echo base_url(); ?>public/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->

	<!-- jQuery Vector Maps -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/jsvectormap/world.js"></script>

	<!-- Sweet Alert -->
	<script src="<?php echo base_url(); ?>public/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

	<!-- Kaiadmin JS -->
	<script src="<?php echo base_url(); ?>public/assets/js/kaiadmin.min.js"></script>

	<!-- Kaiadmin DEMO methods, don't include it in your project! -->
	<script src="<?php echo base_url(); ?>public/assets/js/setting-demo.js"></script>
	<script src="<?php echo base_url(); ?>public/assets/js/demo.js"></script>
	<script>
		$('#lineChart').sparkline([102,109,120,99,110,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#177dff',
			fillColor: 'rgba(23, 125, 255, 0.14)'
		});

		$('#lineChart2').sparkline([99,125,122,105,110,124,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#f3545d',
			fillColor: 'rgba(243, 84, 93, .14)'
		});

		$('#lineChart3').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
</body>
</html>