<!DOCTYPE html>

<html lang="en">
<!--begin::Head-->
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>Stata16 | Dashboard</title>
    <meta name="description" content="Updates and statistics"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>        <!--end::Fonts-->

    <!--begin::Page Vendors Styles(used by this page)-->
    <!--<link href="/mtrn/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>-->
    <!--end::Page Vendors Styles-->


    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="/mtrn/assets/plugins/global/plugins.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/mtrn/assets/plugins/custom/prismjs/prismjs.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link href="/mtrn/assets/css/style.bundle.css?v=7.0.6" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('/vendor/sweetalert2/js/sweetalert2.min.css') }}"/>

    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="/mtrn/assets/media/logos/favicon.ico"/>

    <style>
        *:focus {
            outline: none;
        }
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #00977B !important;
        }
        .select2-container--default.select2-container--open .select2-selection--multiple {
            border-color: #00977B !important;
        }
        .form-control:focus {
            border-color: #00977B !important;
        }
        .result {
            background-color: #18171B;
            color: #FF8400;
            line-height: 1.2em;
            font: 12px Menlo, Monaco, Consolas, monospace;
            word-wrap: break-word;
            white-space: pre-wrap;
            position: relative;
            /*z-index: 99999;*/
            word-break: break-all;
            font-weight: bold;
            color: #56DB3A;
            width: 100%;
            border-radius: 10px;
            padding: 14px;
        }

    </style>
</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body" class="quick-panel-right demo-panel-right offcanvas-right header-fixed header-mobile-fixed aside-enabled aside-static page-loading">

<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">


        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper1" id="kt_wrapper">
            <!--begin::Content-->
            <div class="content  d-flex flex-column flex-column-fluid" id="kt_content">

                <!--begin::Entry-->
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class=" container ">
                        <!--begin::Nav Content-->
                        <div class="row">
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#tab_forms_widget_1">
                                            <span class="nav-icon">
                                                <i class="flaticon2-chat-1"></i>
                                            </span>
                                            <span class="nav-text">스마트통합 패널데이터 생성</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#tab_forms_widget_2" aria-controls="profile">
                                            <span class="nav-icon">
                                                <i class="flaticon2-layers-1"></i>
                                            </span>
                                            <span class="nav-text">스마트 검색</span>
                                        </a>
                                    </li>
                                    {{--
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
																	<span class="nav-icon">
																		<i class="flaticon2-rocket-1"></i>
																	</span>
                                            <span class="nav-text">Dropdown</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right" style="">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Separated link</a>
                                        </div>
                                    </li>
                                    --}}
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab" data-toggle="tab" href="#tab_forms_widget_3" aria-controls="contact">
                                            <span class="nav-icon">
                                                <i class="flaticon2-rocket-1"></i>
                                            </span>
                                            <span class="nav-text">스마트 변수 추가</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-12">
                                @if ($errors->any())
                                <div class="alert alert-custom alert-outline-warning  fade show mt-8 mx-8" role="alert">
                                    <div class="alert-icon"><i class="flaticon-warning"></i></div>
                                    <div class="alert-text">
                                            @foreach ($errors->all() as $error)
                                                <div class="alert-text">{{$error }}</div>
                                            @endforeach
                                    </div>
                                    <div class="alert-close">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true"><i class="ki ki-close"></i></span>
                                        </button>
                                    </div>
                                </div>
                                @endif

                                <form id="frm_klips" method="post" action="/stata/storeKlips">
                                    @csrf
                                    <div class="card1 card-custom bg-white gutter-b" >

                                        <div class="card-body pt-3">
                                            @include('stata.partials.smartcommon')
                                            <div class="tab-content m-0 p-0">
                                                <div class="tab-pane  active" id="tab_forms_widget_1" role="tabpanel">
                                                    @include('stata.partials.smartklips')
                                                </div>

                                                <div class="tab-pane" id="tab_forms_widget_2" role="tabpanel">
                                                    @include('stata.partials.smartsearch')
                                                </div>

                                                <div class="tab-pane " id="tab_forms_widget_3" role="tabpanel">
                                                    @include('stata.partials.smartadd')
                                                </div>
                                            </div>
                                            {{--@include('stata.partials.smartcommon')--}}
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col text-left">
                                                    <button type="submit" class="btn btn-danger">제출</button>
                                                    <button type="button" id="cancel" class="btn btn-secondary">리셋</button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </form>
                            </div>

                            {{--우측 result--}}
                            {{--
                            <div class="col-md-6">
                                <!--begin::List Widget 2-->

                                <div class="card card-custom bg-gray-100 gutter-b card-stretch card-shadowless">
                                    <!--begin::Header-->
                                    <div class="card-header border-0">
                                        <h3 class="card-title font-weight-bolder text-success">Result</h3>
                                        <div class="card-toolbar">
                                            <div class="dropdown dropdown-inline">
                                                <a href="#" class="btn btn-clean btn-hover-success btn-sm btn-icon" data-toggle="dropdown" aria-haspopup="true"
                                                   aria-expanded="false">
                                                    <i class="ki ki-bold-more-ver text-success"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right">
                                                    <!--begin::Naviigation-->
                                                    <ul class="navi">
                                                        <li class="navi-header font-weight-bold py-5">
                                                            <span class="font-size-lg">Add New:</span>
                                                            <i class="flaticon2-information icon-md text-muted" data-toggle="tooltip" data-placement="right"
                                                               title="Click to learn more..."></i>
                                                        </li>
                                                        <li class="navi-separator mb-3 opacity-70"></li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon"><i class="flaticon2-shopping-cart-1"></i></span>
                                                                <span class="navi-text">Order</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon"><i class="navi-icon flaticon2-calendar-8"></i></span>
                                                                <span class="navi-text">Members</span>
                                                                <span class="navi-label">
                    <span class="label label-light-danger label-rounded font-weight-bold">3</span>
                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon"><i class="navi-icon flaticon2-telegram-logo"></i></span>
                                                                <span class="navi-text">Project</span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-item">
                                                            <a href="#" class="navi-link">
                                                                <span class="navi-icon"><i class="navi-icon flaticon2-new-email"></i></span>
                                                                <span class="navi-text">Record</span>
                                                                <span class="navi-label">
                    <span class="label label-light-success label-rounded font-weight-bold">5</span>
                </span>
                                                            </a>
                                                        </li>
                                                        <li class="navi-separator mt-3 opacity-70"></li>
                                                        <li class="navi-footer pt-5 pb-4">
                                                            <a class="btn btn-light-primary font-weight-bolder btn-sm" href="#">More options</a>
                                                            <a class="btn btn-clean font-weight-bold btn-sm d-none" href="#" data-toggle="tooltip" data-placement="right"
                                                               title="Click to learn more...">Learn more</a>
                                                        </li>
                                                    </ul>
                                                    <!--end::Naviigation-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Header-->

                                    <!--begin::Body-->
                                    <div class="card-body pt-2">
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center mb-10">
                                            <div class="result">
                                                --}}{{--@dump($fileread)--}}{{--
                                                {!!  $fileread??''  !!}
                                            </div>
                                        </div>
                                        <!--end::Item-->

                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::List Widget 2-->
                            </div>
                            --}}
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->

