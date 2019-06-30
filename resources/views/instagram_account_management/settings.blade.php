<h1 class="mb-2">{{ __('Edit Profile') }}</h1>
<form method="post" action="{{ route('profile.update') }}" autocomplete="off">
    @csrf
    @method('put')

    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('status') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="pl-lg-4">
        <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
            <input type="text" name="name" id="input-name" class="form-control form-control-alternative{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
            @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
            <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
            <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required>

            @if ($errors->has('email'))
                <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
            @endif
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
        </div>
    </div>
</form>