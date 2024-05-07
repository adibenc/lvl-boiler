@extends('layouts.base') 

@php $baseAsset = asset('assets'); 
@endphp

@section('header')
<!-- header --> 
@endsection

@section('after-header')
<!-- content -->
<!-- #wip todo add after header
1. about
2. aplikasi
3. gambar/ilustrasi aplikasi

## about
1. Satu Data, Efisien & Efektif
2. Sehat & Segera

-->
<div class="z-index-2">
	<div class="container">
		<div class="text-center mb-17">
			<h3 class="fs-2hx text-dark mb-5" id="how-it-works" data-kt-scroll-offset="{default: 100, lg: 150}">
				Tentang</h3>
			<div class="fs-5 text-muted fw-bold">Aplikasi untuk membantu bisnis proses</div>
		</div>
		<div class="row w-100 gy-10 mb-md-20">
			<div class="col-md-4 px-5">
				<div class="text-center mb-10 mb-md-0">
					<img src="assets/media/illustrations/sketchy-1/2.png" class="mh-125px mb-9" alt="">
					<div class="d-flex flex-center mb-5">
						<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">1</span>
						<div class="fs-5 fs-lg-3 fw-bold text-dark">#1 Simple</div>
					</div>
					<div class="fw-semibold fs-6 fs-lg-4 text-muted">
						Digitalisasi memaksimalkan alur penyimpanan data sehingga efisien dari segi waktu & biaya.
					</div>
				</div>
			</div>
			<div class="col-md-4 px-5">
				<div class="text-center mb-10 mb-md-0">
					<img src="assets/media/illustrations/sketchy-1/8.png" class="mh-125px mb-9" alt="">
					<div class="d-flex flex-center mb-5">
						<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">2</span>
						<div class="fs-5 fs-lg-3 fw-bold text-dark">#2 Cepat</div>
					</div>
					<div class="fw-semibold fs-6 fs-lg-4 text-muted">
						Kesederhanaan manajemen data mempercepat akses dan manajemen
					</div>
				</div>
			</div>
			<div class="col-md-4 px-5">
				<div class="text-center mb-10 mb-md-0">
					<img src="assets/media/illustrations/sketchy-1/12.png" class="mh-125px mb-9" alt="">
					<div class="d-flex flex-center mb-5">
						<span class="badge badge-circle badge-light-success fw-bold p-5 me-3 fs-3">3</span>
						<div class="fs-5 fs-lg-3 fw-bold text-dark">#3 Terintegrasi</div>
					</div>
					<div class="fw-semibold fs-6 fs-lg-4 text-muted">
						Sistem terintegrasi dengan pihak ketiga untuk mendukung interkoneksi
					</div>
				</div>
			</div>
		</div>
		<div class="tns tns-default tns-initiazlied">
			<div class="tns-outer" id="tns1-ow">
				<div class="tns-liveregion tns-visually-hidden" aria-live="polite" aria-atomic="true">slide <span
						class="current">3</span> of 4 </div>
				<div id="tns1-mw" class="tns-ovh">
					<div class="tns-inner" id="tns1-iw">
						<div data-tns="true" data-tns-loop="true" data-tns-swipe-angle="false" data-tns-speed="2000"
							data-tns-autoplay="true" data-tns-autoplay-timeout="18000" data-tns-controls="true"
							data-tns-nav="false" data-tns-items="1" data-tns-center="false" data-tns-dots="false"
							data-tns-prev-button="#kt_team_slider_prev1" data-tns-next-button="#kt_team_slider_next1"
							class="  tns-slider tns-carousel tns-subpixel tns-calc tns-horizontal" id="tns1"
							data-kt-initialized="1" style="transform: translate3d(-33.3333%, 0px, 0px);">
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10 tns-item tns-slide-cloned"
								aria-hidden="true" tabindex="-1">
								<img src="assets/media/preview/demos/demo5/light-ltr.png"
									class="card-rounded shadow mh-lg-650px mw-100" alt="">
							</div>
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10 tns-item" id="tns1-item0"
								aria-hidden="true" tabindex="-1">
								<img src="assets/media/preview/demos/demo1/light-ltr.png"
									class="card-rounded shadow mh-lg-650px mw-100" alt="">
							</div>
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10 tns-item tns-slide-active"
								id="tns1-item1">
								<img src="assets/media/preview/demos/demo2/light-ltr.png"
									class="card-rounded shadow mh-lg-650px mw-100" alt="">
							</div>
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10 tns-item" id="tns1-item2"
								aria-hidden="true" tabindex="-1">
								<img src="assets/media/preview/demos/demo4/light-ltr.png"
									class="card-rounded shadow mh-lg-650px mw-100" alt="">
							</div>
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10 tns-item" id="tns1-item3"
								aria-hidden="true" tabindex="-1">
								<img src="assets/media/preview/demos/demo5/light-ltr.png"
									class="card-rounded shadow mh-lg-650px mw-100" alt="">
							</div>
							<div class="text-center px-5 pt-5 pt-lg-10 px-lg-10 tns-item tns-slide-cloned"
								aria-hidden="true" tabindex="-1">
								<img src="assets/media/preview/demos/demo1/light-ltr.png"
									class="card-rounded shadow mh-lg-650px mw-100" alt="">
							</div>
						</div>
					</div>
				</div>
			</div>
			<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_prev1" aria-controls="tns1"
				tabindex="-1" data-controls="prev">
				<span class="svg-icon svg-icon-3x">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z"
							fill="currentColor"></path>
					</svg>
				</span>
			</button>
			<button class="btn btn-icon btn-active-color-primary" id="kt_team_slider_next1" aria-controls="tns1"
				tabindex="-1" data-controls="next">
				<span class="svg-icon svg-icon-3x">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path
							d="M12.6343 12.5657L8.45001 16.75C8.0358 17.1642 8.0358 17.8358 8.45001 18.25C8.86423 18.6642 9.5358 18.6642 9.95001 18.25L15.4929 12.7071C15.8834 12.3166 15.8834 11.6834 15.4929 11.2929L9.95001 5.75C9.5358 5.33579 8.86423 5.33579 8.45001 5.75C8.0358 6.16421 8.0358 6.83579 8.45001 7.25L12.6343 11.4343C12.9467 11.7467 12.9467 12.2533 12.6343 12.5657Z"
							fill="currentColor"></path>
					</svg>
				</span>
			</button>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<!-- script -->
@endsection
