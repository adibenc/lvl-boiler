@extends('layouts.base-admin')
@section('title')
User
@endsection
@section('content')
<x-metronic::content1 :title="'User'">
	@slot('topAction')
		<button id="btAdd" class="btn btn-primary add" 
			data-bs-toggle="modal" 
			data-bs-target="#modal">Tambah</button>
		<a id="btAddMember" href="#" class="btn btn-sm fw-bold btn-primary" 
			data-bs-toggle="modal" 
			data-bs-target="#mModal">Buat pasien</a>
		<a id="btAddMember" href="#" class="btn btn-sm fw-bold btn-primary" 
			data-bs-toggle="modal" 
			data-bs-target="#modal-import">Import pasien</a>
	@endslot
	<div class="card mb-5 mb-xl-10">
		<div id="kt_account_settings_profile_details" class="collapse show">
			<section class="bg-white py-5">
				<div class="container">
					<div class="card">
						<div class="card-body">
							<table id="datatable" class="table table-striped table-sm">
								<thead>
									<tr>
										<th>No</th>
										<th>id</th>
										<th>Nama</th>
										<th>Username</th>
										<th>Dibuat</th>
										<th>#</th>
										<th>#</th>
									</tr>
								</thead>
								<tbody id="isi">
								</tbody>
							</table>
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
<x-metronic::modal
	:id="'modal-import'"
	:title="'Import pasien'"
	:size="'modal-md'"
	>
	<!--begin::Stepper-->
	<div class="d-flex flex-column flex-xl-row flex-row-fluid" 
		id="mi" data-kt-stepper="true">
		<div class="flex-row-fluid">
			<!--begin::Form-->
			<a href="{{ asset('assets/user-import.xlsx') }}">Download format import xls</a>
			<!-- action="{{route('admin.users.import')}}"
			method="POST" -->
			<form id="fmImport" 
				class="form fv-plugins-bootstrap5 fv-plugins-framework"
				novalidate="novalidate" 
				enctype="multipart/form-data"
				data-id="">
				@csrf
				<x-metronic::f-input
					:label="'File'"
					:name="'ifile'"
					:type="'file'"
				/>
				<input id="btUp" type="submit" 
					class="btn btn-lg btn-primary" 
					data-kt-stepper-action="submit">
			</form>
		</div>
	</div>
</x-metronic::modal>
<x-metronic::modal
	:id="'modal'"
	:title="'Data user'"
	:size="'modal-xl'"
	>
	<!--begin::Stepper-->
	<div class="d-flex flex-column flex-xl-row flex-row-fluid" 
		id="kt_modal_create_app_stepper" data-kt-stepper="true">
		<!--begin::Aside-->
		
		<!--begin::Aside-->
		<!--begin::Content-->
		<div class="flex-row-fluid">
			<!--begin::Form-->
			<form id="form" 
				class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" 
				data-id="">
				<div class="row">
					<div class="col-lg-4">
						<h3>Data</h3>
						<x-metronic::f-input
							:label="'Nama'"
							:name="'name'"
						/>
						<x-metronic::f-input
							:label="'Alamat'"
							:name="'address'"
						/>
						<x-metronic::f-input
							:label="'No Telp'"
							:name="'phone'"
						/>
						<div class="row">
							<div class="col-lg-12">
								<x-metronic::f-input
									:label="'Tanggal Lahir'"
									:name="'dob'"
									type="date"
								/>
							</div>
						</div>
						<div class="">
							<label class="col-form-label fw-semibold fs-6">
								<span class="required">Role</span>
							</label>
							<div class=" fv-row fv-plugins-icon-container">
								<select class="form-control" name="role">
									<option value="superadmin">Superadmin</option>
									<option value="doctor">Doctor</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<h3>Akses</h3>
						<x-metronic::f-input
							:label="'Email'"
							:name="'email'"
						/>
						<x-metronic::f-input
							:label="'Username'"
							:name="'username'"
						/>
						<div class="">
							<label class="col-form-label fw-semibold fs-6">
								<span class="required">Password</span>
							</label>
							<div class=" fv-row fv-plugins-icon-container input-group">
								<input name="password" class="form-control" type="password"
									placeholder="password"
									value="">
								<button type="button" class="btn btn-primary bt-def-passwd"
									title="set default password">
									Set
								</button>
							</div>
						</div>
						<x-metronic::f-input
							:label="'Re Password'"
							:name="'repassword'"
							type="password"
						/>
					</div>
				</div>
				
				<div class="d-flex flex-stack pt-10">
					<!--begin::Wrapper-->
					<div class="me-2">
						
					</div>
					<!--end::Wrapper-->
					<!--begin::Wrapper-->
					<div>
						{{ $mfooter ?? "" }}
						<!-- <button id="btSubmitMember" type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit"> -->
						<input id="btSubmitMember" type="submit" 
							class="btn btn-lg btn-primary" 
							data-kt-stepper-action="submit">
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Actions-->
			</form>
			<!--end::Form-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Stepper-->
