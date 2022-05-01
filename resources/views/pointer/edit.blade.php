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
                                        <input type="text" id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" placeholder="{{ old('address', $pointer->address) }}" value="{{ old('address', $pointer->address) }}" />
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

                                    {{-- Essence --}}

                                    <div class="row mt-3">
                                        {{-- SP95 --}}
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div for="price" class="control-label mb-2 font-weight-bold">{{ __('Prix') }}</div>
                                                <div class="cards__essence">

                                                    <div class="card__essence">
                                                        <img src="{{url('/images/station.svg')}}" width="30" alt="Picto Station Essence">
                                                        <div class="card__essence__content">
                                                            <label for="price_sp95" class="card__essence__title">SP95</label>
                                                            <input id="price_sp95" type="text" class="form-control{{ $errors->has('price_sp95') ? ' is-invalid' : '' }}" name="price_sp95" value="{{ old('SP95', $pointer->SP95) }}" placeholder="{{ old('SP95', $pointer->SP95) ? '' : 'Non définie' }}">
                                                            {!! $errors->first('price_sp95', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="card__essence">
                                                        <img src="{{url('/images/station.svg')}}" width="30" alt="Picto Station Essence">
                                                        <div class="card__essence__content">
                                                            <label for="price_e85" class="card__essence__title">E85</label>
                                                            <input id="price_e85" type="text" class="form-control{{ $errors->has('price_e85') ? ' is-invalid' : '' }}" name="price_e85" value="{{ old('E85', $pointer->E85) }}" placeholder="{{ old('E85', $pointer->E85) ? '' : 'Non définie' }}">
                                                            {!! $errors->first('price_e85', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                                        </div>
                                                    </div>

                                                    <div class="card__essence">
                                                        <img src="{{url('/images/station.svg')}}" width="30" alt="Picto Station Essence">
                                                        <div class="card__essence__content">
                                                            <label for="price_sp98" class="card__essence__title">SP98</label>
                                                            <input id="price_sp98" type="text" class="form-control{{ $errors->has('price_sp98') ? ' is-invalid' : '' }}" name="price_sp98" value="{{ old('SP98', $pointer->SP98) }}" placeholder="{{ old('SP98', $pointer->SP98) ? '' : 'Non définie' }}">
                                                            {!! $errors->first('price_sp98', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="card__essence">
                                                        <img src="{{url('/images/station.svg')}}" width="30" alt="Picto Station Essence">
                                                        <div class="card__essence__content">
                                                            <label for="price_gazole" class="card__essence__title">Gazole</label>
                                                            <input id="price_gazole" type="text" class="form-control{{ $errors->has('price_gazole') ? ' is-invalid' : '' }}" name="price_gazole" value="{{ old('Gazoil', $pointer->Gazoil) }}" placeholder="{{ old('Gazoil', $pointer->Gazoil) ? '' : 'Non définie' }}">
                                                            {!! $errors->first('price_gazole', '<span class="invalid-feedback" role="alert">:message</span>') !!}
                                                        </div>
                                                    </div>
                                                    
                                                </div>
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