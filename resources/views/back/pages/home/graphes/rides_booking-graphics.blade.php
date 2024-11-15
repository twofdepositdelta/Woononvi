<div class="col-xxl-6 col-xl-12">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex flex-wrap align-items-center justify-content-between">
                <h6 class="text-lg mb-0">Sales Statistic</h6>
                <select class="form-select bg-base form-select-sm w-auto">
                    <option>Yearly</option>
                    <option>Monthly</option>
                    <option>Weekly</option>
                    <option>Today</option>
                </select>
            </div>
            <div class="d-flex flex-wrap align-items-center gap-2 mt-8">
                <h6 class="mb-0">$27,200</h6>
                <span class="text-sm fw-semibold rounded-pill bg-success-focus text-success-main border br-success px-8 py-4 line-height-1 d-flex align-items-center gap-1">
                    10% <iconify-icon icon="bxs:up-arrow" class="text-xs"></iconify-icon>
                </span>
                <span class="text-xs fw-medium">+ $1500 Per Day</span>
            </div>
            <div id="chart" class="pt-28 apexcharts-tooltip-style-1"></div>
        </div>
    </div>
</div>
<div class="col-xxl-3 col-xl-6">
    <div class="card h-100 radius-8 border">
        <div class="card-body p-24">
            <h6 class="mb-12 fw-semibold text-lg mb-16">Total Subscriber</h6>
            <div class="d-flex align-items-center gap-2 mb-20">
                <h6 class="fw-semibold mb-0">5,000</h6>
                <p class="text-sm mb-0">
                    <span class="bg-danger-focus border br-danger px-8 py-2 rounded-pill fw-semibold text-danger-main text-sm d-inline-flex align-items-center gap-1">
                        10%
                        <iconify-icon icon="iconamoon:arrow-down-2-fill" class="icon"></iconify-icon>
                    </span>
                    - 20 Per Day
                </p>
            </div>

            <div id="barChart"></div>

        </div>
    </div>
</div>
<div class="col-xxl-3 col-xl-6">
    <div class="card h-100 radius-8 border-0 overflow-hidden">
        <div class="card-body p-24">
            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                <h6 class="mb-2 fw-bold text-lg">Users Overview</h6>
                <div class="">
                    <select class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                        <option>Today</option>
                        <option>Weekly</option>
                        <option>Monthly</option>
                        <option>Yearly</option>
                    </select>
                </div>
            </div>


            <div id="userOverviewDonutChart"></div>

            <ul class="d-flex flex-wrap align-items-center justify-content-between mt-3 gap-3">
                <li class="d-flex align-items-center gap-2">
                    <span class="w-12-px h-12-px radius-2 bg-primary-600"></span>
                    <span class="text-secondary-light text-sm fw-normal">New:
                        <span class="text-primary-light fw-semibold">500</span>
                    </span>
                </li>
                <li class="d-flex align-items-center gap-2">
                    <span class="w-12-px h-12-px radius-2 bg-yellow"></span>
                    <span class="text-secondary-light text-sm fw-normal">Subscribed:
                        <span class="text-primary-light fw-semibold">300</span>
                    </span>
                </li>
            </ul>

        </div>
    </div>
</div>