</x-metronic::modal>
<x-metronic::modal
	:id="'mModal'"
	:title="'Tambah pasien'"
	:size="'modal-xl'"
	>
	<!--begin::Stepper-->
	<div class="d-flex flex-column flex-xl-row flex-row-fluid" 
		id="kt_modal_create_app_stepper" data-kt-stepper="true">
		<!--begin::Aside-->
		
		<!--begin::Aside-->
		<!--begin::Content-->
		<div class="flex-row-fluid">
			<!--begin::Form-->
			<form id="fmMember" 
				class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate" 
				data-id="">
				<div class="row">
					<div class="col-lg-4">
						<h3>Data pasien</h3>
						<!-- x-metronic::f-input
							:label="'No register'"
							:name="'no_reg'"
						/> -->
						<x-metronic::f-input
							:label="'Nama'"
							:name="'name'"
							:attrs="'for=pasien'"
						/>
						<!-- x-metronic::f-input
							:label="'NIK'"
							:name="'nik'"
						/ -->
						<x-metronic::f-input
							:label="'Alamat'"
							:name="'address'"
						/>
						<x-metronic::f-input
							:label="'No Telp'"
							:name="'phone'"
							:attrs="'for=pasien'"
						/>
						<div class="row">
							<div class="col-lg-6">
								<div class="">
									<label class="col-form-label fw-semibold fs-6">
										<span class="required">Berat badan</span>
									</label>
									<div class=" fv-row fv-plugins-icon-container input-group">
										<input name="weight" class="form-control" type="text" placeholder="weight" value="">
										<span class="input-group-text">kg</span>
									</div>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="">
									<label class="col-form-label fw-semibold fs-6">
										<span class="required">Tinggi badan</span>
									</label>
									<div class=" fv-row fv-plugins-icon-container input-group">
										<input name="height" class="form-control" type="text" placeholder="height" value="">
										<span class="input-group-text">cm</span>
									</div>
								</div>
							</div>
							<div class="col-lg-12">
								<x-metronic::f-input
									:label="'Tanggal Lahir'"
									:name="'dob'"
									type="date"
								/>
							</div>
						</div>
					</div>
					<div class="col-lg-4">
						<h3>-</h3>
						<x-metronic::f-input
							:label="'Umur'"
							:name="'age'"
							:attrs="'disabled'"
						/>
						<x-metronic::f-input
							:label="'BSA'"
							:name="'bsa'"
							:attrs="'disabled'"
						/>
						<x-metronic::f-input
							:label="'BMI'"
							:name="'bmi'"
							:attrs="'disabled'"
						/>
					</div>
					<div class="col-lg-4">
						<h3>Akses</h3>
						<x-metronic::f-input
							:label="'Email'"
							:name="'email'"
							:attrs="'for=pasien'"
						/>
						<x-metronic::f-input
							:label="'Username'"
							:name="'username'"
							:attrs="'for=pasien'"
						/>
						<div class="">
							<label class="col-form-label fw-semibold fs-6">
								<span class="required">Password</span>
							</label>
							<div class=" fv-row fv-plugins-icon-container input-group">
								<input name="password" class="form-control" type="password"
									placeholder="password"
									value="">
								<button type="button" class="btn btn-primary bt-def-passwd"
									title="set default password">
									Set
								</button>
							</div>
						</div>
						<x-metronic::f-input
							:label="'Re Password'"
							:name="'repassword'"
							type="password"
						/>
					</div>
				</div>
				
				<div class="d-flex flex-stack pt-10">
					<!--begin::Wrapper-->
					<div class="me-2">
						
					</div>
					<!--end::Wrapper-->
					<!--begin::Wrapper-->
					<div>
						{{ $mfooter ?? "" }}
						<button id="btSendCred" type="button" 
							class="btn btn-lg btn-success">
							Kirim kredensial
						</button>
						<!-- <button id="btSubmitMember" type="button" class="btn btn-lg btn-primary" data-kt-stepper-action="submit"> -->
						<input id="btSubmitMember" type="submit" 
							class="btn btn-lg btn-primary" 
							data-kt-stepper-action="submit">
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Actions-->
			</form>
			<!--end::Form-->
		</div>
		<!--end::Content-->
	</div>
	<!--end::Stepper-->
</x-metronic::modal>
<script src="{{ $_asset.'assets/js/appdatatable.js' }}"></script>
<script src="{{ $_asset.'assets/js/m.js' }}"></script>
<?php

$dturl = route("admin.users.datatable");

