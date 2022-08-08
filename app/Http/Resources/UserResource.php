<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) : array
    {
//          UserController
//        $users = UserResource::collection(User::orderBy('user_id', 'desc')->paginate($recordsPerPage))->toArray($request);
//        var_dump($users);
        return [
            'user_id' => $this->user_id,
            'email' => $this->email,
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
        ];
    }
}
