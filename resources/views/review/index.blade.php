@extends('layouts.app', ['title' => __('page.review')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <p>
                            <i class="fa fa-user text-primary"></i>
                            {{$post->account->full_name}} ({{$post->account->username}})
                        </p>
                        <p>
                            <i class="fa fa-heart text-danger"></i>
                            {{$post->likes}}
                        </p>
                        <p class="text-muted">
                            {{$post->description}}
                        </p>
                        <hr>
                        <form action="schedule" method="post">
                            @csrf
                            <textarea class="form-control form-control" rows="3" placeholder="Post description ...">{{$description}}</textarea>

                            <div class="text-right">
                                <div>
                                    <button class="btn btn-primary mt-3">
                                        <i class="fas fa-share"></i>
                                        Enqueue
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow">
                    <div class="p-2">
                        <img src="{{$post->img_src}}" alt="" width="100%">
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection