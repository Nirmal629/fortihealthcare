<?php

namespace App\Http\Requests\Frontend;

use App\Http\Requests\BaseRequest;
use Illuminate\Support\Facades\Auth;


class ContactUsRequest extends BaseRequest
{
  public function rules(): array
  {
    $rules = [
      'first_name' => 'required_without:name|nullable|string|max:255',
      'last_name' => 'nullable|string|max:255',
      'name' => 'required_without:first_name|nullable|string|max:255',
      'email' => 'required|email|max:255',
      'phone' => 'nullable|string|max:50',
      'message' => 'required|string|min:5|max:2000',
    ];

    if ($this->has('captcha')) {
      $rules['captcha'] = 'required|captcha';
    }

    return $rules;
  }

  public function messages(): array
  {
    return [
      'first_name.required_without' => __('validation.required', ['attribute' => 'First Name']),
      'first_name.max' => __('validation.maxlength', ['attribute' => 'First Name', 'max' => 255]),
      'name.required_without' => __('validation.required', ['attribute' => 'Name']),
      'name.max' => __('validation.maxlength', ['attribute' => 'Name', 'max' => 255]),
      'last_name.max' => __('validation.maxlength', ['attribute' => 'Last Name', 'max' => 255]),
      'email.required' => __('validation.required', ['attribute' => 'Email']),
      'email.email' => __('validation.email', ['attribute' => 'Email']),
      'email.max' => __('validation.maxlength', ['attribute' => 'Email', 'max' => 255]),
      'phone.max' => __('validation.maxlength', ['attribute' => 'Phone', 'max' => 50]),
      'message.required' => __('validation.required', ['attribute' => 'Message']),
      'message.min' => __('validation.minlength', ['attribute' => 'Message', 'min' => 5]),
      'message.max' => __('validation.maxlength', ['attribute' => 'Message', 'max' => 2000]),
      'captcha.required' => __('validation.required', ['attribute' => 'Captcha']),
      'captcha.captcha' => __('validation.invalid', ['attribute' => 'Captcha']),
    ];
  }

  protected function prepareForValidation()
  {
    // Sanitize message and input fields before validation
    $this->merge([
      'message' => strip_tags((string) $this->input('message')),
      'name' => strip_tags((string) $this->input('name')),
      'first_name' => strip_tags((string) $this->input('first_name')),
      'last_name' => strip_tags((string) $this->input('last_name')),
      'phone' => strip_tags((string) $this->input('phone')),
    ]);
  }
}
