@extends('back.layouts.master')
@section('title', 'Paramétres des apis ')
@section('content')


    <div class="row gy-4">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Formulaire de Paramètres API</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('apis.update', $api) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row gy-3">
                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="maps">
                                    Api maps
                                </label>
                                <input type="text" class="form-control" id="maps" name="maps" value="{{ old('maps', $api->maps) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="feedpay_public">
                                    Clé publique FeedPay
                                </label>
                                <input type="text" class="form-control" id="feedpay_public" name="feedpay_public" value="{{ old('feedpay_public', $api->feedpay_public) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="feedpay_private">
                                    Clé privée FeedPay
                                </label>
                                <input type="text" class="form-control" id="feedpay_private" name="feedpay_private" value="{{ old('feedpay_private', $api->feedpay_private) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="feedpay_secret">
                                    Secret FeedPay
                                </label>
                                <input type="text" class="form-control" id="feedpay_secret" name="feedpay_secret" value="{{ old('feedpay_secret', $api->feedpay_secret) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="kkiapay_public">
                                    Clé publique Kkiapay
                                </label>
                                <input type="text" class="form-control" id="kkiapay_public" name="kkiapay_public" value="{{ old('kkiapay_public', $api->kkiapay_public) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="kkiapay_private">
                                    Clé privée Kkiapay
                                </label>
                                <input type="text" class="form-control" id="kkiapay_private" name="kkiapay_private" value="{{ old('kkiapay_private', $api->kkiapay_private) }}">
                            </div>

                            <div class="col-12 d-flex">
                                <label class="form-label col-3" for="kkiapay_secret">
                                    Secret Kkiapay
                                </label>
                                <input type="text" class="form-control" id="kkiapay_secret" name="kkiapay_secret" value="{{ old('kkiapay_secret', $api->kkiapay_secret) }}">
                            </div>

                            <div class="col-12 text-end">
                                <button type="submit" class="btn btn-primary-600">Modifier</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
