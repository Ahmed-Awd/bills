<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "slug"=>$this->slug,
            "name"=>$this->name,
            "email"=>$this->email,
        ];
    }
}
