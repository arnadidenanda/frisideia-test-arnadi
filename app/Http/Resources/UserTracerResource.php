<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTracerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public static $wrap = null;
    public function toArray($request)
    {
        return [
            'gpa' => $this->gpa,
            'nim' => $this->nim,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'degree_id' => $this->degree_id,
            'school_id' => $this->school_id,
            'user_id' => $this->user_id,
            'major_id' => $this->major_id,
            
            'school' => [
                'name' => $this->school_name,
                'phone' => $this->school_phone,
                'email' => $this->school_email,
                'fax' => $this->school_fax,
                'address' => $this->school_address,
                'website' => $this->school_website,
                'logo' => $this->school_logo,
                'postal_code' => $this->school_postal_code,
                'about' => $this->school_about,
                'mission' => $this->school_mission,
                'vision' => $this->school_vision
            ],

            'major' => [
                'name' => $this->major_name,
                'translation' => $this->major_translation
            ],

            'degree' => [
                'name' => $this->degree_name,
                'translation' => $this->degree_translation
            ],

            'tracer_study' => [
                'school_id' => $this->school_id,
                'name' => $this->tracer_name,
                'description' => $this->tracer_description,
                'target_start' => $this->tracer_target_start,
                'target_end' => $this->tracer_target_end,
                'publication_start' => $this->tracer_publication_start,
                'publication_end' => $this->tracer_publication_end,
            ]

        ];
    }
}
