<x-guest-layout>
    <div class="pt-4 bg-gray-100">
        <div class="min-h-screen flex flex-col items-center pt-6 sm:pt-0">
            <div>
                <x-jet-authentication-card-logo />
            </div>

            <div class="w-full sm:max-w-2xl mt-6 p-6 bg-white shadow-md overflow-hidden sm:rounded-lg prose text-center">
                <div>Vous vous êtes perdu ?</div> Aller retournons vers la page d'accueil.
                <a class="block no-underline mt-5 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" href="{{ route('dashboard') }}">Retourner à la page d'accueil</a>
            </div>
        </div>
    </div>
</x-guest-layout>
