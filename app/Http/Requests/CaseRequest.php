<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CaseRequest extends Request
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

            'title'         =>'required|not_in:0',
            'priority'      =>'required|not_in:0',
            'name'          =>'required',
            'surname'       =>'required',
            'description'   =>'required',
            'language'      =>'required|not_in:0',
            'cellphone'     =>'required|not_in:0|digits:10|unique:users,cellphone',
            'email'         =>'email|unique:users,email',
            'province'      =>'required|not_in:0',
            'district'      =>'required|not_in:0',
            'position'      =>'required|not_in:0',
            'municipality'  =>'required|not_in:0',
            'ward'          =>'required|not_in:0',
            'position'      =>'required|not_in:0',
            'gender'        =>'required|not_in:0',
            'id_number'     =>'digits:13',
        ];
    }
}
