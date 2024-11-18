<div class="counter-area mb-5">
    <div class="container">
        <div class="counter-wrapper mb-0">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/icon/taxi-1.svg') }}" alt>
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="{{ FrontHelper::getCompletedTripsTotal() }}" data-speed="3000">{{ FrontHelper::getCompletedTripsTotal() }}</span>
                            <h6 class="title">+ Trajets Effectués</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/icon/driver.svg') }}" alt>
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="{{ FrontHelper::getDriverUsersTotal() }}" data-speed="3000">{{ FrontHelper::getDriverUsersTotal() }}</span>
                            <h6 class="title">+ Conducteurs Partenaires</h6>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/icon/happy.svg') }}" alt>
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="{{ FrontHelper::getSatisfiedClientsTotal() }}" data-speed="3000">{{ FrontHelper::getSatisfiedClientsTotal() }}</span>
                            <h6 class="title">+ Clients Satisfaits</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-sm-6">
                    <div class="counter-box">
                        <div class="icon">
                            <img src="{{ asset(FrontHelper::getEnvFolder() . 'storage/front/assets/img/icon/trip.svg') }}" alt>
                        </div>
                        <div>
                            <span class="counter" data-count="+" data-to="{{ FrontHelper::getTotalReservationsWithoutIssues() }}" data-speed="3000">{{ FrontHelper::getTotalReservationsWithoutIssues() }}</span>
                            <h6 class="title">+ Réservations</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