<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
	<span class="svg-icon"><!--begin::Svg Icon | path:/mtrn/assets/media/svg/icons/Navigation/Up-2.svg--><svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px"
                                                                                                              viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
        <path
            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span></div>
<!--end::Scrolltop-->


<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1200
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#6993FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#F3F6F9",
                    "dark": "#212121"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1E9FF",
                    "secondary": "#ECF0F3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#212121",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#ECF0F3",
                "gray-300": "#E5EAEE",
                "gray-400": "#D6D6E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#80808F",
                "gray-700": "#464E5F",
                "gray-800": "#1B283F",
                "gray-900": "#212121"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->

<!--begin::Global Theme Bundle(used by all pages)-->
<script src="/mtrn/assets/plugins/global/plugins.bundle.js?v=7.0.6"></script>
<script src="/mtrn/assets/plugins/custom/prismjs/prismjs.bundle.js?v=7.0.6"></script>
<script src="/mtrn/assets/js/scripts.bundle.js?v=7.0.6"></script>
<!--end::Global Theme Bundle-->

<!--begin::Page Vendors(used by this page)-->
<!--end::Page Vendors-->

<!--begin::Page Scripts(used by this page)-->
<script src="/mtrn/assets/js/pages/widgets.js?v=7.0.6"></script>
<script src="{{ asset('/js/vendor/sweetalert2/js/sweetalert2.min.js') }}"></script>
<script>
    // Class definition
    var KTSelect2 = function () {
        // Private functions
        var demos = function () {

            // multi select
            $('#kt_select2_3').select2({
                placeholder: "가구 레벨 변수를 선택하세요",
            });
            $('#kt_select2_4').select2({
                placeholder: "가구원 레벨 변수를 선택하세요",
            });
            $('#kt_select2_5').select2({
                placeholder: "차수를 선택하세요",
            });


            // disabled results
            $('.kt-select2-general').select2({
                placeholder: "Select an option"
            });
        }

        // Public functions
        return {
            init: function () {
                demos();
            }
        };
    }();

    // Initialization
    jQuery(document).ready(function () {
        var $selects = $('select');
        if ($selects.length > 0) {
            for (var i = 0; i < $selects.length; i++) {
                $($selects[i]).parents('.form-group').attr('tabindex', '0');
            }
        }

        @if($isSuccess)
        Swal.fire({
            title: '파일을 다운 받으시겠습니까?',
            text: 'klips_final.dta가 생성되었습니다.',
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '다운받기',
            cancelButtonText: '창 닫기'
        }).then((result) => {
            if (result.isConfirmed) {
                window.open("/klips/klips_final.dta", "_blank");
            }
        })
        @endif
        KTSelect2.init();
        $("#cancel").click(function () {
            $("#kt_select2_3").val('').trigger('change');
            $("#kt_select2_4").val('').trigger('change');
            $("#kt_select2_5").val('').trigger('change');
            $('.result').html('');
        })


        $("#kt_select2_3").val({!! json_encode(old('kt_select2_3'))  !!}).trigger('change');
        $("#kt_select2_4").val({!! json_encode(old('kt_select2_4'))  !!}).trigger('change');
        $("#kt_select2_5").val({!! json_encode(old('kt_select2_5'))  !!}).trigger('change');
        ///$("#kt_select2_5").val(["01","15", "16", "21"]).trigger('change');

    });
</script>
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
