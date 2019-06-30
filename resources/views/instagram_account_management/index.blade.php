@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Edit Instagram Profiles') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('accounts.create') }}" class="btn btn-sm btn-primary">{{ __('Add profile') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Instagram Account') }}</th>
                                    <th scope="col">{{ __('Followers') }}</th>
                                    <!--th scope="col">{{ __('Creation Date') }}</th-->
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($accounts as $account)
                                    <tr>
                                        <td>{{ $account->full_name }} ({{$account->username}})</td>
                                        <td>{{ $account->followers }}</td>
                                        <td class="text-right">
                                            <a class="btn-lg" href="/accounts/{{ $account->id }}/edit"><i class="fas fa-cogs"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $accounts->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
            
        @include('layouts.footers.auth')
    </div>
@endsection