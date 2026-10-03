@extends('emails.frontend.includes.layout')

@section('content')
  <tr>
    <td style="width:80px"></td>
    <td>
      <p>Hello <b>{{ $data['name'] }}</b>,</p>
      <p>Thank you for reaching out to us! We have received your message and will get back to you as soon as possible.</p>
      @if(!empty($data['phone']))
        <p><b>Contact Number:</b> {{ $data['phone'] }}</p>
      @endif
      @if(!empty($data['message']))
        <p><b>Your Message:</b></p>
        <p style="background: #f8f9fa; padding: 10px; border-left: 3px solid #28a745; font-style: italic;">{{ $data['message'] }}</p>
      @endif
      <p>If you have any further questions, feel free to contact our support team.</p>
    </td>
    <td style="width:80px"></td>
  </tr>
@endsection
