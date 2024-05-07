@extends('layouts.base-admin')
@php
$baseAsset = asset('assets');
$user = auth()->user();
@endphp
@section('content')
<x-metronic::content1 :title="'Profile'">
	<div class="card mb-5 mb-xl-10">
		<div id="kt_account_settings_profile_details" class="collapse show">
			<section class="bg-white py-5">
				<div class="container">
					<div class="card">
						<div class="card-body">
							<!-- todo wip update -->
							<?php
								preson($_user->withProfile());
							?>
						</div>
					</div>
				</div>
			</section>
			<!-- <div class="card-body pb-0" id="list_site"> Loading ... </div> -->
		</div>
	</div>
</x-metronic::content1>
@endsection
@section('scripts')
<script>
// pprint("hello")
</script>
@endsection
