<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="">

		<title>Metronic - the world's #1 selling Bootstrap Admin Theme Ecosystem for HTML, Vue, React, Angular &amp; Laravel by Keenthemes</title>	
		<meta name="viewport" content="width=device-width, initial-scale=1" />	
		<meta charset="utf-8" />			
		<link rel="shortcut icon" href="{{asset('assets/media/logos/favicon.ico')}}" />
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />	
		<link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />

	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Authentication - Signup Free Trial-->
			<div class="d-flex flex-column flex-xl-row flex-column-fluid">
				<!--begin::Aside-->
				<div class="d-flex flex-column flex-lg-row-fluid">
					<!--begin::Wrapper-->
					<div class="d-flex flex-row-fluid flex-center p-10">
						<!--begin::Content-->
						<div class="d-flex flex-column">
							<!--begin::Logo-->
							<a href="../../demo1/dist/index.html" class="mb-15">
								<img alt="Logo" src="{{asset('assets/media/logos/logoegnslab.png')}}" class="h-40px" />
							</a>
							<!--end::Logo-->
							<!--begin::Title-->
							<h1 class="text-dark fs-2x mb-3">Welcome, Eg Notifications License Management System!</h1>
							<!--end::Title-->
							<!--begin::Description-->
							<div class="fw-bold fs-4 text-gray-400 mb-10">Plan your blog post by choosing a topic creating
							<br />an outline and checking facts</div>
							<!--begin::Description-->
						</div>
						<!--end::Content-->
					</div>
					<!--end::Wrapper-->
					<!--begin::Illustration-->
					<div class="d-flex flex-row-auto bgi-no-repeat bgi-position-x-center bgi-size-contain bgi-position-y-bottom min-h-200px min-h-xl-450px mb-xl-10" style="background-image: url({{asset('assets/media/illustrations/sketchy-1/8.png')}})"></div>
					<!--end::Illustration-->
				</div>
				<!--begin::Aside-->
				<!--begin::Content-->
				<div class="flex-row-fluid d-flex flex-center justfiy-content-xl-first p-10">
					<!--begin::Wrapper-->
					<div class="d-flex flex-center p-10 py-15 shadow-login bg-body rounded w-100 w-md-550px mx-auto ms-xl-20">
						<!--begin::Form-->
                        
						<form class="form w-100" action= "{{route('admin.auth')}}" method="POST" novalidate="novalidate" id="kt_free_trial_form">
                            <!--begin::Alert-->
                            @if(Session::has('error'))
                            <div class="alert alert-danger d-flex align-items-center p-5 mb-10">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen048.svg-->
                                <span class="svg-icon svg-icon-2hx svg-icon-danger me-4">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M20.5543 4.37824L12.1798 2.02473C12.0626 1.99176 11.9376 1.99176 11.8203 2.02473L3.44572 4.37824C3.18118 4.45258 3 4.6807 3 4.93945V13.569C3 14.6914 3.48509 15.8404 4.4417 16.984C5.17231 17.8575 6.18314 18.7345 7.446 19.5909C9.56752 21.0295 11.6566 21.912 11.7445 21.9488C11.8258 21.9829 11.9129 22 12.0001 22C12.0872 22 12.1744 21.983 12.2557 21.9488C12.3435 21.912 14.4326 21.0295 16.5541 19.5909C17.8169 18.7345 18.8277 17.8575 19.5584 16.984C20.515 15.8404 21 14.6914 21 13.569V4.93945C21 4.6807 20.8189 4.45258 20.5543 4.37824Z" fill="black"></path>
                                        <path d="M10.5606 11.3042L9.57283 10.3018C9.28174 10.0065 8.80522 10.0065 8.51412 10.3018C8.22897 10.5912 8.22897 11.0559 8.51412 11.3452L10.4182 13.2773C10.8099 13.6747 11.451 13.6747 11.8427 13.2773L15.4859 9.58051C15.771 9.29117 15.771 8.82648 15.4859 8.53714C15.1948 8.24176 14.7183 8.24176 14.4272 8.53714L11.7002 11.3042C11.3869 11.6221 10.874 11.6221 10.5606 11.3042Z" fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <div class="d-flex flex-column">
                                    <h4 class="mb-1 text-danger">Invalid Details</h4>
                                    <span>{{ Session::get('error') }}</span>
                                </div>
                            </div>
                            @endif
                            <!--end::Alert-->
							@csrf
							<div class="text-left mb-0">
								<!--begin::Title-->
								<h1 class="d-flex align-items-center text-dark fw-bolder my-1">Login to EG NLMS</h1>
								<!--end::Title-->
								<!--begin::Link-->
								<div class="text-gray-400 fw-bold fs-4">Login to Access your Business tools								
								<!--end::Link-->
							</div>
							<!--begin::Heading-->
							<!--begin::Input group-->
							<div class="fv-row mb-10 mt-4">
								<label class="form-label fw-bolder text-dark fs-6">Email</label>
								<input class="form-control " type="email" placeholder="" name="email" autocomplete="off" required />
							</div>
							<!--end::Input group-->
							<!--begin::Input group-->							
							<!--end::Input group=-->
							<!--begin::Row-->
							<div class="fv-row mb-10">
								<label class="form-label fw-bolder text-dark fs-6">Password</label>
								<input class="form-control " type="password" placeholder="" name="password" autocomplete="off" required />
							</div>
							<!--end::Row-->
							<!--begin::Row-->
							<div class="fv-row mb-10">
								<label class="form-check form-check-custom form-check-solid form-check-inline mb-5">									
									<a href="#" class="link-primary ms-1">Forget Password?</a>.</span>
								</label>
							</div>
							<!--end::Row-->
							<!--begin::Row-->
							<div class="text-center w-100">
								<button type="submit" name="submit" id="kt_free_trial_submit" class="btn w-100 btn-lg btn-primary fw-bolder">
									<span class="indicator-label">Login Account</span>
									<span class="indicator-progress">Please wait...
									<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
								</button>
							</div>
							<!--end::Row-->
						</form>
						<!--end::Form-->
					</div>
					<!--end::Wrapper-->
				</div>
				<!--end::Right Content-->
			</div>
			<!--end::Authentication - Signup Free Trial-->
		</div>
		<!--end::Main-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
		<script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
		<!--end::Global Javascript Bundle-->
		
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>