<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserStoreRequest;
use App\Http\Resources\V1\UserResource;
use App\Models\User;
use App\Repositories\UserRepositories;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

/**
 * @group User Management
 * 
 * APIs used to manage user resource
 */

class UserController extends Controller
{
    /**
     * Display list of users.
     * 
     * Get list of users.
     * 
     * @queryParam page_size int Size per page. Default to 10.
     * 
     * @apiResourceCollection App\Http\Resources\V1\UserResource
     * @apiResourceModel App\Models\User
     * 
     * @return ResourceCollection
     */
    public function index(Request $request){
        return UserResource::collection(User::query()->paginate($request->page_size ?? 10));
    }

    /**
     * Create a new user.
     * 
     * @bodyParam name string required Name of the user. Example: John Doe
     * @bodyParam email string required email of the user. Example: JohnDoe@gmail.com
     * @bodyParam password string required password of the user.
     * 
     * @apiResource App\Http\Resources\V1\UserResource
     * @apiResourceModel App\Models\User
     * 
     * @return UserResource
     */
    public function store(UserStoreRequest $request,UserRepositories $repositories){
        // $user = $request->validate([
        //     'name' => ['required','min:3'],
        //     'email' => ['required', Rule::unique('users','email')],
        //     'password' => ['required','min:6']
        // ]);
        $account = $repositories->create($request->only([
            'name', 'email'
        ]));

        // $user['password'] = Hash::make($user['password']);

        // $account = User::query()->create($user);

        // throw_if(!$account, GeneralException::class,('Failed'));

        return new UserResource($account);
    }

    /**
     * Display specific user.
     * 
     * @apiResource App\Http\Resources\V1\UserResource
     * @apiResourceModel App\Models\User
     * 
     * @urlParam user int required User ID
     * 
     * @return UserResource
     */
    public function show(User $user){
        return new UserResource($user);
    }

    /**
     * Update user.
     * 
     * @bodyParam name string Name of the user. Example: John Doe
     * @bodyParam email string Email of the user. Example: JohnDoe@gmail.com
     * 
     * @apiResource App\Http\Resources\V1\UserResource
     * @apiResourceModel App\Models\User
     * 
     * @return UserResource
     */
    public function update(Request $request,User $user, UserRepositories $repository)
    {
        $account = $repository->update($user, $request->all());
        
        return new UserResource($account);
    }


    /**
     * Delete User
     * 
     * @response {
     * "success" : "Deleted"
     * }
     */
    public function destroy(User $user, UserRepositories $repository)
    {
        $account = $repository->delete($user);

        return new JsonResponse([
            'success' => 'deleted'
        ]);
    }
}
