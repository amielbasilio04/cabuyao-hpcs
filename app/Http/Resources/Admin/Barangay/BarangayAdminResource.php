<?php

namespace App\Http\Resources\Admin\Barangay;

use Illuminate\Http\Resources\Json\JsonResource;

class BarangayAdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'fname' => $this->resident->fname,
            'mname' => $this->resident->mname,
            'lname' => $this->resident->lname,
            'gender' => $this->resident->gender,
            'barangay_id' => $this->barangay_id,
            'barangay' => $this->barangay->name,
            'is_activated' => $this->is_activated,
            'avatar' => $this->user_avatar,
            'created_at' => $this->created_at
        ];
    }
}
