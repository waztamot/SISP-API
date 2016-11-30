<?php

namespace Modules\Product\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequisitionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'combo_id' => 'required|exists:combos,id', 
            'type_combo' => 'required|in:Estatico,Dinamico,SubCombo-Estatico,SubCombo-Dinamico',     //Modificar a tabla
            'products' => 'required',
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required',
            'lapse_id' => 'required|exists:combo_lapses,id',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        if ($user->hasRole('admin') || $user->can(['product.requested'])) {
            return true;
        } else {
            return false;
        }
    }
}
