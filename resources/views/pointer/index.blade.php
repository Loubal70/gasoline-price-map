<x-app-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <form method="GET" action="" accept-charset="UTF-8" class="form-inline">
                                    <div class="form-group">
                                        <label for="q" class="control-label">{{ __('Rechercher') }}</label>
                                        <input placeholder="{{ __('Nom station proche de chez vous') }}" name="q" type="text" id="q" class="form-control my-2" value="{{ request('q') }}">
                                    </div>
                                    <input type="submit" value="{{ __('Rechercher') }}" class="btn btn-secondary">
                                    <a href="{{ route('pointer.index') }}" class="btn btn-link">{{ __('Réinitialiser') }}</a>
                                </form>
                            </div>
                            <table class="table table-sm table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th class="text-center py-3">{{ __('Nom') }}</th>
                                        <th class="text-center py-3">{{ __('Adresse') }}</th>
                                        <th class="text-center py-3">{{ __('Latitude') }}</th>
                                        <th class="text-center py-3">{{ __('Longitude') }}</th>
                                        <th class="text-center py-3">{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pointers as $key => $outlet)
                                    <tr>
                                        <td class="text-center">{{ $pointers->firstItem() + $key }}</td>
                                        <td>{!! $outlet->name_link !!}</td>
                                        <td>{{ $outlet->address }}</td>
                                        <td>{{ $outlet->latitude }}</td>
                                        <td>{{ $outlet->longitude }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('pointers.show', $outlet) }}" id="show-outlet-{{ $outlet->id }}">{{ __('app.show') }}</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="card-body">{{ $pointers->appends(Request::except('page'))->render() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