if(!$isSuperadmin){
	$dturl = route("admin.member.datatable");
}

?>
<script>
var routes = {
	create:'{{ route("admin.users.store") }}',
	read:'{{ route("admin.users.show",["id"=>"idx"]) }}',
	update:'{{ route("admin.users.update",["id"=>"idx"]) }}',
	delete: '{{ route("admin.users.destroy",["id"=>"idx"]) }}',
	datatable: '{{ $dturl }}',
	member: {
		create: '{{ route("admin.member.store") }}',
		read: '{{ route("admin.member.show",["id"=>"idx"]) }}',
		update: '{{ route("admin.member.update",["id"=>"idx"]) }}',
		delete: '{{ route("admin.member.destroy",["id"=>"idx"]) }}',
	},
	importMember: "{{route('admin.users.import')}}"
}

let gl = {
	hasInitCRUD: false,
}

async function import1(data){
	return await ajaxer.post(routes.importMember, data)
}

var dt = dtBase
.build("#datatable", routes.datatable, [
	AppDatatable.util.colNumbering('id','id'),
	AppDatatable.cols.basicFormat("id", "id"),
	AppDatatable.cols.basicFormat("name", "name"),
	AppDatatable.cols.basicFormat("username", "username"),
	AppDatatable.cols.basicFormat("created_at", "created_at"),
	{
		data: "id",
		render: function(data){
			return `<button class="btn btn-sm btn-success bt-edit-member"
				data-bs-toggle="modal" data-bs-target="#mModal" data-id="${data}"
				data-ctx="member">
				Member
			</button>`
		}
	}
])

dt.on('draw', function(){
	$(".bt-edit-member").click(async function(){
		let id = $(this).attr("data-id")
		let res = await memberCRUD.getSingle(id)

		memberCRUD.setupForm(res.data)
	})
	setup()
})

const emptyData = {
	id: "",
	name: "",
	username: "",
	email: "",
	created_at: "",
	oauth_client: {
		id: "",
		secret: "",
	},
}

var form = {
	main: {
		set(data){
			let f = "#form"
			$(`${f} input[name=name]`).val(data.name)
			$(`${f} input[name=id]`).val(data.id)
			$(`${f} input[name=username]`).val(data.username)
			$(`${f} input[name=email]`).val(data.email)
			$(`${f} input[name=password]`).val(data.password)
			$(`${f} input[name=repassword]`).val(data.repassword)
			$(`${f} select[name=role]`).val(data.role)

			let prof = data.profile
			if(prof){
				$(`${f} input[name=phone]`).val(prof.phone)
				$(`${f} input[name=address]`).val(prof.address)
				$(`${f} input[name=dob]`).val(prof.birth_at)
			}
			
			$(`${f} input[name=created_at]`).val(data.created_at)
		},
		reset(){
			form.main.set({})
		}
	}
}

let mc
let memberCRUD
let docCRUD

let $idob = $('input[name=dob]')
let $iage = $('input[name=age]')
let $bsa = $('input[name=bsa]')
let $bmi = $('input[name=bmi]')
let $iwe = $('input[name=weight]')
let $ihe = $('input[name=height]')
let $fmImport = $('#fmImport')
let $ifile = $('input[name=ifile]')

let $btDefPasswd = $(".bt-def-passwd")

function calcBMI(heightInCm, weightInKg){
	// weightInKg / (heightInCm/100)**2
	heightInCm = parseFloat(heightInCm)
	weightInKg = parseFloat(weightInKg)

	let bmi = weightInKg / (heightInCm/100)**2;
	return bmi.toFixed(2);
}

function calcBSA(heightInCm, weightInKg){
	heightInCm = parseFloat(heightInCm)
	weightInKg = parseFloat(weightInKg)

	let bsa = Math.sqrt((heightInCm * weightInKg) / 3600);
	return bsa.toFixed(2);
}

function fnOcBSA(){
	let bsa = calcBSA(
		$ihe.val(), $iwe.val()
	)
	$bsa.val(bsa)
	$bmi.val(calcBMI($ihe.val(), $iwe.val()))
}

function d1(){
	$('input[name=name]').val("John doe")
	$('input[name=address]').val("Jl Kaliurang Malang")
	$('input[name=phone]').val("081222333444")
	$('input[name=weight]').val("65")
	$('input[name=height]').val("175")
	$('input[name=dob]').val("1995-01-01")
	$('input[name=age]').val("")
	$('input[name=bsa]').val("")
	$('input[name=email]').val("john@gmail.com")
	$('input[name=username]').val("john1")
	$('input[name=password]').val("password")

	// 'is_active'
	// 'role'
}

