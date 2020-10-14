<!--begin::Row-->
<!--silver-->
<div class="row">
    <div class="col-xl-5">
        <div class="card card-custom bg-white gutter-b">
            <!--begin::Header-->
            <div class="card-header border-0 pt-5">
                <h3 class="card-title align-items-start flex-column">
                    <span class="card-label font-weight-bold font-size-h4 text-dark-75">Command</span>
                    <span class="text-muted mt-3 font-weight-bold font-size-sm">Last week <span
                            class="text-primary font-weight-bolder">9 execute</span></span>
                </h3>
                <div class="card-toolbar">
                    <ul class="nav nav-pills nav-pills-sm nav-dark">
                        <li class="nav-item ml-0">
                            <a class="nav-link py-2 px-4 font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_pane_1">Active Cases</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link py-2 px-4 active font-weight-bolder font-size-sm" data-toggle="tab" href="#kt_tab_pane_2">Create</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Body-->
            <div class="card-body pt-1">
                <div class="tab-content mt-5" id="myTabContent">
                    <!--begin::Tap pane-->
                    <div class="tab-pane fade" id="kt_tab_pane_1" role="tabpanel" aria-labelledby="kt_tab_pane_1">

                    </div>
                    <!--end::Tap pane-->

                    <!--begin::Tap pane-->
                    <div class="tab-pane fade show active" id="kt_tab_pane_2" role="tabpanel" aria-labelledby="kt_tab_pane_2">
                        <!--begin::Form-->
                        <form name="savefile" method="post" action="/stata/store">
                            @csrf

                            <div class="form-group mb-6">
                                <input type="text" class="form-control border-0 form-control-solid pl-6 min-h-50px font-size-lg font-weight-bolder"
                                       name="filename" placeholder="Do file Name" value="{{old('filename')}}" required>
                            </div>
                            <div class="form-group mb-6">
                                <input type="text" class="form-control border-0 form-control-solid pl-6 min-h-50px font-size-lg font-weight-bolder"
                                       name="imgname" placeholder="Write down the image used in the command window" value="{{old('imgname')}}">
                            </div>

                            <div class="form-group mb-6">
                                                        <textarea class="form-control border-0 form-control-solid pl-6 font-size-lg font-weight-bolder min-h-130px" name="textdata"
                                                                  rows="4" placeholder="Details" id="kt_forms_widget_7_input"
                                                                  style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 130px;">{{old('textdata')}}</textarea>
                            </div>
                            <div>
                                <button name="submitsave" class="btn btn-primary font-weight-bold">Send Report</button>
                            </div>
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Tap pane-->
                </div>
            </div>
            <!--end::Body-->
        </div>
    </div>
    <div class="col-xl-7">
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
                        {{--@dump($fileread)--}}
                        {!!  $fileread??''  !!}
                    </div>
                </div>
                <!--end::Item-->

            </div>
            <!--end::Body-->
        </div>
        <!--end::List Widget 2-->
    </div>
</div>
<div class="row">
    <div class="col-xl-12">
        <div class="mr-3">
            @if(old('imgname'))
                <img alt="Pic" src="/{{old('imgname')}}"/>
            @endif
        </div>
    </div>
</div>
<!--end::Row-->
