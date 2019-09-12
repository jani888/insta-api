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

                <div class="card shadow">
                    <div class="card-body">
                        <div class="tab-content" id="account-settings-tabs">
                            <div class="tab-pane fade show active" id="tabs-icons-text-summary-tab" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                <h1>Quick overview of this account</h1>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-hashtags-tab" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                <h1>Here can you add related hashtags to this account</h1>
                                <table class="table">
                                    <thead>
                                        <th>Hashtag</th>
                                    </thead>
                                    <tbody>
                                        @foreach($account->hashtags as $hashtag)
                                            <tr>
                                                <td>#{{$hashtag->name}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row px-3">
                                    <button type="button" class="btn-block btn btn-primary" data-toggle="modal" data-target="#addHashtagModal">
                                        Add hashtag
                                    </button>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="tabs-icons-text-settings-tab" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                                @include('instagram_account_management.settings')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="addHashtagModal" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                <div class="modal-content">
                    <form action="{{ route('account.hashtag') }}" method="post">
                        @csrf
                        <div class="modal-header">
                            <h3 class="modal-title" id="modal-title-default">Add hashtag</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input class="form-control form-control-alternative" name="hashtag" placeholder="hashtag" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary ml-auto">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection