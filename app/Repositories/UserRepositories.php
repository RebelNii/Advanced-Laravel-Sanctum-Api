<?php


namespace App\Repositories;

use App\Events\Models\User\UserEvent;
use App\Exceptions\GeneralException;
use App\Mail\WelcomeMail;
use App\Models\User;
use App\Repositories\BaseRepositories;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserRepositories extends BaseRepositories
{
    public function create(array $attributes){

        return DB::transaction(function () use($attributes) {
            $user = [
                'name' => data_get($attributes, 'name'),
                'email' => data_get($attributes, 'email'),
                'password' => Hash::make(data_get($attributes,'password'))
            ];
    
            $created = User::create($user);

            // event(new UserEvent($created));

            Mail::to($created)->later(now()->addMinutes(3), new WelcomeMail($created));

            throw_if(!$created, GeneralException::class,'Failed');

            return $created;
        });
        // $user = [
        //     'name' => data_get($attributes, 'name'),
        //     'email' => data_get($attributes, 'email'),
        //     'password' => Hash::make(data_get($attributes,'password'))
        // ];

        // $created = User::create($user);

        // throw_if(!$created, GeneralException::class,'Failed');

        // return $created;
    }

    /**
     * @param User $user
     */
    public function update($user, $attributes){
        return DB::transaction(function() use($user, $attributes){
            $owner = [
                'name' => data_get($attributes, 'name', $user->name),
                'email' => data_get($attributes, 'email', $user->email),
            ];

            $updated = $user->update($owner);

            throw_if(!$updated, GeneralException::class, 'Failed');

            return $updated;
        });
    }

    public function delete($user){
        return DB::transaction(function() use($user){
            $del = $user->forceDelete();
            throw_if(!$del, GeneralException::class, 'Failed');

            return $del;
        });
    }
}