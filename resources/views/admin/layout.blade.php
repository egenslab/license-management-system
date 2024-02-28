<!DOCTYPE html>
<html lang="en">
   <!--begin::Head-->
   <head>
      <base href="">
      <title>Eg Notifications License Key Management</title>
      <meta name="viewport" content="width=device-width, initial-scale=1" />
      <meta charset="utf-8" />
      <!--begin::Fonts-->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
      <link href="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
      <link href="{{asset('assets/css/custom.css')}}" rel="stylesheet" type="text/css" />
      <!--end::Global Stylesheets Bundle-->
   </head>
   <!--end::Head-->

   <!--begin::Body-->
   <body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
      <!--begin::Main-->
      <!--begin::Root-->
      <div class="sidebar-icon"></div>
      <div class="d-flex flex-column flex-root">
         <!--begin::Page-->
         <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside aside-light aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
               <!--begin::Aside menu-->
               <div class="aside-menu flex-column-fluid">
                  <!--begin::Aside Menu-->
                  <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                     <!--begin::Menu-->
                     <div class="menu side-menu-custom menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                        <div class="menu-item mt-4"><div class="menu-content pb-2"><span class="menu-section text-muted text-uppercase fs-8  ls-1">Modules</span></div></div>
                        <div class="menu-item"><a class="menu-link" href="{{url("/admin/dashboard")}}"><span class="menu-title">Dashboard </span></a></div>
                        <div class="menu-item"><a class="menu-link" href="{{url("/admin/license")}}"><span class="menu-title">License </span></a></div>
                        {{-- <div class="menu-item"><a class="menu-link" href="{{url("/admin/users")}}"><span class="menu-title">Users</span></a></div> --}}
                        <div class="menu-item"><a class="menu-link" href="{{url("product")}}"><span class="menu-title">Product</span></a></div>
                        {{-- <div class="menu-item"><a class="menu-link" href="{{url("/admin/verify")}}"><span class="menu-title">Purchanse Verify</span></a></div> --}}
                        <div class="menu-item"><a class="menu-link" href="{{route("purchase.code.list")}}"><span class="menu-title">Purchanse Code List </span></a></div>
                     </div>
                     <!--end::Menu-->
                  </div>
                  <!--end::Aside Menu-->
               </div>
               <!--end::Aside menu-->

               <!--begin::Footer-->
               <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
                  <a href="{{url('admin/profile')}}" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" title="200+ in-house components and 3rd-party plugins">
                     <span class="btn-label">Help &amp; Support</span>
                     <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
                     <span class="svg-icon btn-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM15 17C15 16.4 14.6 16 14 16H8C7.4 16 7 16.4 7 17C7 17.6 7.4 18 8 18H14C14.6 18 15 17.6 15 17ZM17 12C17 11.4 16.6 11 16 11H8C7.4 11 7 11.4 7 12C7 12.6 7.4 13 8 13H16C16.6 13 17 12.6 17 12ZM17 7C17 6.4 16.6 6 16 6H8C7.4 6 7 6.4 7 7C7 7.6 7.4 8 8 8H16C16.6 8 17 7.6 17 7Z" fill="black" />
                           <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="black" />
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </a>
               </div>
               <!--end::Footer-->
            </div>
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
               <!--begin::Header-->
               <div id="kt_header"  class="header align-items-stretch">
                  <!--begin::Container-->
                  <div style=" width: 400px; align-items: center; padding: 15px 24px;">
                     <a href="{{url('admin/dashboard')}}">
                     <img alt="Logo" src="{{asset('assets/media/logos/logoegnslab.png')}}" class="h-25px logo">
                     </a>
                  </div>
                  <div class="container-fluid d-flex align-items-stretch justify-content-between">
                     <!--begin::Aside mobile toggle-->

                     <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="Show aside menu">
                        <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                           <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                           <span class="svg-icon svg-icon-2x mt-1">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                 <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                 <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                              </svg>
                           </span>
                           <!--end::Svg Icon-->
                        </div>
                     </div>
                     <!--end::Aside mobile toggle-->

                     <!--begin::Wrapper-->
                     <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                        <!--begin::Navbar-->
                        <div class="d-flex align-items-stretch" id="kt_header_nav">
                        </div>
                        <!--end::Navbar-->
                        <!--begin::Topbar-->
                        <div class="d-flex align-items-stretch flex-shrink-0">
                           <!--begin::Toolbar wrapper-->
                           <div class="d-flex align-items-stretch flex-shrink-0">
                              <!--begin::Quick links-->
                              <div class="d-flex align-items-center ms-1 ms-lg-3">
                                 <!--begin::Menu wrapper-->
                                 <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                    <span class="svg-icon svg-icon-1">
                                       <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                          <rect x="2" y="2" width="9" height="9" rx="2" fill="black" />
                                          <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="black" />
                                          <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="black" />
                                          <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="black" />
                                       </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                 </div>
                                 <!--begin::Menu-->
                                 <div class="menu menu-sub menu-sub-dropdown menu-column w-250px w-lg-325px" data-kt-menu="true">
                                    <!--begin::Heading-->
                                    <div class="d-flex flex-column flex-center bgi-no-repeat rounded-top px-9 py-10" style="background-image:url('{{asset('assets/media/misc/pattern-1.jpg')}}')">
                                       <!--begin::Title-->
                                       <h3 class="text-white fw-bold mb-3">Quick Links</h3>
                                    </div>
                                    <!--end::Heading-->

                                    <!--begin:Nav-->
                                    <div class="row g-0">
                                       <!--begin:Item-->
                                       <div class="col-6">
                                          <a href="../../demo1/dist/pages/projects/budget.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-end border-bottom">
                                             <!--begin::Svg Icon | path: icons/duotune/finance/fin009.svg-->
                                             <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                   <path opacity="0.3" d="M20 15H4C2.9 15 2 14.1 2 13V7C2 6.4 2.4 6 3 6H21C21.6 6 22 6.4 22 7V13C22 14.1 21.1 15 20 15ZM13 12H11C10.5 12 10 12.4 10 13V16C10 16.5 10.4 17 11 17H13C13.6 17 14 16.6 14 16V13C14 12.4 13.6 12 13 12Z" fill="black" />
                                                   <path d="M14 6V5H10V6H8V5C8 3.9 8.9 3 10 3H14C15.1 3 16 3.9 16 5V6H14ZM20 15H14V16C14 16.6 13.5 17 13 17H11C10.5 17 10 16.6 10 16V15H4C3.6 15 3.3 14.9 3 14.7V18C3 19.1 3.9 20 5 20H19C20.1 20 21 19.1 21 18V14.7C20.7 14.9 20.4 15 20 15Z" fill="black" />
                                                </svg>
                                             </span>
                                             <!--end::Svg Icon-->
                                             <span class="fs-5 fw-bold text-gray-800 mb-0">Users</span>
                                             <span class="fs-7 text-gray-400">Eg Notifications</span>
                                          </a>
                                       </div>
                                       <!--end:Item-->
                                       <!--begin:Item-->
                                       <div class="col-6">
                                          <a href="../../demo1/dist/pages/projects/settings.html" class="d-flex flex-column flex-center h-100 p-6 bg-hover-light border-bottom">
                                             <!--begin::Svg Icon | path: icons/duotune/communication/com010.svg-->
                                             <span class="svg-icon svg-icon-3x svg-icon-primary mb-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                   <path d="M6 8.725C6 8.125 6.4 7.725 7 7.725H14L18 11.725V12.925L22 9.725L12.6 2.225C12.2 1.925 11.7 1.925 11.4 2.225L2 9.725L6 12.925V8.725Z" fill="black" />
                                                   <path opacity="0.3" d="M22 9.72498V20.725C22 21.325 21.6 21.725 21 21.725H3C2.4 21.725 2 21.325 2 20.725V9.72498L11.4 17.225C11.8 17.525 12.3 17.525 12.6 17.225L22 9.72498ZM15 11.725H18L14 7.72498V10.725C14 11.325 14.4 11.725 15 11.725Z" fill="black" />
                                                </svg>
                                             </span>
                                             <!--end::Svg Icon-->
                                             <span class="fs-5 fw-bold text-gray-800 mb-0">License List</span>
                                             <span class="fs-7 text-gray-400">Eg Notifications</span>
                                          </a>
                                       </div>
                                       <!--end:Item-->
                                    </div>

                                    <!--end:Nav-->
                                    <!--begin::View more-->
                                    <div class="py-2 text-center border-top">
                                       <a href="{{url('admin/dashboard')}}" class="btn btn-color-gray-600 btn-active-color-primary">
                                          View All
                                          <!--begin::Svg Icon | path: icons/duotune/arrows/arr064.svg-->
                                          <span class="svg-icon svg-icon-5">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="18" y="13" width="13" height="2" rx="1" transform="rotate(-180 18 13)" fill="black" />
                                                <path d="M15.4343 12.5657L11.25 16.75C10.8358 17.1642 10.8358 17.8358 11.25 18.25C11.6642 18.6642 12.3358 18.6642 12.75 18.25L18.2929 12.7071C18.6834 12.3166 18.6834 11.6834 18.2929 11.2929L12.75 5.75C12.3358 5.33579 11.6642 5.33579 11.25 5.75C10.8358 6.16421 10.8358 6.83579 11.25 7.25L15.4343 11.4343C15.7467 11.7467 15.7467 12.2533 15.4343 12.5657Z" fill="black" />
                                             </svg>
                                          </span>
                                          <!--end::Svg Icon-->
                                       </a>
                                    </div>
                                    <!--end::View more-->
                                 </div>
                                 <!--end::Menu-->
                                 <!--end::Menu wrapper-->
                              </div>

                              <!--end::Quick links-->
                              <!--begin::User-->
                              <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                 <!--begin::Menu wrapper-->
                                 <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                    <img src="{{asset('assets/media/avatars/150-26.jpg')}}" alt="user" />
                                 </div>
                                 <!--begin::Menu-->
                                 <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                       <div class="menu-content d-flex align-items-center px-3">
                                          <!--begin::Avatar-->
                                          <div class="symbol symbol-50px me-5">
                                             <img alt="Logo" src="{{asset('assets/media/avatars/150-26.jpg')}}" />
                                          </div>
                                          <!--end::Avatar-->
                                          <!--begin::Username-->
                                          <div class="d-flex flex-column">
                                             <div class="fw-bolder d-flex align-items-center fs-5">Max Smith
                                                <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                             </div>
                                             <a href="#" class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
                                          </div>
                                          <!--end::Username-->
                                       </div>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator my-2"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                       <a href="{{url('admin/profile')}}" class="menu-link px-5">My Profile</a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                       <a href="{{url('admin/logout')}}" class="menu-link px-5">Sign Out</a>
                                    </div>
                                    <!--end::Menu item-->

                                 </div>
                                 <!--end::Menu-->
                                 <!--end::Menu wrapper-->
                              </div>
                              <!--end::User -->
                           </div>
                           <!--end::Toolbar wrapper-->
                        </div>
                        <!--end::Topbar-->
                     </div>
                     <!--end::Wrapper-->
                  </div>
                  <!--end::Container-->
               </div>
               <!--end::Header-->
               <!--begin::Content-->
               	@section('container')
      			@show
               <!--end::Content-->
               <!--begin::Footer-->
               <div class="footer py-4 d-flex flex-lg-column" id="kt_footer" style="bottom: 0;position: fixed;width: 100%;">
                  <!--begin::Container-->
                  <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                     <!--begin::Copyright-->
                     <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">2021©</span>
                        <a href="https://www.egenslab.com" target="_blank" class="text-gray-800 text-hover-primary">Egens Lab</a>
                     </div>
                     <!--end::Copyright-->
                  </div>
                  <!--end::Container-->
               </div>
               <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
         </div>
         <!--end::Page-->
      </div>

      <!--end::Main-->
      <script>var hostUrl = "assets/";</script>
      <!--begin::Javascript-->
      <!--begin::Global Javascript Bundle(used by all pages)-->
      <script src="{{asset('assets/plugins/global/plugins.bundle.js')}}"></script>
      <script src="{{asset('assets/js/scripts.bundle.js')}}"></script>
      <!--end::Global Javascript Bundle-->
      <!--begin::Page Vendors Javascript(used by this page)-->
      <script src="{{asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
      <!--end::Page Vendors Javascript-->
      <!--begin::Page Custom Javascript(used by this page)-->
      <script src="{{asset('assets/js/custom/widgets.js')}}"></script>
      <script src="{{asset('assets/js/custom/apps/chat/chat.js')}}"></script>
      <script src="{{asset('assets/js/custom/modals/create-app.js')}}"></script>
      <script src="{{asset('assets/js/custom/modals/upgrade-plan.js')}}"></script>
      <!--end::Page Custom Javascript-->
      <!--end::Javascript-->
   </body>
   <!--end::Body-->
</html>
