<!DOCTYPE html>
<html lang="en">

<head>
	<base href="../" />
	<title>
		<?= $_title ?? "Guonco connect" ?>
	</title>
	<meta charset="utf-8" />
	<meta name="description" content="Guonco connect chemotherapy track" />
	<meta name="keywords" content="guonco, connect, chemotherapy, track, chemo, " />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="article" />
	<meta property="og:title" content="Guonco connect" />
	<meta property="og:url" content="https://guonco-connect.com/" />
	<meta property="og:site_name" content="Guonco connect" />

	<link rel="shortcut icon" href="<?= $_baseurl ?>/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="<?= $_baseurl ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= $_baseurl ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?= $_baseurl ?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
		type="text/css" />
	<style>
		.hide {
			display: none;
		}

	</style>
	<script>
		let baseUrl = "<?= $_baseurl ?>"

	</script>
</head>

<body id="kt_app_body" data-kt-app-layout="dark-sidebar" data-kt-app-header-fixed="true"
	data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-hoverable="true"
	data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true"
	data-kt-app-sidebar-push-footer="true" data-kt-app-toolbar-enabled="true" class="app-default">
	<!--begin::Theme mode setup on page load-->
	<script>
		var defaultThemeMode = "light";
		var themeMode;
		if (document.documentElement) {
			if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
				themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
			} else {
				if (localStorage.getItem("data-bs-theme") !== null) {
					themeMode = localStorage.getItem("data-bs-theme");
				} else {
					themeMode = defaultThemeMode;
				}
			}
			if (themeMode === "system") {
				themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
			}
			document.documentElement.setAttribute("data-bs-theme", themeMode);
		}

	</script>
	<!--end::Theme mode setup on page load-->
	<!--begin::App-->
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<!--begin::Header Section-->
		<div class="mb-0" id="home">
			<!--begin::Wrapper-->
			<div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg"
				style="background-image: url(assets/media/svg/illustrations/landing.svg)">
				<!--begin::Header-->
				<div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header"
					data-kt-sticky-offset="{default: '200px', lg: '300px'}">
					<!--begin::Container-->
					<div class="container">
						<!--begin::Wrapper-->
						<div class="d-flex align-items-center justify-content-between">
							<!--begin::Logo-->
							<div class="d-flex align-items-center flex-equal">
								<!--begin::Mobile menu toggle-->
								<button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none"
									id="kt_landing_menu_toggle">
									<!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
									<span class="svg-icon svg-icon-2hx">
										<svg width="24" height="24" viewBox="0 0 24 24" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path
												d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
												fill="currentColor" />
											<path opacity="0.3"
												d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
												fill="currentColor" />
										</svg>
									</span>
									<!--end::Svg Icon-->
								</button>
								<!--end::Mobile menu toggle-->
								<!--begin::Logo image-->
								<a href="<?= $_baseurl ?>">
									<img alt="Logo" src="<?= $_baseurl ?>assets/images/favicon-128x128.png"
										class="logo-default h-60px h-lg-60px" />
									<img alt="Logo" src="<?= $_baseurl ?>assets/images/favicon-128x128.png"
										class="logo-sticky h-20px h-lg-25px" />
								</a>
								<!--end::Logo image-->
							</div>
							<!--end::Logo-->
							<!--begin::Menu wrapper-->
							<div class="d-lg-block" id="kt_header_nav_wrapper">
								<div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true"
									data-kt-drawer-name="landing-menu"
									data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
									data-kt-drawer-width="200px" data-kt-drawer-direction="start"
									data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true"
									data-kt-swapper-mode="prepend"
									data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
									<!--begin::Menu-->
									<div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-semibold"
										id="kt_landing_menu">
										<!--begin::Menu item-->
										<div class="menu-item">
											<!--begin::Menu link-->
											<a class="menu-link nav-link active py-3 px-4 px-xxl-6" href="#"
												data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">Beranda</a>
											<!--end::Menu link-->
										</div>
										<!--end::Menu item-->
										<!-- wip todo add menus -->
									</div>
									<!--end::Menu-->
								</div>
							</div>
							<!--end::Menu wrapper-->
							<!--begin::Toolbar-->
							<div class="flex-equal text-end ms-1">
								<!-- <a href="../../demo1/dist/authentication/layouts/basic/sign-in.html"
									class="btn btn-success">Sign In</a> -->
								@if (Route::has('login'))
								<div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
									@auth
									<a href="{{ route('admin.home') }}" class="btn btn-success">Home</a>
									@else
									<a href="{{ route('login') }}" class="btn btn-success">Log in</a>

									@if (Route::has('register'))
									<a href="{{ route('register') }}" class="btn btn-success">Register</a>
									@endif
									@endauth
								</div>
								@endif
							</div>
							<!--end::Toolbar-->
						</div>
						<!--end::Wrapper-->
					</div>
					<!--end::Container-->
				</div>
				<!--end::Header-->
				<!--begin::Landing hero-->
				<div class="d-flex flex-column flex-center w-100 min-h-350px min-h-lg-500px px-9">
					<!--begin::Heading-->
					<div class="text-center mb-5 mb-lg-10 py-10 py-lg-20">
						<!--begin::Title-->
						<h1 class="text-white lh-base fw-bold fs-2x fs-lg-3x mb-15">
							Selamat datang di
							<br />
							<span
								style="background: linear-gradient(to right, #12CE5D 0%, #FFD80C 100%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">
								<span id="kt_landing_hero_text">Guonco connect</span>
							</span>
						</h1>
						<!--end::Title-->
						<!--begin::Action-->
						<a href="https://app.guonco-connect.com/" target="_blank" 
							class="btn btn-primary">Ke aplikasi</a>
						<!--end::Action-->
					</div>
					<!--end::Heading-->
					<!--begin::Clients-->
					<div class="d-flex flex-center flex-wrap position-relative px-5">
						<!--begin::Client-->
						<div class="d-flex flex-center m-3 m-md-6" data-bs-toggle="tooltip" title="Fujifilm">
							<img src="assets/media/svg/brand-logos/fujifilm.svg" class="mh-30px mh-lg-40px" alt="" />
						</div>
						<!--end::Client-->
						<!-- wip todo add client -->
					</div>
					<!--end::Clients-->
				</div>
				<!--end::Landing hero-->
			</div>
			<!--end::Wrapper-->
			<!--begin::Curve bottom-->
			<div class="landing-curve landing-dark-color mb-10 mb-lg-20">
				<svg viewBox="15 12 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M0 11C3.93573 11.3356 7.85984 11.6689 11.7725 12H1488.16C1492.1 11.6689 1496.04 11.3356 1500 11V12H1488.16C913.668 60.3476 586.282 60.6117 11.7725 12H0V11Z"
						fill="currentColor"></path>
				</svg>
			</div>
			<!--end::Curve bottom-->
		</div>
		<!--end::Header Section-->
		@yield('after-header')
		<div class="mb-0">
			<!--begin::Curve top-->
			<div class="landing-curve landing-dark-color">
				<svg viewBox="15 -1 1470 48" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path
						d="M1 48C4.93573 47.6644 8.85984 47.3311 12.7725 47H1489.16C1493.1 47.3311 1497.04 47.6644 1501 48V47H1489.16C914.668 -1.34764 587.282 -1.61174 12.7725 47H1V48Z"
						fill="currentColor"></path>
				</svg>
			</div>
			<!--end::Curve top-->
			<!--begin::Wrapper-->
			<div class="landing-dark-bg pt-20">
				<!--begin::Container-->
				<div class="container">
					<!--begin::Row-->
					<div class="row py-10 py-lg-20">
						<!--begin::Col-->
						<div class="col-lg-6 pe-lg-16 mb-10 mb-lg-0">
							<!--begin::Block-->
							<div class="rounded landing-dark-border p-9">
								<!--begin::Title-->
								<h2 class="text-white">Tentang</h2>
								<!--end::Title-->
								<!--begin::Text-->
								<span class="fw-normal fs-4 text-gray-700">Hubungi kami.
									<a href="#" class="text-white opacity-50 text-hover-primary">Click</a></span>
								<!--end::Text-->
							</div>
							<!--end::Block-->
						</div>
						<!--end::Col-->
						<!--begin::Col-->
						<div class="col-lg-6 ps-lg-16">
							<!--begin::Navs-->
							<div class="d-flex justify-content-center">
								<!--begin::Links-->
								<div class="d-flex fw-semibold flex-column me-20">
									<!--begin::Subtitle-->
									<h4 class="fw-bold text-gray-400 mb-6">Link</h4>
									<!--end::Subtitle-->
									<!--begin::Link-->
									<a href="#"
										class="text-white opacity-50 text-hover-primary fs-5 mb-6">FAQ</a>
									<!--end::Link-->
									<!-- wip todo add links -->
								</div>
								<!--end::Links-->
								<!--begin::Links-->
								<div class="d-flex fw-semibold flex-column ms-lg-20">
									<!--begin::Subtitle-->
									<h4 class="fw-bold text-gray-400 mb-6">Hubungi kami</h4>
									<!--end::Subtitle-->
									<!--begin::Link-->
									<a href="#" class="mb-6">
										<img src="assets/media/svg/brand-logos/facebook-4.svg" class="h-20px me-2"
											alt="">
										<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Facebook</span>
									</a>
									<!--end::Link-->
									<!--begin::Link-->
									<a href="#" class="mb-6">
										<img src="assets/media/svg/brand-logos/twitter.svg" class="h-20px me-2" alt="">
										<span class="text-white opacity-50 text-hover-primary fs-5 mb-6">Twitter</span>
									</a>
									<!--end::Link-->
									<!--begin::Link-->
									<a href="#" class="mb-6">
										<img src="assets/media/svg/brand-logos/instagram-2-1.svg" class="h-20px me-2"
											alt="">
										<span
											class="text-white opacity-50 text-hover-primary fs-5 mb-6">Instagram</span>
									</a>
									<!--end::Link-->
								</div>
								<!--end::Links-->
							</div>
							<!--end::Navs-->
						</div>
						<!--end::Col-->
					</div>
					<!--end::Row-->
				</div>
				<!--end::Container-->
				<!--begin::Separator-->
				<div class="landing-dark-separator"></div>
				<!--end::Separator-->
				<!--begin::Container-->
				<div class="container">
					<!--begin::Wrapper-->
					<div class="d-flex flex-column flex-md-row flex-stack py-7 py-lg-10">
						<!--begin::Copyright-->
						<div class="d-flex align-items-center order-2 order-md-1">
							<!--begin::Logo-->
							<a href="$_baseurl">
								<img alt="Logo" src="<?= $_baseurl ?>assets/images/favicon-128x128.png" 
									class="h-15px h-md-20px">
							</a>
							<!--end::Logo image-->
							<!--begin::Logo image-->
							<span class="mx-5 fs-6 fw-semibold text-gray-600 pt-1" href="https://keenthemes.com">© 2023
								Keenthemes Inc.</span>
							<!--end::Logo image-->
						</div>
						<!--end::Copyright-->
						<!--begin::Menu-->
						<ul class="menu menu-gray-600 menu-hover-primary fw-semibold fs-6 fs-md-5 order-1 mb-5 mb-md-0">
							<li class="menu-item">
								<a href="#" class="menu-link px-2">About</a>
							</li>
							<!-- wip todo add menu -->
						</ul>
						<!--end::Menu-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Container-->
			</div>
			<!--end::Wrapper-->
		</div>
	</div>
	<!--end::App-->
	<!--end::Drawers-->
	<!--begin::Scrolltop-->
	<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
		<!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
		<span class="svg-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
					fill="currentColor" />
				<path
					d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
					fill="currentColor" />
			</svg>
		</span>
		<!--end::Svg Icon-->
	</div>
	<!--end::Scrolltop-->
	<!--begin::Javascript-->
	<script>
		var hostUrl = "assets/";

	</script>
	<!--begin::Global Javascript Bundle(mandatory for all pages)-->
	<script src="<?= $_baseurl ?>assets/plugins/global/plugins.bundle.js"></script>
	<script src="<?= $_baseurl ?>assets/js/scripts.bundle.js"></script>
	<script type="text/javascript" src="<?= $_baseurl ?>assets/js/util.js"> </script>
	<script src="<?= $_baseurl ?>assets/plugins/custom/datatables/datatables.bundle.js"></script>
	<script src="<?= $_baseurl ?>assets/js/app.js"></script>
	<script src="<?= $_baseurl ?>assets/js/ajaxer.js"></script>

	@yield('scripts')
</body>

</html>
