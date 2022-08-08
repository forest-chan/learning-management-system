<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class UserCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request) : array
    {
        return [
            'user_id' => $this->user_id,
            'email' => $this->email,
            'surname' => $this->surname,
            'name' => $this->name,
            'patronymic' => $this->patronymic,
        ];
    }
}
