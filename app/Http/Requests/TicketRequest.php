<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {

        $rules = [
            'type' => '',
            // 'place' => 'required|numeric|unique:place|min:1|max:150',
            // 'place' => 'numeric|unique:place|min:1|max:150',
            'place' => 'numeric|min:1|max:150',
            // 'description' => '',
            'fio' => 'required',
            // 'minPlayers' => 'required|min:1|max:10',
            // 'maxPlayers' => 'required|min:1|max:10',
            // 'isActive' => 'required|boolean'
            'sell_type' => '',
            'return_ticket' => ''
        ];

        switch ($this->getMethod()) {
            
            case 'POST':
                return $rules;
                
        }

        return [
                //
        ];
    }

}
