<!DOCTYPE html>
<html lang="en">
<head>
	@include('layouts.styles')
    @yield('styles')
	<title id="title">@yield('title', 'Health Profile Clustering System')</title>
</head>

<body> 
	@include('layouts.admin.modal')
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="{{ route('city_admin.profile.index') }}">
					<img class="img-fluid rounded d-block mx-auto" src="{{ handleNullImage(auth()->user()->getFirstMedia('avatar_image')?->getUrl()) }}"  width="100" alt="avatar.svg" />
        		</a>
				<ul class="sidebar-nav" >
					<p class="text-center mb-0
					">
						<small >City Administrator </small>
					</p>
					<li class="sidebar-header text-white">
						Pages
					</li>

					<li class="sidebar-item admin_dashboard">
						 <a class="sidebar-link" href="{{ route('city_admin.dashboard.index') }}">
              				<i class="align-middle" data-feather="hexagon"></i> <span class="align-middle">Dashboard</span>
           				 </a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('city_admin.profile.index') }}">
							 <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">My Profile</span>
						</a>
				   </li>

					<li class="sidebar-item">
						<a href="#to_brgy" data-bs-toggle="collapse" class="sidebar-link collapsed">
              				<i class="align-middle" data-feather="users"></i> <span class="align-middle">Barangay Management</span>
            			</a>
						<ul id="to_brgy" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.barangay.index') }}">Manage Barangays</a>
							</li>
							
							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.resident.index') }}">Manage Residents</a>
							</li>

							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.barangay_admin.index') }}">Brgy. Admin Registration</a>
							</li>
							
						</ul>
					</li>

					<li class="sidebar-item">
						<a href="#to_hp" data-bs-toggle="collapse" class="sidebar-link collapsed">
              				<i class="align-middle" data-feather="folder"></i> <span class="align-middle">Health Profile</span>
            			</a>
						<ul id="to_hp" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.health_issue.index') }}">Manage Health Issue</a>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.family_history.index') }}">Manage Family History</a>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.health_profile.index') }}">Manage Health Profile</a>
							</li>
						</ul>
					</li>

				   <li class="sidebar-item">
					<a href="#to_statistic" data-bs-toggle="collapse" class="sidebar-link collapsed">
						  <i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Statistics</span>
					</a>
						<ul id="to_statistic" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
						
							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.health_statistic.index') }}">Health Statistics</a>
							</li>
							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.health_statistic.family_history') }}">Family History</a>
							</li>

							<li class="sidebar-item">
								<a class="sidebar-link" href="{{ route('city_admin.health_statistic.tabular') }}">Tabular</a>
							</li>

						</ul>
					</li>
				

					<li class="sidebar-item">
						<a href="#to_schedule" data-bs-toggle="collapse" class="sidebar-link collapsed">
              				<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Manage Health Program</span>
            			</a>
						<ul id="to_schedule" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('city_admin.event.index') }}">Manage Event</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="{{ route('city_admin.calendar.index') }}">Events Calendar</a></li>
						</ul>
					</li>


					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('city_admin.activity.index') }}">
							<i class="align-middle" data-feather="activity"></i> <span class="align-middle">Activity Logs</span>
						</a>
					</li>

		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
          			<i class="hamburger align-self-center"></i>
        		</a>

				@if (url()->current() !== route('city_admin.dashboard.index'))
					<a href="{{ url()->previous() }}" class="nav-link text-decoration-none text-muted">
						<i class="fas fa-chevron-left me-1"></i> Go to Prev Page 
					</a>
				@endif

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                				<i class="align-middle" data-feather="settings"></i>
              				</a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                				<img src="{{ handleNullImage(auth()->user()->user_avatar) }}" class="avatar img-fluid rounded me-1" alt="" /> <span class="text-dark">@auth
									{{ Auth::user()->name }}
								@endauth
								</span>
              				</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="{{ route('city_admin.profile.index') }}"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="{{ route('logout') }}"
								onclick="event.preventDefault();
											  document.getElementById('logout-form').submit();">
								 {{ __('Logout') }}
							 	</a>

								<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
									@csrf
								</form>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				@yield('content')
			</main>

			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<p class="mb-0">
								<a href="index.html" class="text-muted"><strong>Health Profile Clustering System</strong></a> &copy;
							</p>
						</div>
						<div class="col-6 text-end">
							<!-- <ul class="list-inline">
								<li class="list-inline-item">
									<a class="text-muted" href="#">Support</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Help Center</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Privacy</a>
								</li>
								<li class="list-inline-item">
									<a class="text-muted" href="#">Terms</a>
								</li>
							</ul> -->
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>

	@routes
	@include('layouts.scripts')
	<script src="{{ asset('admin/js/script.js') }}"></script>
	@yield('script')

</body>

</html>