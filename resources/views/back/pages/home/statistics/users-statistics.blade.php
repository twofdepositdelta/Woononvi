<div class="col">
    <div class="card shadow-none border bg-gradient-start-1 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Total des Utilisateurs</p>
                    <h6 class="mb-0">{{ BackHelper::getUsersTotal() }}</h6>
                </div>
                <div class="w-50-px h-50-px bg-cyan rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="gridicons:multiple-users" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +{{ $totalUsersLast30Days }}
                </span>
                Utilisateurs des 30 derniers jours
            </p>
        </div>
    </div><!-- card end -->
</div>
<div class="col">
    <div class="card shadow-none border bg-gradient-start-2 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Total Conducteurs</p>
                    <h6 class="mb-0">{{ BackHelper::getDriversTotal() }}</h6>
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
<div class="col">
    <div class="card shadow-none border bg-gradient-start-3 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Total Passagers</p>
                    <h6 class="mb-0">{{ BackHelper::getPassengersTotal() }}</h6>
                </div>
                <div class="w-50-px h-50-px bg-info rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="fluent:people-20-filled" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +{{ $totalPassengersLast30Days }}
                </span>
                Passagers des 30 derniers jours
            </p>
        </div>
    </div><!-- card end -->
</div>



