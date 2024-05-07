@extends('layouts.base-admin')
@php
$baseAsset = asset('assets');
$user = auth()->user();
@endphp
@section('content')
<div class="d-flex flex-column flex-column-fluid">
	<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
		<div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
			<div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
				<h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0"> 
					Dashboard admin
				</h1>
				<ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
					<li class="breadcrumb-item text-muted">
						<a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
					</li>
					<li class="breadcrumb-item">
						<span class="bullet bg-gray-400 w-5px h-2px"></span>
					</li>
					<li class="breadcrumb-item text-muted">Layout Options</li>
				</ul>
			</div>
			<div class="d-flex align-items-center gap-2 gap-lg-3">
				<!-- add -->
			</div>
		</div>
	</div>
	<div id="kt_app_content" class="app-content flex-column-fluid">
		<div id="kt_app_content_container" class="app-container container-xxl">
			<div class="card mb-5 mb-xl-10">
				<div id="kt_account_settings_profile_details" class="collapse show">
					<section class="bg-white py-5">
						<div class="container">
							<div class="card">
								<div class="card-body">
									<!-- content -->
									<h3>
									Dashboard
									</h3>
									<hr>
									<div class="row">
										<div class="col-lg-2 col-xs-6">
											<x-metronic::box-stat
												:id="'cnt_doctor'"
												:name="'Jumlah dokter'"
												:number="1337"
												/>
										</div>
										<div class="col-lg-2 col-xs-6">
											<x-metronic::box-stat
												:id="'cnt_member'"
												:name="'Jumlah member'"
												:number="1337"
												/>
										</div>
										<div class="col-lg-2 col-xs-6">
											<x-metronic::box-stat
												:id="'cnt_session'"
												:name="'Jumlah sesi'"
												:number="1337"
												/>
										</div>
										<div class="col-lg-2 col-xs-6">
											<x-metronic::box-stat
												:id="'cnt_day_session'"
												:name="'Jumlah hari sesi'"
												:number="1337"
												/>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-3 col-xs-6">
											<x-metronic::box-stat
												:id="'last_session_at'"
												:name="'Sesi terakhir'"
												:number="'07/11/2023 13:00'"
												:numClass="'h2'"
												/>
										</div>
										<div class="col-lg-3 col-xs-6">
											<x-metronic::box-stat
												:id="'next_session_at'"
												:name="'Sesi berikut'"
												:number="'07/11/2023 13:00'"
												:numClass="'h2'"
												/>
										</div>
									</div>
									<hr>
									<h4>
									Jadwal kemoterapi
									</h4>
									<div id="main" class="mb-5" style="width: 100%;height:60vh;"></div>
								</div>
							</div>
						</div>
					</section>
					<!-- <div class="card-body pb-0" id="list_site"> Loading ... </div> -->
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script>
// pprint("hello")

let routes = {
	dashdata: "{{ route('admin.dash-data') }}",
}

let gl = {}

async function getDashData(){
	return await ajaxer.get(routes.dashdata)
}

function generateData(length, { min, max }) {
	if (length <= 0 || min >= max) {
		return [];
	}

	const data = [];
	for (let i = 0; i < length; i++) {
		const randomValue = Math.floor(Math.random() * (max - min + 1)) + min;
		data.push(randomValue);
	}

	return data;
}


var options = {
	series: [
		{
			name: 'Metric1',
			data: generateData(18, {
				min: 0,
				max: 90
			})
		},
	],
	chart: {
		height: 350,
		type: 'heatmap',
	},
	dataLabels: {
		enabled: false
	},
	colors: ["#008FFB"],
	title: {
		text: 'HeatMap Chart (Single color)'
	},
};

var chart = new ApexCharts(document.querySelector("#chart"), options);
// chart.render();


