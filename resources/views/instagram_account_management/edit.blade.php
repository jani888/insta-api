@extends('layouts.app', ['title' => __('User Profile')])

@section('content')
    @include('instagram_account_management.partials.header', [
        'title' => $account->full_name,
        'description' => "",
        'class' => 'col-lg-12'
    ])

    <div class="container-fluid mt--7">
        <div class="row">

            @include('instagram_account_management.account_info')

            <div class="col-xl-8 order-xl-1">
                <div class="card bg-secondary shadow mb-4 p-2">
                    <div class="nav-wrapper">
                        <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tabs-icons-text-summary-button" data-toggle="tab" href="#tabs-icons-text-summary-tab" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="far fa-chart-bar mr-2"></i>Summary</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-icons-text-hashtags-button" data-toggle="tab" href="#tabs-icons-text-hashtags-tab" role="tab" aria-controls="tabs-icons-text-hashtags-tab" aria-selected="false"><i class="fas fa-hashtag mr-2"></i>Hashtags</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tabs-icons-text-settings-button" data-toggle="tab" href="#tabs-icons-text-settings-tab" role="tab" aria-controls="tabs-icons-text-settings" aria-selected="false"><i class="fas fa-cogs mr-2"></i>Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="account-settings-tabs">
                            <div class="tab-pane fade show active" id="tabs-icons-text-summary-tab" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <h1>Quick overview of this account</h1>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-hashtags-tab" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                <h1>Here can you add related hashtags to this account</h1>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-settings-tab" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                @include('instagram_account_management.settings')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection