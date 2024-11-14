@if (session('success'))
    <div class="alert alert-primary bg-primary-50 text-primary-600 border-primary-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-2 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mdi:check-circle-outline" class="icon text-xl"></iconify-icon>
            <div>{{ session('success') }}</div>
        </div>
        <button class="remove-button text-primary-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning bg-warning-100 text-warning-600 border-warning-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-2 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mdi:alert-circle-outline" class="icon text-xl"></iconify-icon>
            <div>{{ session('warning') }}</div>
        </div>
        <button class="remove-button text-warning-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-2 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mdi:alert-octagon-outline" class="icon text-xl"></iconify-icon>
            <div>{{ session('error') }}</div>
        </div>
        <button class="remove-button text-danger-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif

@if (session('danger'))
    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-2 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mdi:alert-octagon-outline" class="icon text-xl"></iconify-icon>
            <div>{{ session('error') }}</div>
        </div>
        <button class="remove-button text-danger-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info bg-info-100 text-info-600 border-info-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-2 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mdi:information-outline" class="icon text-xl"></iconify-icon>
            <div>{{ session('info') }}</div>
        </div>
        <button class="remove-button text-info-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger bg-danger-100 text-danger-600 border-danger-600 border-start-width-4-px border-top-0 border-end-0 border-bottom-0 px-24 py-13 mb-2 fw-semibold text-sm radius-4 d-flex align-items-center justify-content-between" role="alert">
        <div class="d-flex align-items-center gap-2">
            <iconify-icon icon="mdi:alert-octagon-outline" class="icon text-xl"></iconify-icon>
            <div>
                @foreach ($errors->all() as $error)
                    <p class="mb-1">{{ $error }}</p>
                @endforeach
            </div>
        </div>
        <button class="remove-button text-danger-600 text-xxl line-height-1">
            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
        </button>
    </div>
@endif