function setup(){
	if(gl.hasInitCRUD){
		// return
	}
	mc = initCRUD()
	memberCRUD = (new CRUD())
		.setCtx("member")
		.setFormHandler({
			main: {
				set(data){
					this.reset()
					
					let fm = "#fmMember"
					$(`${fm} input[name=name]`).val(data.name)
					$(`${fm} input[name=id]`).val(data.id)
					$(`${fm} input[name=username]`).val(data.username)
					$(`${fm} input[name=email]`).val(data.email)
					$(`${fm} input[name=password]`).val(data.password)
					$(`${fm} input[name=repassword]`).val(data.repassword)
					// $(`${fm} input[name=role]`).val(data.role)
					
					let prof = data.profile
					if(prof){
						$(`${fm} input[name=phone]`).val(prof.phone)
						$(`${fm} input[name=address]`).val(prof.address)
						$(`${fm} input[name=weight]`).val(prof.weight)
						$(`${fm} input[name=height]`).val(prof.height)
						$(`${fm} input[name=bsa]`).val(prof.bsa)
						$(`${fm} input[name=bmi]`).val(prof.bmi)
						$(`${fm} input[name=age]`).val(prof.age)
						$(`${fm} input[name=dob]`).val(prof.birth_at)
					}
					
					$("input[name=created_at]").val(data.created_at)
				},
				reset(){
					let fm = "#fmMember"
					form.main.set({profile:{}})
					$(`${fm} input[name=phone]`).val(null)
					$(`${fm} input[name=address]`).val(null)
					$(`${fm} input[name=weight]`).val(null)
					$(`${fm} input[name=height]`).val(null)
					$(`${fm} input[name=bsa]`).val(null)
					$(`${fm} input[name=bmi]`).val(null)
					$(`${fm} input[name=age]`).val(null)
					$(`${fm} input[name=dob]`).val(null)
				}
			}
		})
		.setForm("#fmMember")
	memberCRUD = initCRUD(memberCRUD)
	memberCRUD.setRoute(routes.member)
		.setModal("#mModal")
	
	gl.hasInitCRUD = true
}


function getTimename(t){
	if(t >= 18){
		return "Malam"
	}else if(t >= 15){
		return "Sore"
	}else if(t >= 11){
		return "Siang"
	}else if(t > 0){
		return "Pagi"
	}
}

function changePhonePrefix(phonenum, to = "62") {
    let ret = phonenum;
    let id = phonenum.indexOf(to);

    if (id === 0) {
        return phonenum;
    }

    let correctPrefix = phonenum.indexOf("08") === 0;

    if (!correctPrefix) {
        throw new Error("Phone does not begin with 08");
    }

    let offset = 1;
    let subst = phonenum.substring(offset);

    ret = to + subst;
    return ret;
}

$(document).ready(function(){
	$idob.change(function(){
		let m1 = moment()
		let age = m1.diff($(this).val(), "years")
		$iage.val(age)
	})
	$iwe.change(fnOcBSA)
	$ihe.change(fnOcBSA)

	$("#btAddMember").click(function(){
		memberCRUD.resetForm()
	})

	$btDefPasswd.click(function(e){
		e.preventDefault()
		let p = "password"
		cl(p)
		$("input[name=password]").val(p)
		$("input[name=repassword]").val(p)
	})

	$fmImport.submit(async function(e){
		e.preventDefault()
		let fd = new FormData()

		if ($ifile[0].files.length <= 0) {
			alert("Pilih file dulu")
			return 
		}

		fd.append("file", $ifile[0].files[0])
		let res = await import1(fd);

		if(res.success){
			$("#modal-import").modal("hide")
			alert(res.message)
			dt.ajax.reload()
		}else{
			alert(res.message)
		}
	})

	$("#btSendCred").click(function(){
		let nama = $("input[name=name][for=pasien]").val()
		let email = $("input[name=email][for=pasien]").val()
		let username = $("input[name=username][for=pasien]").val()
		let phone = $("input[name=phone][for=pasien]").val()

		// username: 
		let d = new Date()
		let timeName = getTimename(d.getHours())

		let msg = `Selamat ${timeName}
Terima kasih sudah menunggu, berikut adalah informasi login aplikasi Guonco-Connect anda:\n
	\n
Username: ${email}\n
Password: password\n
\n
Jika belum memiliki aplikasi, berikut adalah link untuk unduh aplikasi pasien di https://app.guonco-connect.com\n
\n
Atas perhatiannya kami ucapkan terima kasih\n
[Team GUOnco-Connect]`
		let msg1 = new Msg()
		msg1.setUsername(email)
			.setEmail(email)
			.setLongname(nama)
			.setPasswd("password")
		
		phone = changePhonePrefix(phone)
		msg = msg.replace(/\n/g, "%0A")
		// msg = msg1.build()
		window.open(`https://wa.me/+${phone}?text=${msg}`)
	})
})
</script>
@endsection