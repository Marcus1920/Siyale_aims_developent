<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateCaseAgentRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       return [

            'case_type'      =>'required|not_in:0',
            'case_sub_type'  =>'required|not_in:0'
            
        ];
    }
}
