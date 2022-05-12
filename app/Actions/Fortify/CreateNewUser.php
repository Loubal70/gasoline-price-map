<?php

namespace App\Actions\Fortify;

use App\Models\Team;
use App\Models\User;
use Laravel\Jetstream\Jetstream;
use App\Mail\WelcomeMarkdownMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'prenom'    => ['required', 'string', 'max:255'],
            'nom'       => ['required', 'string', 'max:255'],
            'username'  => ['required', 'unique:users', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ],
        [
            'username.required'     =>  'Un nom d\'utilisateur est obligatoire',
            'username.string'       =>  'Votre nom d\'utilisateur doit être une chaine de caractères',
            'username.max'          =>  'Votre nom d\'utilisateur ne peut pas dépasser 255 caractères',
            'username.unique'       =>  'Votre nom d\'utilisateur est déjà utilisé',

            'email.required'        =>  'Un email est obligatoire',
            'email.string'          =>  'Votre email doit être une chaine de caractères',
            'email.email'           =>  'Votre email doit être une adresse email valide',
            'email.max'             =>  'Votre email ne peut pas dépasser 255 caractères',
            'email.unique'          =>  'Votre email est déjà utilisé',
            
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'prenom'    => $input['prenom'],
                'nom'       => $input['nom'],
                'username'  => $input['username'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
            ]), function (User $user) {
                $this->createTeam($user);
                Mail::to($user['email'])->send(new WelcomeMarkdownMail());
            });
        });

    }

    /**
     * Create a personal team for the user.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    protected function createTeam(User $user)
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
