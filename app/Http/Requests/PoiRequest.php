<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PoiRequest extends Request
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

            //'name'                  =>'required',
            //'nationality'           =>'required|not_in:0',
            //'document_type'         =>'required|not_in:0'
           /* 'id_number'             =>'digits:13',*/
          /*  'language'              =>'required|not_in:0',
            'has_driver_licence'    =>'required|not_in:0'*/
            
        ];
    }
}
