<x-app-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div class="container">
                <div class="row justify-content-center">

                    @include('_error')
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">{{ __('Modifier une station essence') }}</div>
                            <form method="POST" action="{{ route('pointer.update', $pointer) }}" accept-charset="UTF-8">
                                @csrf {{ method_field('patch') }}
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-2">{{ __('Nom') }}</label>
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name', $pointer->name) }}" required>
                                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="address" class="control-label mb-2">{{ __('Adresse') }}</label>
                                        <input type="text" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" placeholder="{{ old('address', $pointer->address) }}" />
                                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="latitude" class="control-label mb-2">{{ __('Latitude') }}</label>
                                                <input id="latitude" type="text" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', $pointer->latitude) }}" required>
                                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mt-3">
                                                <label for="longitude" class="control-label mb-2">{{ __('Longitude') }}</label>
                                                <input id="longitude" type="text" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', $pointer->longitude) }}" required>
                                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right py-3">
                                    <a href="{{ route('dashboard', $pointer) }}" class="btn btn-link text-decoration-none">{{ __('Annuler') }}</a>
                                    <input type="submit" value="{{ __('Mettre à jour') }}" class="btn btn-primary">
                                    @can('delete', $pointer)
                                        <a href="{{ route('pointer.edit', [$pointer, 'action' => 'delete']) }}" id="del-pointer-{{ $pointer->id }}" class="btn btn-danger float-right">{{ __('app.delete') }}</a>
                                    @endcan
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>