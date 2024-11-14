<div class="col">
    <div class="card shadow-none border bg-gradient-start-3 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Total Trajets</p>
                    <h6 class="mb-0">{{ BackHelper::getRidesTotal() }}</h6>
                </div>
                <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="fa-solid:car" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +{{ BackHelper::getRidesActive() }}
                </span>
                Trajets actifs actuellemnt
            </p>
        </div>
    </div><!-- card end -->
</div>
<div class="col">
    <div class="card shadow-none border bg-gradient-start-1 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Total Réservations</p>
                    <h6 class="mb-0">{{ BackHelper::getBooking() }}</h6>
                </div>
                <div class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="fa6-solid:file-invoice-dollar" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +$5,000
                </span>
                Last 30 days expense
            </p>
        </div>
    </div><!-- card end -->
</div>
<div class="col">
    <div class="card shadow-none border bg-gradient-start-2 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Total Demandes</p>
                    <h6 class="mb-0">{{ BackHelper::getRideRequest() }}</h6>
                </div>
                <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="fa-solid:user" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +{{ $totalDriversLast30Days }}
                </span>
                Conducteurs des 30 derniers jours
            </p>
        </div>
    </div><!-- card end -->
</div>
