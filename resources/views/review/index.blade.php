@extends('layouts.app', ['title' => __('page.review')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">


        <div class="row">
            @if($post == null)
                <div class="col">

                    <div class="card shadow">
                        <div class="card-body text-center">
                            <h1 class="display-2 text-muted text-capitalize my-5 py-5">
                                No posts remaining.
                            </h1>
                        </div>
                    </div>
                </div>
            @else
                <div class="col">

                    <div class="card shadow">
                        <div class="card-body">
                            <p>
                                <i class="fa fa-user text-primary"></i>
                                {{$post->account->full_name ?? '-'}} ({{$post->account->username ?? '-'}})
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
                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                <textarea class="form-control form-control" rows="3" placeholder="Post description ..." name="description">{{$description}}</textarea>

                                <div class="text-right">
                                    <div>
                                        <button class="btn btn-primary mt-3">
                                            <i class="fas fa-share"></i>
                                            Enqueue
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <a href="review/{{$post->id}}/reject" class="btn btn-outline-danger"><i class="fa fa-times"></i> Reject</a>
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
            @endif

        </div>

        @include('layouts.footers.auth')
    </div>
@endsection