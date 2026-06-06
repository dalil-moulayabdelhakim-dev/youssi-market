<?php

namespace App\Actions\Fortify;

use App\Models\Store;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string', 'min:10'],
            'user_type' => ['required', 'max:1'],
            'wilaya_id' => ['required', 'exists:wilayas,id'],
            'commune_id' => ['required', 'exists:communes,id'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user_type = $input['user_type'];
        $store_is = null;

        if ($user_type == '2') {
            Validator::make($input, [
                'store_name' => ['required_if:user_type,2', 'string', 'max:255'],
                'store_category' => ['required_if:user_type,2', 'string', 'max:255'],
                'store_address' => ['required_if:user_type,2', 'string', 'max:255'],
                'store_contact' => ['required_if:user_type,2', 'string', 'max:255'],
            ])->validate();

            $adminInfo = \App\Models\AdministrativeInformation::first();
            $defaultCommission = $adminInfo && isset($adminInfo->default_commission_rate) ? $adminInfo->default_commission_rate : 3.00;

            $store = Store::create([
                'name' => $input['store_name'],
                'category' => $input['store_category'],
                'address' => $input['store_address'],
                'contact' => $input['store_contact'],
                'trial_ends_at' => Carbon::now()->addMonth(),
                'commission_rate' => $defaultCommission,
            ]);

            $store_is = $store->id;
        }

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone' => $input['phone'],
            'user_type_id' => $user_type,
            'store_id' => $store_is,
            'address' => $input['address'] ?? null,
            'wilaya_id' => $input['wilaya_id'],
            'commune_id' => $input['commune_id'],
            'password' => Hash::make($input['password']),
        ]);
    }

}
