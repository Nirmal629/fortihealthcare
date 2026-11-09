<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\BaseRequest;
use Vinkla\Hashids\Facades\Hashids;

class UpdateUserAddressRequest extends BaseRequest
{
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    if ($this->has('id') && !empty($this->get('id'))) {
      $this->merge(['id' => Hashids::decode($this->get('id'))[0] ?? null]);
    }

    if ($this->has('state') && !empty($this->get('state'))) {
      $this->merge(['state' => Hashids::decode($this->get('state'))[0] ?? null]);
    }

    return [
      'id' => 'nullable|exists:addresses,id',
      'state' => 'required|exists:states,id',
      'pincode' => ['required', 'string', 'regex:/^[1-9][0-9]{5}$/'],
      'address' => 'required|string|max:255',
      'landmark' => 'required|string|max:200',
      'name' => 'required|string|max:50',
      'phone' => 'required|string',
      'city' => 'required|string|max:40',
    ];
  }

  /**
   * Get custom messages for validator errors.
   *
   * @return array
   */
  public function messages()
  {
    return [
      'id.exists' => __('validation.exists', ['attribute' => 'Address ID']),

      'state.required' => __('validation.required', ['attribute' => 'State']),
      'state.exists' => __('validation.exists', ['attribute' => 'State']),

      'pincode.required' => __('validation.required', ['attribute' => 'Pincode']),
      'pincode.string' => __('validation.string', ['attribute' => 'Pincode']),
      'pincode.regex' => 'This is a PAN india company, deliveries restricted to India Only',

      'address.required' => __('validation.required', ['attribute' => 'Address']),
      'address.string' => __('validation.string', ['attribute' => 'Address']),
      'address.max' => __('validation.max', ['attribute' => 'Address', 'max' => 255]),

      'landmark.required' => __('validation.required', ['attribute' => 'Landmark']),
      'landmark.string' => __('validation.string', ['attribute' => 'Landmark']),
      'landmark.max' => __('validation.max', ['attribute' => 'Landmark', 'max' => 200]),

      'name.required' => __('validation.required', ['attribute' => 'Name']),
      'name.string' => __('validation.string', ['attribute' => 'Name']),
      'name.max' => __('validation.max', ['attribute' => 'Name', 'max' => 50]),

      'phone.required' => __('validation.required', ['attribute' => 'Phone']),
      'phone.string' => __('validation.string', ['attribute' => 'Phone']),

      'city.required' => __('validation.required', ['attribute' => 'City']),
      'city.string' => __('validation.string', ['attribute' => 'City']),
      'city.max' => __('validation.max', ['attribute' => 'City', 'max' => 40]),
    ];
  }
}
