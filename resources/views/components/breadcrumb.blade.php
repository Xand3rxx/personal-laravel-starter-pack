<ul class="breadcrumb breadcrumb-dot fw-bold text-gray-600 fs-7 my-1">
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-600">
        <a href="{{ auth()->user()->role->id == 1 ? route('administrator.home') : route('client.home') }}"
            class="text-gray-600 text-hover-primary">Dashboard</a>
    </li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-600">{{ !empty($title) ? Str::title($title) : '' }}</li>
    <!--end::Item-->
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-500">{{ !empty($subTitle) ? Str::title($subTitle) : '' }}</li>
    <!--end::Item-->
</ul>