function getVirtualData(year) {
	const date = +echarts.time.parse(year + '-01-01');
	const end = +echarts.time.parse(year + '-12-31');
	const dayTime = 3600 * 24 * 1000;
	const data = [];
	for (let time = date; time <= end; time += dayTime) {
		data.push([
		echarts.time.format(time, '{yyyy}-{MM}-{dd}', false),
		Math.floor(Math.random() * 10000)
		]);
	}
	return data;
}

var myChart = echarts.init(
	document.getElementById('main')
);

function getBaseChartOpt(){
	/* 
	Green: '#2ECC71',
	Gray: '#7F8C8D',
	Red: '#E74C3C',
	Blue: '#3498DB',
	Yellow: '#F1C40F',
	*/
	let today = moment(new Date()).format("YYYY-MM-DD")
	let dates = []

	return {
		/* tooltip: {
			position: 'top'
		}, */
		tooltip: {
			// todo
			position: 'top',
			formatter: function (params) {
				const date = params.value[0];
				const v = params.value[1];
				let msg = "-"

				if(v==1){
					msg = "Selesai"
				}
				return `Date: ${date}<br> 
					${msg}`;
			}
		},
		grid: {
			height: '50%',
			top: '10%'
		},
		visualMap: {
			"show": false,
			"min": 0,
			"max": 4,
			inRange: {
				color: [
					'#F1C40F', // yellow
					'#2ECC71', // green
					'#3498DB', // blue // awal siklus
					'#7F8C8D', // gray
					'#E74C3C', // red
				]
			}
		},
		calendar: {
			"range": [
				"2023-10-01", 
				// "2023-12-31"
				"2024-04-30"
			],
		},
		series: {
			"type": "heatmap",
			coordinateSystem: "calendar",
			label: {
				show: true
			},
			"data": []
		}
	}
}

// echart
async function setupChart(opt={}){
	let option = getBaseChartOpt()
	option = {
		...option,
		...opt,
	}
	
	option && myChart.setOption(option);
}

async function setup(opt={}){
	let dtime = moment(new Date()).format("DD/MM/YYYY H:m")

	let res = await getDashData()

	if(res.success){
		let d = res.data
		
		$("#cnt_doctor span.fw-bold").html(d.cnt_doctor)
		$("#cnt_member span.fw-bold").html(d.cnt_member)
		$("#cnt_session span.fw-bold").html(d.cnt_session)
		$("#cnt_day_session span.fw-bold").html(d.cnt_day_session)
		$("#last_session_at .h2").html(d.last_session_at)
		$("#next_session_at .h2").html(d.next_session_at)

		let today = moment()

		// heatmap
		let dates = []
		let cdata = d.proto_scoped.map((e)=>{
			/* return [
				e.date, e.date < today ? 1 : 0
			] 
			*/
			// todo
			let status = 0
			let isPastAttdFailed = today > e.date && e.attd == 0

			if(e.day == 1){
				status = 2 // blue
			}

			if(e.attd == 1){
				status = 1
			}

			if(isPastAttdFailed){
				status = 4
			}

			dates.push(new Date(e.date))

			return {
				label: {
					show: true,
					formatter: (param) => {
						let v = param.value
						let dayOfMonth = moment.utc(v[0])
						// cl([v[0], dayOfMonth.format("YYYY-MM-DD")])
						return dayOfMonth.format("DD")
					}
				},
				value: [e.date, status, ],
			}
		})

		let drange = [
			moment(dates.minDate())
				.format("YYYY-MM-DD"),
			// new Date("2023-09-30"),
			moment(dates.maxDate())
				.format("YYYY-MM-DD"),
		]

		setupChart({
			// proto_scoped
			series: [{
				"type": "heatmap",
				coordinateSystem: "calendar",
				label: {
					show: true
				},
				"data": cdata
			}],
			calendar: {
				"range": drange,
			},
		})
	}

	/* 
	// $("#sess-last").
	$("#sess-last .h2").html(dtime)
	$("#sess-next .h2").html(dtime) */
}

setup()
</script>
@endsection
