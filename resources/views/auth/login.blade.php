<!DOCTYPE html>
<html lang="en">

<head>
	<title>Login</title>
	<meta charset="utf-8" />
	<meta name="description"
		content="The most advanced Bootstrap 5 Admin Theme with 40 unique prebuilt layouts on Themeforest trusted by 100,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel versions. Grab your copy now and get life-time updates for free." />
	<meta name="keywords"
		content="metronic, bootstrap, bootstrap 5, angular, VueJs, React, Asp.Net Core, Rails, Spring, Blazor, Django, Express.js, Node.js, Flask, Symfony & Laravel starter kits, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
	<link href="{{ $_baseurl }}assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="{{ $_baseurl }}assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
</head>

<body id="kt_body" class="app-blank">
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
	<div class="d-flex flex-column flex-root" id="kt_app_root">
		<style>
			body {
				background-image: url('{{ $_baseurl }}assets/media/auth/bg10.jpeg');
			}

			[data-bs-theme="dark"] body {
				background-image: url('{{ $_baseurl }}assets/media/auth/bg10-dark.jpeg');
			}
		</style>
		<div class="d-flex flex-column flex-lg-row flex-column-fluid">
			<div class="d-flex flex-lg-row-fluid row">
				<div class="d-flex flex-column flex-center col-sm-12 col-lg-6">
					<img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
						src="{{ $_baseurl }}assets/images/guonco.png" alt="" />
					<img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20"
						src="{{ $_baseurl }}assets/images/guonco.png" alt="" />
					<h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">
						App
					</h1>
					<div class="text-gray-600 fs-base text-center fw-semibold">
						Masuk ke akun anda
					</div>
				</div>
				<div
					class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12
						col-md-12 col-lg-6">
					<div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
						<div class="d-flex flex-center flex-column align-items-stretch h-lg-100 w-md-400px">
							<div class="d-flex flex-center flex-column-fluid pb-15 pb-lg-20">
								<form method="POST" class="form w-100" novalidate="novalidate" id="kt_sign_in_form"
									data-kt-redirect-url="{{ route('admin.home') }}" action="{{ route('login') }}">
									@csrf
									@error('email')
									<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
									</span>
									@enderror
									<div class="text-center mb-11">
										<h1 class="text-dark fw-bolder mb-3">Sign In</h1>
										<div class="text-gray-500 fw-semibold fs-6">-</div>
									</div>
									<div class="fv-row mb-8">
										<input type="text" placeholder="Email" name="username" autocomplete="off"
											class="form-control bg-transparent" />
									</div>
									<div class="fv-row mb-3">
										<input type="password" placeholder="Password" name="password" autocomplete="off"
											class="form-control bg-transparent" />
									</div>
									<div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
										<div></div>
										<a href="#" class="link-primary">Lupa Password ?</a>
									</div>
									<div class="d-grid mb-10">
										<button type="submit" id="kt_sign_in_submit" class="btn btn-primary">
											<span class="indicator-label">Sign In</span>
											<span class="indicator-progress">Please wait...
												<span
													class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
										</button>
									</div>
									<!-- <div class="text-gray-500 text-center fw-semibold fs-6">
										Anda belum terdaftar?
										<a href="#" class="link-primary">Daftar di sini</a>
									</div> -->
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			var loginUrl = "{{route('login')}}";
		</script>
		<script>
			var hostUrl = "assets/";
		</script>
		<script src="{{ $_baseurl }}assets/js/app.js"></script>
		<script src="{{ $_baseurl }}assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{ $_baseurl }}assets/js/scripts.bundle.js"></script>
		<script src="{{ $_baseurl }}assets/js/custom/authentication/sign-in/general.js"></script>
</body>

</html>
