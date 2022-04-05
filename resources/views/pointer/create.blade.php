<x-app-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div class="container">
                <div class="row justify-content-center">

                    @include('_errors')
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">{{ __('Ajouter une station essence') }}</div>
                            
                            <form method="POST" action="{{ route('pointer.store') }}" accept-charset="UTF-8">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name" class="control-label mb-2">{{ __('Nom') }}</label>
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                                        {!! $errors->first('name', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="form-group mt-2">
                                        <label for="address" class="control-label mb-2">{{ __('Adresse') }}</label>
                                        <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" rows="4">{{ old('address') }}</textarea>
                                        {!! $errors->first('address', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="latitude" class="control-label mb-2">{{ __('Latitude') }}</label>
                                                <input id="latitude" type="text" value="{{ $_GET['lat'] ?? '' }}" class="form-control{{ $errors->has('latitude') ? ' is-invalid' : '' }}" name="latitude" value="{{ old('latitude', request('latitude')) }}" required>
                                                {!! $errors->first('latitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="longitude" class="control-label mb-2">{{ __('Longitude') }}</label>
                                                <input id="longitude" type="text" value="{{ $_GET['lont'] ?? '' }}" class="form-control{{ $errors->has('longitude') ? ' is-invalid' : '' }}" name="longitude" value="{{ old('longitude', request('longitude')) }}" required>
                                                {!! $errors->first('longitude', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div id="mapid"></div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="{{ route('pointer.index') }}" class="btn btn-link text-decoration-none">{{ __('Annuler') }}</a>
                                    <input type="submit" value="{{ __('Ajouter une station service') }}" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
