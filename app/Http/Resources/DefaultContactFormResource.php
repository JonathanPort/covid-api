<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DefaultContactFormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'full_name' => $this->full_name,
            'email' => $this->email,
            'subject' => $this->subject,
            'message' => $this->message,
            'submitted_on' => [
                'days_ago' => $this->created_at->diffForHumans(),
                'time' => $this->created_at,
            ],
        ];
    }
}
