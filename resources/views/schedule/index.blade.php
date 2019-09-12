@extends('layouts.app', ['title' => __('page.schedule')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Enqueued successfully! Will be posted {{ session('post_at') }}.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        <div class="col-xs-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Schedule</h4>
                </div>
                <div class="card-content">
                    <table class="table">
                        <thead>
                            <th></th>
                            <th>Description</th>
                            <th>Post at</th>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                                <tr>
                                    <td>
                                        <img height="50" src="{{$post->instagramPost->img_src}}" alt="">
                                    </td>
                                    <td>
                                        {{Str::limit($post->description, 50)}}
                                    </td>
                                    <td>
                                        {{$post->schedule->post_at->diffForHumans(null, 2, false, 2)}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection