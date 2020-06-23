<form method="POST" action="{{ route($url) }}">
    @csrf

    <div class="form-group row">
        <label for="nit" class="col-md-4 col-form-label text-md-right">Identificación</label>

        <div class="col-md-6">
            <input class="form-control" value="{{ $user->nit }}" autocomplete="nit" autofocus readonly>
            <input type="hidden" name="id" value="{{ $user->id }}" readonly>
        </div>

    </div>

    <div class="form-group row">
        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name',$user->name) }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="surname" class="col-md-4 col-form-label text-md-right">Apellidos</label>

        <div class="col-md-6">
            <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname', $user->surname) }}" required autocomplete="surname" autofocus>

            @error('surname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row">
        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email',$user->email) }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                Actualizar
            </button>
        </div>
    </div>
</form>