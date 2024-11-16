<div class="col-xxl-6 col-xl-12">
    <div class="card h-100 radius-8 border-0">
        <div class="card-body p-24">
            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                <h6 class="mb-2 fw-bold text-lg">Réservations</h6>



                <select id="periodSelect"
                    class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                    <option value="yearly">Annuel</option>
                    <option value="monthly">Mensuel</option>
                    <option value="weekly" selected>Hebdomadaire</option>
                    <option value="today">Aujourd'hui</option>
                </select>
            </div>



            <div id="commission-summary" class="d-flex align-items-center gap-2">
                <h6 class="fw-semibold mb-0" id="total-booking">O </h6>
                <p class="text-sm mb-0 d-flex align-items-center gap-1">
                    Total des reservations
                </p>
            </div>

            <canvas id="bookingsChart"></canvas>

        </div>
    </div>
</div>

<div class="col-xxl-3 col-xl-12">
    <div class="card h-100 radius-8 border-0">
        <div class="card-body p-24">
            <div class="d-flex align-items-center flex-wrap gap-2 justify-content-between">
                <h6 class="mb-2 fw-bold text-lg">Trajets</h6>



                <select id="periodSelectride"
                    class="form-select form-select-sm w-auto bg-base border text-secondary-light">
                    <option value="yearly">Annuel</option>
                    <option value="monthly">Mensuel</option>
                    <option value="weekly" selected>Hebdomadaire</option>
                    <option value="today">Aujourd'hui</option>
                </select>


            </div>

            <div id="commission-summary" class="d-flex align-items-center gap-2">
                <h6 class="fw-semibold mb-0" id="total-ride">O </h6>
                <p class="text-sm mb-0 d-flex align-items-center gap-1">
                    Total des trajets
                </p>
            </div>

            <canvas id="rideChart"></canvas>

        </div>
    </div>
</div>

