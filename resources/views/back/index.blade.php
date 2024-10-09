@extends('back.layouts.master')

@section('content')
<!--begin::Content wrapper-->
<div class="d-flex flex-column flex-column-fluid">

    <!--begin::Toolbar-->
    <div id="kt_app_toolbar" class="app-toolbar  pt-3 px-lg-3 ">

        <!--begin::Toolbar container-->
        <div id="kt_app_toolbar_container" class="app-container  container-fluid d-flex flex-stack flex-wrap ">
            <!--begin::Toolbar wrapper-->
            <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">


                <!--begin::Page title-->
                <div class="page-title d-flex align-items-center gap-1 me-3">
                    <!--begin::Title-->
                    <h1
                        class="page-heading d-flex flex-column justify-content-center text-gray-900 lh-1 fw-bolder fs-2x my-0 me-5">
                        Dashboard
                    </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold">

                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700 fw-bold lh-1">
                            <a href="index.html" class="text-gray-500 text-hover-primary">
                                <i class="ki-duotone ki-home fs-3 text-gray-500 mx-n1"></i>
                            </a>
                        </li>
                        <!--end::Item-->

                        <!--begin::Item-->
                        <li class="breadcrumb-item">
                            <i class="ki-duotone ki-right fs-4 text-gray-700 mx-n1"></i>
                        </li>
                        <!--end::Item-->


                        <!--begin::Item-->
                        <li class="breadcrumb-item text-gray-700">
                            Default </li>
                        <!--end::Item-->


                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3 flex-shrink-0">
                    <a href="#" class="btn btn-sm btn-success d-flex flex-center ms-3 px-4 py-3"
                        data-bs-toggle="modal" data-bs-target="#kt_modal_invite_friends">
                        <i class="ki-duotone ki-plus-square fs-2"><span class="path1"></span><span
                                class="path2"></span><span class="path3"></span></i>
                        <span>Invite</span>
                    </a>

                    <a href="#" class="btn btn-sm btn-primary ms-3 px-4 py-3" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_create_app">
                        Create <span class="d-none d-sm-inline">App</span>
                    </a>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar wrapper-->
        </div>
        <!--end::Toolbar container-->
    </div>
    <!--end::Toolbar-->

    <!--begin::Content-->
    <div id="kt_app_content" class="app-content  px-lg-3 ">


        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container  container-fluid ">
            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-6 mb-xl-10">

                    <!--begin::Table widget 2-->
                    <div class="card h-md-100">
                        <!--begin::Header-->
                        <div class="card-header align-items-center border-0">
                            <!--begin::Title-->
                            <h3 class="fw-bold text-gray-900 m-0">Recent Orders</h3>
                            <!--end::Title-->

                            <!--begin::Menu-->
                            <button
                                class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                data-kt-menu-overflow="true">

                                <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                        class="path2"></span><span class="path3"></span><span
                                        class="path4"></span></i>
                            </button>

                            <!--begin::Menu 2-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                        Quick Actions</div>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu separator-->
                                <div class="separator mb-3 opacity-75"></div>
                                <!--end::Menu separator-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        New Ticket
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        New Customer
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                    data-kt-menu-placement="right-start">
                                    <!--begin::Menu item-->
                                    <a href="#" class="menu-link px-3">
                                        <span class="menu-title">New Group</span>
                                        <span class="menu-arrow"></span>
                                    </a>
                                    <!--end::Menu item-->

                                    <!--begin::Menu sub-->
                                    <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                Admin Group
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                Staff Group
                                            </a>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <a href="#" class="menu-link px-3">
                                                Member Group
                                            </a>
                                        </div>
                                        <!--end::Menu item-->
                                    </div>
                                    <!--end::Menu sub-->
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        New Contact
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu separator-->
                                <div class="separator mt-3 opacity-75"></div>
                                <!--end::Menu separator-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <div class="menu-content px-3 py-3">
                                        <a class="btn btn-primary  btn-sm px-4" href="#">
                                            Generate Reports
                                        </a>
                                    </div>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu 2-->

                            <!--end::Menu-->
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-2">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills nav-pills-custom mb-3">
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden active w-80px h-85px py-4"
                                        data-bs-toggle="pill" href="#kt_stats_widget_2_tab_1">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                            <img alt="" src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/svg/products-categories/t-shirt.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                            T-shirt
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                                        data-bs-toggle="pill" href="#kt_stats_widget_2_tab_2">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                            <img alt="" src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/svg/products-categories/gaming.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-700 fw-bold fs-6 lh-1">
                                            Gaming
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                                        data-bs-toggle="pill" href="#kt_stats_widget_2_tab_3">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                            <img alt="" src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/svg/products-categories/watch.svg') }}"
                                                class="" />
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">
                                            Watch
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                                        data-bs-toggle="pill" href="#kt_stats_widget_2_tab_4">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                            <img alt="" src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/svg/products-categories/gloves.svg') }}"
                                                class="nav-icon" />
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">
                                            Gloves
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->

                                <!--begin::Item-->
                                <li class="nav-item mb-3">
                                    <!--begin::Link-->
                                    <a class="nav-link d-flex justify-content-between flex-column flex-center overflow-hidden w-80px h-85px py-4"
                                        data-bs-toggle="pill" href="#kt_stats_widget_2_tab_5">
                                        <!--begin::Icon-->
                                        <div class="nav-icon">
                                            <img alt="" src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/svg/products-categories/shoes.svg') }}"
                                                class="nav-icon" />
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Subtitle-->
                                        <span class="nav-text text-gray-600 fw-bold fs-6 lh-1">
                                            Shoes
                                        </span>
                                        <!--end::Subtitle-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                            </ul>
                            <!--end::Nav-->

                            <!--begin::Tab Content-->
                            <div class="tab-content">

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade show active" id="kt_stats_widget_2_tab_1">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-125px"></th>
                                                    <th class="text-end min-w-100px">QTY</th>
                                                    <th class="pe-0 text-end min-w-100px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-100px">TOTAL
                                                        PRICE</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/210.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                                            1802</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-2347</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$72.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$126.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/215.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                                            Laga</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-1321</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$45.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$76.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/209.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-4312</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$84.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$168.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="kt_stats_widget_2_tab_2">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-125px"></th>
                                                    <th class="text-end min-w-100px">QTY</th>
                                                    <th class="pe-0 text-end min-w-100px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-100px">TOTAL
                                                        PRICE</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/197.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                                            1802</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-4312</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$32.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$312.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/178.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                                            Laga</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-3122</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$53.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$62.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/22.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-1142</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$74.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$139.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="kt_stats_widget_2_tab_3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-125px"></th>
                                                    <th class="text-end min-w-100px">QTY</th>
                                                    <th class="pe-0 text-end min-w-100px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-100px">TOTAL
                                                        PRICE</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/1.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                                            1324</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-1523</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$43.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$231.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/24.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                                            Laga</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-5314</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$71.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$53.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/71.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-4222</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$23.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$213.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="kt_stats_widget_2_tab_4">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-125px"></th>
                                                    <th class="text-end min-w-100px">QTY</th>
                                                    <th class="pe-0 text-end min-w-100px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-100px">TOTAL
                                                        PRICE</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/41.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Elephant
                                                            2635</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-1523</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$65.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$163.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/63.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Red
                                                            Laga</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-2745</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$64.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$73.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/59.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">RiseUP</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-5173</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$54.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$173.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->

                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="kt_stats_widget_2_tab_5">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="ps-0 w-50px">ITEM</th>
                                                    <th class="min-w-125px"></th>
                                                    <th class="text-end min-w-100px">QTY</th>
                                                    <th class="pe-0 text-end min-w-100px">PRICE</th>
                                                    <th class="pe-0 text-end min-w-100px">TOTAL
                                                        PRICE</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/10.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Nike</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-2163</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x1</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$64.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$287.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/96.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Adidas</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-2162</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x2</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$76.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$51.00</span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/13.png') }}"
                                                            class="w-50px ms-n1" alt="" />
                                                    </td>
                                                    <td class="ps-0">
                                                        <a href="apps/ecommerce/catalog/edit-product.html"
                                                            class="text-gray-800 fw-bold text-hover-primary mb-1 fs-6 text-start pe-0">Puma</a>
                                                        <span
                                                            class="text-gray-500 fw-semibold fs-7 d-block text-start ps-0">Item:
                                                            #XDG-1537</span>
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6 ps-0 text-end">x3</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$27.00</span>
                                                    </td>
                                                    <td class="text-end pe-0">
                                                        <span
                                                            class="text-gray-800 fw-bold d-block fs-6">$167.00</span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Table container-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Table widget 2-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-6 mb-5 mb-xl-10">
                    <!--begin::Chart widget 4-->
                    <div class="card card-flush overflow-hidden h-md-100">
                        <!--begin::Header-->
                        <div class="card-header py-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-900">Discounted Product
                                    Sales</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Users from all
                                    channels</span>
                            </h3>
                            <!--end::Title-->

                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Menu-->
                                <button
                                    class="btn btn-icon btn-color-gray-500 btn-active-color-primary justify-content-end"
                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end"
                                    data-kt-menu-overflow="true">

                                    <i class="ki-duotone ki-dots-square fs-1"><span class="path1"></span><span
                                            class="path2"></span><span class="path3"></span><span
                                            class="path4"></span></i>
                                </button>


                                <!--begin::Menu 2-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px"
                                    data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content fs-6 text-gray-900 fw-bold px-3 py-4">
                                            Quick Actions</div>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator mb-3 opacity-75"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            New Ticket
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            New Customer
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3" data-kt-menu-trigger="hover"
                                        data-kt-menu-placement="right-start">
                                        <!--begin::Menu item-->
                                        <a href="#" class="menu-link px-3">
                                            <span class="menu-title">New Group</span>
                                            <span class="menu-arrow"></span>
                                        </a>
                                        <!--end::Menu item-->

                                        <!--begin::Menu sub-->
                                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Admin Group
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Staff Group
                                                </a>
                                            </div>
                                            <!--end::Menu item-->

                                            <!--begin::Menu item-->
                                            <div class="menu-item px-3">
                                                <a href="#" class="menu-link px-3">
                                                    Member Group
                                                </a>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="#" class="menu-link px-3">
                                            New Contact
                                        </a>
                                    </div>
                                    <!--end::Menu item-->

                                    <!--begin::Menu separator-->
                                    <div class="separator mt-3 opacity-75"></div>
                                    <!--end::Menu separator-->

                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content px-3 py-3">
                                            <a class="btn btn-primary  btn-sm px-4" href="#">
                                                Generate Reports
                                            </a>
                                        </div>
                                    </div>
                                    <!--end::Menu item-->
                                </div>
                                <!--end::Menu 2-->

                                <!--end::Menu-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->

                        <!--begin::Card body-->
                        <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                            <!--begin::Info-->
                            <div class="px-9 mb-5">
                                <!--begin::Statistics-->
                                <div class="d-flex align-items-center mb-2">
                                    <!--begin::Currency-->
                                    <span class="fs-4 fw-semibold text-gray-500 align-self-start me-1">$</span>
                                    <!--end::Currency-->

                                    <!--begin::Value-->
                                    <span class="fs-2hx fw-bold text-gray-800 me-2 lh-1 ls-n2">3,706</span>
                                    <!--end::Value-->

                                    <!--begin::Label-->
                                    <span class="badge badge-light-success fs-base">
                                        <i class="ki-duotone ki-arrow-down fs-5 text-success ms-n1"><span
                                                class="path1"></span><span class="path2"></span></i>
                                        4.5%
                                    </span>
                                    <!--end::Label-->
                                </div>
                                <!--end::Statistics-->

                                <!--begin::Description-->
                                <span class="fs-6 fw-semibold text-gray-500">Total Discounted Sales
                                    This Month</span>
                                <!--end::Description-->
                            </div>
                            <!--end::Info-->

                            <!--begin::Chart-->
                            <div id="kt_charts_widget_4" class="min-h-auto ps-4 pe-6" style="height: 300px"></div>
                            <!--end::Chart-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Chart widget 4-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-4 mb-xxl-10">

                    <!--begin::List widget 17-->
                    <div class="card card-flush h-xxl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Popular
                                    Products</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">8k social
                                    visitors</span>
                            </h3>
                            <!--end::Title-->

                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">Add
                                    Product</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body pt-0">
                            <!--begin::Content-->
                            <div class="d-flex flex-stack my-5">
                                <span class="text-gray-500 fs-7 fw-bold">ITEM</span>

                                <span class="text-gray-500 fw-bold fs-7">ITEM PRICE</span>
                            </div>
                            <!--end::Content-->


                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/14.png') }}" class="me-4 w-50px" alt="" />
                                    <!--end::Icon-->

                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Fjallraven</a>

                                        <span class="text-gray-500 fw-semibold d-block fs-7">Item:
                                            #XDG-6437</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">
                                    $ 72.00 </span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->


                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/13.png') }}" class="me-4 w-50px" alt="" />
                                    <!--end::Icon-->

                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Nike
                                            AirMax</a>

                                        <span class="text-gray-500 fw-semibold d-block fs-7">Item:
                                            #XDG-1836</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">
                                    $ 45.00 </span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->


                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/41.png') }}" class="me-4 w-50px" alt="" />
                                    <!--end::Icon-->

                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Bose
                                            QC 35</a>

                                        <span class="text-gray-500 fw-semibold d-block fs-7">Item:
                                            #XDG-6254</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">
                                    $ 168.00 </span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->


                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/53.png') }}" class="me-4 w-50px" alt="" />
                                    <!--end::Icon-->

                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Greeny</a>

                                        <span class="text-gray-500 fw-semibold d-block fs-7">Item:
                                            #XDG-1746</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">
                                    $ 14.50 </span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->


                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/71.png') }}" class="me-4 w-50px" alt="" />
                                    <!--end::Icon-->

                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Apple
                                            Watches</a>

                                        <span class="text-gray-500 fw-semibold d-block fs-7">Item:
                                            #XDG-6245</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">
                                    $ 362.00 </span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->


                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center me-3">
                                    <!--begin::Icon-->
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/stock/ecommerce/194.png') }}" class="me-4 w-50px" alt="" />
                                    <!--end::Icon-->

                                    <!--begin::Section-->
                                    <div class="flex-grow-1">
                                        <a href="apps/ecommerce/sales/details.html"
                                            class="text-gray-800 text-hover-primary fs-5 fw-bold lh-0">Friendly
                                            Robot</a>

                                        <span class="text-gray-500 fw-semibold d-block fs-7">Item:
                                            #XDG-2347</span>
                                    </div>
                                    <!--end::Section-->
                                </div>
                                <!--end::Wrapper-->

                                <!--begin::Value-->
                                <span class="text-gray-800 fw-bold fs-6">
                                    $ 48.00 </span>
                                <!--end::Value-->
                            </div>
                            <!--end::Item-->



                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::List widget 17-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xxl-8 mb-5 mb-xl-10">

                    <!--begin::Table widget 6-->
                    <div class="card card-flush h-xxl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Leading Agents by
                                    Category</span>

                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Total 424,567
                                    deliveries</span>
                            </h3>
                            <!--end::Title-->

                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="apps/ecommerce/catalog/add-product.html" class="btn btn-sm btn-light">Add
                                    Product</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Nav-->
                            <ul class="nav nav-pills nav-pills-custom mb-3">
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                    active" data-bs-toggle="pill" href="#kt_stats_widget_6_tab_1">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="ki-duotone ki-truck fs-1"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                                            Van </span>
                                        <!--end::Title-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                    " data-bs-toggle="pill" href="#kt_stats_widget_6_tab_2">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="ki-duotone ki-bus fs-1"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span></i>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                                            Train </span>
                                        <!--end::Title-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <li class="nav-item mb-3 me-3 me-lg-6">
                                    <!--begin::Link-->
                                    <a class="nav-link btn btn-outline btn-flex btn-color-muted btn-active-color-primary flex-column overflow-hidden w-80px h-85px pt-5 pb-2 
                    " data-bs-toggle="pill" href="#kt_stats_widget_6_tab_3">
                                        <!--begin::Icon-->
                                        <div class="nav-icon mb-3">
                                            <i class="ki-duotone ki-logistic fs-1"><span class="path1"></span><span
                                                    class="path2"></span><span class="path3"></span><span
                                                    class="path4"></span><span class="path5"></span><span
                                                    class="path6"></span><span class="path7"></span></i>
                                        </div>
                                        <!--end::Icon-->

                                        <!--begin::Title-->
                                        <span class="nav-text text-gray-800 fw-bold fs-6 lh-1">
                                            Drone </span>
                                        <!--end::Title-->

                                        <!--begin::Bullet-->
                                        <span
                                            class="bullet-custom position-absolute bottom-0 w-100 h-4px bg-primary"></span>
                                        <!--end::Bullet-->
                                    </a>
                                    <!--end::Link-->
                                </li>
                                <!--end::Item-->

                            </ul>
                            <!--end::Nav-->

                            <!--begin::Tab Content-->
                            <div class="tab-content">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade active show" id="kt_stats_widget_6_tab_1">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-1.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brooklyn
                                                                    Simmons</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">1,240</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$5,400</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-2.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Annette
                                                                    Black</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">6,074</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$174,074</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-12.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Esther
                                                                    Howard</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">357</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$2,737</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-11.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Guy
                                                                    Hawkins</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">2,954</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$59,634</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label ">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-13.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Marvin
                                                                    McKinney</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">822</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$19,842</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="kt_stats_widget_6_tab_2">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-11.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Guy
                                                                    Hawkins</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">2,954</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$59,634</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label ">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-13.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Marvin
                                                                    McKinney</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">822</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$19,842</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-1.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brooklyn
                                                                    Simmons</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">1,240</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$5,400</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-2.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Annette
                                                                    Black</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">6,074</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$174,074</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-12.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Esther
                                                                    Howard</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">357</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$2,737</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade " id="kt_stats_widget_6_tab_3">
                                    <!--begin::Table container-->
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="fs-7 fw-bold text-gray-500 border-bottom-0">
                                                    <th class="p-0 w-200px w-xxl-450px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-150px"></th>
                                                    <th class="p-0 min-w-190px"></th>
                                                    <th class="p-0 w-50px"></th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->

                                            <!--begin::Table body-->
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-1.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Brooklyn
                                                                    Simmons</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">1,240</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$5,400</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-11.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Guy
                                                                    Hawkins</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">2,954</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$59,634</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label ">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-13.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Marvin
                                                                    McKinney</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">822</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$19,842</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-12.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Esther
                                                                    Howard</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">357</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$2,737</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="symbol symbol-40px me-3">
                                                                <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/avatars/300-2.jpg') }}" class=""
                                                                    alt="" />
                                                            </div>

                                                            <div class="d-flex justify-content-start flex-column">
                                                                <a href="#"
                                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Annette
                                                                    Black</a>
                                                                <span
                                                                    class="text-muted fw-semibold d-block fs-7">Zuid
                                                                    Area</span>
                                                            </div>
                                                        </div>
                                                    </td>

                                                    <td>
                                                        <span
                                                            class="text-gray-800 fw-bold d-block mb-1 fs-6">6,074</span>
                                                        <span
                                                            class="fw-semibold text-gray-500 d-block">Deliveries</span>
                                                    </td>

                                                    <td>
                                                        <a href="#"
                                                            class="text-gray-900 fw-bold text-hover-primary d-block mb-1 fs-6">$174,074</a>
                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7">Earnings</span>
                                                    </td>

                                                    <td>
                                                        <div class="rating">
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                            <div class="rating-label checked">
                                                                <i class="ki-solid ki-star fs-6"></i>
                                                            </div>
                                                        </div>

                                                        <span
                                                            class="text-muted fw-semibold d-block fs-7 mt-1">Rating</span>
                                                    </td>

                                                    <td class="text-end">
                                                        <a href="#"
                                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                            <i
                                                                class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                            <!--end::Tab Content-->
                        </div>
                        <!--end: Card Body-->
                    </div>
                    <!--end::Table widget 6-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row g-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xxl-8 mb-xxl-10">

                    <!--begin::Table widget 7-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h4 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Latest
                                    Activity</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-7">Updated 37 minutes
                                    ago</span>
                            </h4>
                            <!--end::Title-->

                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Daterangepicker(defined in src/js/layout/app.js)-->
                                <div data-kt-daterangepicker="true" data-kt-daterangepicker-opens="left"
                                    class="btn btn-flex btn-sm btn-light d-flex align-items-center px-4">
                                    <!--begin::Display range-->
                                    <div class="text-gray-600 fw-bold">
                                        Loading date range...
                                    </div>
                                    <!--end::Display range-->

                                    <i class="ki-duotone ki-calendar-8 text-gray-500 lh-0 fs-2 ms-2 me-0"><span
                                            class="path1"></span><span class="path2"></span><span
                                            class="path3"></span><span class="path4"></span><span
                                            class="path5"></span><span class="path6"></span></i>
                                </div>
                                <!--end::Daterangepicker-->
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body py-3">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-row-dashed align-middle gs-0 gy-4 my-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="border-bottom-0">
                                            <th class="p-0 w-50px"></th>
                                            <th class="p-0 min-w-175px"></th>
                                            <th class="p-0 min-w-175px"></th>
                                            <th class="p-0 min-w-150px"></th>
                                            <th class="p-0 min-w-150px"></th>
                                            <th class="p-0 min-w-50px"></th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->

                                    <!--begin::Table body-->
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="symbol symbol-40px">
                                                    <span class="symbol-label bg-light-info">
                                                        <i class="ki-duotone ki-abstract-24 fs-2x text-info"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="ps-0">
                                                <a href="#"
                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Insurance</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Personal
                                                    Health</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">BTC
                                                    Wallet</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Personal
                                                    Account</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">23
                                                    Jan, 22</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Last
                                                    Payment</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">-0.0024
                                                    BTC</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Balance</span>
                                            </td>

                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-arrow-right fs-2"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="symbol symbol-40px">
                                                    <span class="symbol-label bg-light-success">
                                                        <i class="ki-duotone ki-flask fs-2x text-success"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="ps-0">
                                                <a href="#"
                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Annette
                                                    Black</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                    Area</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">ETH
                                                    Wallet</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Personal
                                                    Account</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">04
                                                    Feb, 22</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Last
                                                    Payment</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">-0.346
                                                    ETH</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Balance</span>
                                            </td>

                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-arrow-right fs-2"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="symbol symbol-40px">
                                                    <span class="symbol-label bg-light-danger">
                                                        <i class="ki-duotone ki-abstract-33 fs-2x text-danger"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="ps-0">
                                                <a href="#"
                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Esther
                                                    Howard</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                    Area</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">BTC
                                                    Wallet</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Personal
                                                    Account</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">18
                                                    Feb, 22</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Last
                                                    Payment</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">-0.00081
                                                    BTC</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Balance</span>
                                            </td>

                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-arrow-right fs-2"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="symbol symbol-40px">
                                                    <span class="symbol-label bg-light-primary">
                                                        <i class="ki-duotone ki-abstract-47 fs-2x text-primary"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="ps-0">
                                                <a href="#"
                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Guy
                                                    Hawkins</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                    Area</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">DOGE
                                                    Wallet</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Personal
                                                    Account</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">01
                                                    Apr, 22</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Last
                                                    Payment</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">-456.34
                                                    DOGE</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Balance</span>
                                            </td>

                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-arrow-right fs-2"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="symbol symbol-40px">
                                                    <span class="symbol-label bg-light-warning">
                                                        <i class="ki-duotone ki-technology-2 fs-2x text-warning"><span
                                                                class="path1"></span><span class="path2"></span></i>
                                                    </span>
                                                </div>
                                            </td>

                                            <td class="ps-0">
                                                <a href="#"
                                                    class="text-gray-900 fw-bold text-hover-primary mb-1 fs-6">Marvin
                                                    McKinney</a>
                                                <span class="text-muted fw-semibold d-block fs-7">Zuid
                                                    Area</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">BTC
                                                    Wallet</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Personal
                                                    Account</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">26
                                                    May, 22</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Last
                                                    Payment</span>
                                            </td>

                                            <td>
                                                <span class="text-gray-900 fw-bold d-block fs-6">-0.000039
                                                    BTC</span>

                                                <span class="text-gray-500 fw-semibold d-block fs-7">Balance</span>
                                            </td>

                                            <td class="text-end">
                                                <a href="#"
                                                    class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-30px h-30px">
                                                    <i class="ki-duotone ki-arrow-right fs-2"><span
                                                            class="path1"></span><span class="path2"></span></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table container-->
                        </div>
                        <!--begin::Body-->
                    </div>
                    <!--end::Table widget 7-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xxl-4 mb-5 mb-xl-10">

                    <!--begin::List widget 22-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Mining Status</span>

                                <span class="text-gray-500 mt-1 fw-semibold fs-6">8k social
                                    visitors</span>
                            </h3>
                            <!--end::Title-->

                            <!--begin::Toolbar-->
                            <div class="card-toolbar">
                                <a href="#" class="btn btn-sm btn-light" class="btn btn-sm btn-light">All
                                    Courses</a>
                            </div>
                            <!--end::Toolbar-->
                        </div>
                        <!--end::Header-->

                        <!--begin::Body-->
                        <div class="card-body">

                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-info">
                                            <i class="ki-duotone ki-abstract-24 fs-2x text-info"><span
                                                    class="path1"></span><span class="path2"></span></i> </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">GPUs
                                            mining</a>
                                        <!--end::Title-->

                                        <!--begin::Desc-->
                                        <span
                                            class="fw-semibold fs-7 d-block text-start text-success ps-0">Running</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->

                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::Action-->
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input h-20px w-30px" type="checkbox" value=""
                                                id="flexSwitchChecked" checked="checked" />
                                        </div>
                                        <!--end::Action-->

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->

                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-success">
                                            <i class="ki-duotone ki-flask fs-2x text-success"><span
                                                    class="path1"></span><span class="path2"></span></i> </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">GPUs
                                            mining</a>
                                        <!--end::Title-->

                                        <!--begin::Desc-->
                                        <span
                                            class="fw-semibold fs-7 d-block text-start text-success ps-0">Running</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->

                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::Action-->
                                        <div class="form-check form-switch form-check-custom form-check-solid">
                                            <input class="form-check-input h-20px w-30px" type="checkbox" value=""
                                                id="flexSwitchChecked" checked="checked" />
                                        </div>
                                        <!--end::Action-->

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->

                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-danger">
                                            <i class="ki-duotone ki-abstract-33 fs-2x text-danger"><span
                                                    class="path1"></span><span class="path2"></span></i> </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Est.
                                            daily USD</a>
                                        <!--end::Title-->

                                        <!--begin::Desc-->
                                        <span
                                            class="fw-semibold fs-7 d-block text-start text-gray-400 ps-0">$48.02</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->

                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::Action-->
                                        <a href="#"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-25px h-25px">
                                            <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                        </a>
                                        <!--end::Action-->

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->

                            <!--begin::Separator-->
                            <div class="separator separator-dashed my-4"></div>
                            <!--end::Separator-->

                            <!--begin::Item-->
                            <div class="d-flex flex-stack">
                                <!--begin::Section-->
                                <div class="d-flex align-items-center me-5">
                                    <!--begin::Symbol-->
                                    <div class="symbol symbol-40px me-3">
                                        <span class="symbol-label bg-light-primary">
                                            <i class="ki-duotone ki-abstract-47 fs-2x text-primary"><span
                                                    class="path1"></span><span class="path2"></span></i> </span>
                                    </div>
                                    <!--end::Symbol-->

                                    <!--begin::Content-->
                                    <div class="me-5">
                                        <!--begin::Title-->
                                        <a href="#" class="text-gray-800 fw-bold text-hover-primary fs-6">Team
                                            Members</a>
                                        <!--end::Title-->

                                        <!--begin::Desc-->
                                        <span
                                            class="fw-semibold fs-7 d-block text-start text-gray-400 ps-0">6</span>
                                        <!--end::Desc-->
                                    </div>
                                    <!--end::Content-->
                                </div>
                                <!--end::Section-->

                                <!--begin::Wrapper-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Info-->
                                    <div class="d-flex flex-center">
                                        <!--begin::Action-->
                                        <a href="#"
                                            class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary w-25px h-25px">
                                            <i class="ki-duotone ki-black-right fs-2 text-gray-500"></i>
                                        </a>
                                        <!--end::Action-->

                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Wrapper-->
                            </div>
                            <!--end::Item-->

                        </div>
                        <!--end::Body-->

                        <!--begin::Footer-->
                        <div class="card-footer mx-auto pt-0">
                            <!--begin::Actions-->
                            <a href="#" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_view_users">Add PC</a>
                            <a href="#" class="btn btn-light btn-sm" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_users_search">Buy GPU</a>
                            <!--end::Actions-->
                        </div>
                        <!--end::Footer-->
                    </div>
                    <!--end::List widget 22-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row gy-5 g-xl-10">
                <!--begin::Col-->
                <div class="col-xl-4 mb-xl-10">

                    <!--begin::Engage widget 1-->
                    <div class="card h-md-100" dir="ltr">
                        <!--begin::Body-->
                        <div class="card-body d-flex flex-column flex-center">
                            <!--begin::Heading-->
                            <div class="mb-2">
                                <!--begin::Title-->
                                <h1 class="fw-semibold text-gray-800 text-center lh-lg">
                                    Have you tried <br /> new
                                    <span class="fw-bolder"> eCommerce App ?</span>
                                </h1>
                                <!--end::Title-->

                                <!--begin::Illustration-->
                                <div class="py-10 text-center">
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/svg/illustrations/easy/2.svg') }}"
                                        class="theme-light-show w-200px" alt="" />
                                    <img src="{{ asset(BackHelper::getEnvFolder() . 'storage/back/assets/media/svg/illustrations/easy/2-dark.svg') }}"
                                        class="theme-dark-show w-200px" alt="" />
                                </div>
                                <!--end::Illustration-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Links-->
                            <div class="text-center mb-1">
                                <!--begin::Link-->
                                <a class="btn btn-sm btn-primary me-2" href="apps/ecommerce/sales/listing.html">
                                    View App </a>
                                <!--end::Link-->

                                <!--begin::Link-->
                                <a class="btn btn-sm btn-light" href="apps/ecommerce/catalog/add-product.html">
                                    New Product </a>
                                <!--end::Link-->
                            </div>
                            <!--end::Links-->
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Engage widget 1-->

                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-8 mb-5 mb-xl-10">

                    <!--begin::Table Widget 4-->
                    <div class="card card-flush h-xl-100">
                        <!--begin::Card header-->
                        <div class="card-header pt-7">
                            <!--begin::Title-->
                            <h3 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold text-gray-800">Product Orders</span>
                                <span class="text-gray-500 mt-1 fw-semibold fs-6">Avg. 57 orders per
                                    day</span>
                            </h3>
                            <!--end::Title-->

                            <!--begin::Actions-->
                            <div class="card-toolbar">
                                <!--begin::Filters-->
                                <div class="d-flex flex-stack flex-wrap gap-4">
                                    <!--begin::Destination-->
                                    <div class="d-flex align-items-center fw-bold">
                                        <!--begin::Label-->
                                        <div class="text-gray-500 fs-7 me-2">Cateogry</div>
                                        <!--end::Label-->

                                        <!--begin::Select-->
                                        <select
                                            class="form-select form-select-transparent text-graY-800 fs-base lh-1 fw-bold py-0 ps-3 w-auto"
                                            data-control="select2" data-hide-search="true"
                                            data-dropdown-css-class="w-150px" data-placeholder="Select an option">
                                            <option></option>
                                            <option value="Show All" selected>Show All</option>
                                            <option value="a">Category A</option>
                                            <option value="b">Category A</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                    <!--end::Destination-->

                                    <!--begin::Status-->
                                    <div class="d-flex align-items-center fw-bold">
                                        <!--begin::Label-->
                                        <div class="text-gray-500 fs-7 me-2">Status</div>
                                        <!--end::Label-->

                                        <!--begin::Select-->
                                        <select
                                            class="form-select form-select-transparent text-gray-900 fs-7 lh-1 fw-bold py-0 ps-3 w-auto"
                                            data-control="select2" data-hide-search="true"
                                            data-dropdown-css-class="w-150px" data-placeholder="Select an option"
                                            data-kt-table-widget-4="filter_status">
                                            <option></option>
                                            <option value="Show All" selected>Show All</option>
                                            <option value="Shipped">Shipped</option>
                                            <option value="Confirmed">Confirmed</option>
                                            <option value="Rejected">Rejected</option>
                                            <option value="Pending">Pending</option>
                                        </select>
                                        <!--end::Select-->
                                    </div>
                                    <!--end::Status-->

                                    <!--begin::Search-->
                                    <div class="position-relative my-1">
                                        <i
                                            class="ki-duotone ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-4"><span
                                                class="path1"></span><span class="path2"></span></i>
                                        <input type="text" data-kt-table-widget-4="search"
                                            class="form-control w-150px fs-7 ps-12" placeholder="Search" />
                                    </div>
                                    <!--end::Search-->
                                </div>
                                <!--begin::Filters-->
                            </div>
                            <!--end::Actions-->
                        </div>
                        <!--end::Card header-->

                        <!--begin::Card body-->
                        <div class="card-body pt-2">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-3"
                                id="kt_table_widget_4_table">
                                <!--begin::Table head-->
                                <thead>
                                    <!--begin::Table row-->
                                    <tr class="text-start text-gray-500 fw-bold fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">Order ID</th>
                                        <th class="text-end min-w-100px">Created</th>
                                        <th class="text-end min-w-125px">Customer</th>
                                        <th class="text-end min-w-100px">Total</th>
                                        <th class="text-end min-w-100px">Profit</th>
                                        <th class="text-end min-w-50px">Status</th>
                                        <th class="text-end"></th>
                                    </tr>
                                    <!--end::Table row-->
                                </thead>
                                <!--end::Table head-->

                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    <tr data-kt-table-widget-4="subtable_template" class="d-none">
                                        <td colspan="2">
                                            <div class="d-flex align-items-center gap-3">
                                                <a href="#"
                                                    class="symbol symbol-50px bg-secondary bg-opacity-25 rounded">
                                                    <img src="#"
                                                        data-kt-src-path="/star-html-pro/assets/media/stock/ecommerce/"
                                                        alt="" data-kt-table-widget-4="template_image" />
                                                </a>
                                                <div class="d-flex flex-column text-muted">
                                                    <a href="#" class="text-gray-800 text-hover-primary fw-bold"
                                                        data-kt-table-widget-4="template_name">Product
                                                        name</a>
                                                    <div class="fs-7" data-kt-table-widget-4="template_description">
                                                        Product description</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7">Cost</div>
                                            <div class="text-muted fs-7 fw-bold"
                                                data-kt-table-widget-4="template_cost">1</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7">Qty</div>
                                            <div class="text-muted fs-7 fw-bold"
                                                data-kt-table-widget-4="template_qty">1</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7">Total</div>
                                            <div class="text-muted fs-7 fw-bold"
                                                data-kt-table-widget-4="template_total">name</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="text-gray-800 fs-7 me-3">On hand</div>
                                            <div class="text-muted fs-7 fw-bold"
                                                data-kt-table-widget-4="template_stock">32</div>
                                        </td>
                                        <td></td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="text-gray-800 text-hover-primary">#XGY-346</a>
                                        </td>

                                        <td class="text-end">
                                            7 min ago
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Albert
                                                Flores</a>
                                        </td>

                                        <td class="text-end">
                                            $630.00 </td>

                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bolder">$86.70</span>
                                        </td>

                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                                <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="text-gray-800 text-hover-primary">#YHD-047</a>
                                        </td>

                                        <td class="text-end">
                                            52 min ago
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Jenny
                                                Wilson</a>
                                        </td>

                                        <td class="text-end">
                                            $25.00 </td>

                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bolder">$4.20</span>
                                        </td>

                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-primary">Confirmed</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                                <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="text-gray-800 text-hover-primary">#SRR-678</a>
                                        </td>

                                        <td class="text-end">
                                            1 hour ago
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Robert
                                                Fox</a>
                                        </td>

                                        <td class="text-end">
                                            $1,630.00 </td>

                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bolder">$203.90</span>
                                        </td>

                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-warning">Pending</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                                <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="text-gray-800 text-hover-primary">#PXF-534</a>
                                        </td>

                                        <td class="text-end">
                                            3 hour ago
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Cody
                                                Fisher</a>
                                        </td>

                                        <td class="text-end">
                                            $119.00 </td>

                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bolder">$12.00</span>
                                        </td>

                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                                <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="text-gray-800 text-hover-primary">#XGD-249</a>
                                        </td>

                                        <td class="text-end">
                                            2 day ago
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Arlene
                                                McCoy</a>
                                        </td>

                                        <td class="text-end">
                                            $660.00 </td>

                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bolder">$52.26</span>
                                        </td>

                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                                <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="text-gray-800 text-hover-primary">#SKP-035</a>
                                        </td>

                                        <td class="text-end">
                                            2 day ago
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Eleanor
                                                Pena</a>
                                        </td>

                                        <td class="text-end">
                                            $290.00 </td>

                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bolder">$29.00</span>
                                        </td>

                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">Rejected</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                                <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <a href="apps/ecommerce/catalog/edit-product.html"
                                                class="text-gray-800 text-hover-primary">#SKP-567</a>
                                        </td>

                                        <td class="text-end">
                                            7 min ago
                                        </td>

                                        <td class="text-end">
                                            <a href="#" class="text-gray-600 text-hover-primary">Dan
                                                Wilson</a>
                                        </td>

                                        <td class="text-end">
                                            $590.00 </td>

                                        <td class="text-end">
                                            <span class="text-gray-800 fw-bolder">$50.00</span>
                                        </td>

                                        <td class="text-end">
                                            <span class="badge py-3 px-4 fs-7 badge-light-success">Shipped</span>
                                        </td>

                                        <td class="text-end">
                                            <button type="button"
                                                class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px"
                                                data-kt-table-widget-4="expand_row">
                                                <i class="ki-duotone ki-plus fs-4 m-0 toggle-off"></i>
                                                <i class="ki-duotone ki-minus fs-4 m-0 toggle-on"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Table Widget 4-->
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->

</div>
<!--end::Content wrapper-->
@endsection