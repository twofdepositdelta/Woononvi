<div class="col">
    <div class="card shadow-none border bg-gradient-start-2 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Montant Total Actuel Balance</p>
                    <h6 class="mb-0">{{ BackHelper::getTotalBalence() }} XOF</h6>
                </div>
                <div class="w-50-px h-50-px bg-purple rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="fa-solid:wallet" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-danger-main">
                    <iconify-icon icon="bxs:down-arrow" class="text-xs"></iconify-icon> +{{ BackHelper::getTotalBalence() }} XOF
                </span>
                Hors Comptabilité
            </p>
        </div>
    </div><!-- card end -->
</div>
<div class="col">
    <div class="card shadow-none border bg-gradient-start-3 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Montant Total Trajets</p>
                    <h6 class="mb-0">{{ BackHelper::getTotalBookingPayments() }} XOF</h6>
                </div>
                <div class="w-50-px h-50-px bg-info-main rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="fa-solid:check-circle" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +{{ BackHelper::getTotalBookingPaymentsOther() }} XOF
                </span>
                Total Paiement Non Terminé
            </p>
        </div>
    </div><!-- card end -->
</div>
<div class="col">
    <div class="card shadow-none border bg-gradient-start-1 h-100">
        <div class="card-body p-20">
            <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
                <div>
                    <p class="fw-medium text-primary-light mb-1">Montant Trajets Effectués</p>
                    <h6 class="mb-0">{{ BackHelper::getTotalCompletedBookingPayments() }} XOF</h6>
                </div>
                <div class="w-50-px h-50-px bg-success rounded-circle d-flex justify-content-center align-items-center">
                    <iconify-icon icon="fa-solid:money-check-alt" class="text-white text-2xl mb-0"></iconify-icon>
                </div>
            </div>
            <p class="fw-medium text-sm text-primary-light mt-12 mb-0 d-flex align-items-center gap-2">
                <span class="d-inline-flex align-items-center gap-1 text-success-main">
                    <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon> +{{ BackHelper::getTotalComision() }} XOF
                </span>
                Total Commission Touchée
            </p>
        </div>
    </div><!-- card end -->
</div>

