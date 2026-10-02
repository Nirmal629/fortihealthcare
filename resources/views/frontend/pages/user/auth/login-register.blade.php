@extends('frontend.layouts.app')

@section('title', @$title)

@push('styles')
  @include('frontend.pages.user.auth.includes.auth-styles')
@endpush

@section('content')
  <section class="living__signupwrap">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 ">
          <div class="inswrp">
            <div class="left">
              @php
                $settings = json_decode($login_page_banner['settings'] ?? '{}', true);
                $imageName = $settings['image'] ?? '';
                $altText = $settings['alt_text'] ?? 'Login';

                // Check if image exists, else use default
                $imagePath = !empty($imageName)
                    ? asset(config('defaults.banner_image_path') . $imageName)
                    : asset('public/frontend/assets/img/home/signup_popup_thumb.jpg');
              @endphp

              <figure class="mb-0">
                <img src="{{ $imagePath }}" alt="{{ $altText }}" title="{{ $altText }}" class="imageFit" />
              </figure>
            </div>

            {{-- Email/Mobile Login Form --}}
            <div class="commonforms" id="emailForm">
              <div class="righthead">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-1">
                  <h1 class="font25 mb-0">Signup or Login</h1>

                </div>
                <p class="c--menuc">Log In to track/place orders. </p>
              </div>
              <form class="allForm" id="loginRegisterForm" autocomplete="off">
                @csrf
                <div class="form-element">
                  <label class="form-label" for="email">Email Address <em>*</em></label>
                  <input name="email" type="email" id="email" class="form-field" placeholder="Enter your email" autocomplete="new-email" />
                  <span class="msg-error error"></span>
                </div>

                <div class="form-element position-relative">
                  <label class="form-label" for="passwordInput">Password <em>*</em></label>
                  <input name="password" type="password" class="form-field password-element" id="passwordInput"
                    placeholder="Enter your password" autocomplete="new-password" />
                  <span id="togglePassword">
                    <span class="material-symbols-outlined font25">
                      visibility
                    </span>
                  </span>
                  <span class="msg-error error"></span>
                </div>

                <div class="rememberwrap">
                  <div class="form-check m-0">
                    <input class="form-check-input" type="checkbox" name="remember" value="1" id="rememberme">
                    <label class="form-check-label font14" for="rememberme">Remember me</label>
                  </div>
                  <div class="forgotpass"><a href="{{ route('password.request') }}" title="Forgot password?">Forgot password?</a></div>
                </div>

                <div class="registermainwrap">
                  Don't have an account? <a href="{{ route('register') }}" class="fw-bold text-dark text-decoration-underline" title="Register Here">Register Here</a>
                </div>

                <button type="submit" class="btn btn-dark w-100 btn-auth-submit">Login Here</button>

                <div class="form-check required">
                  <input class="form-check-input" type="checkbox" name="flexCheckDefault" value="1"
                    id="flexCheckDefault" checked>
                  <label class="form-check-label font14" for="flexCheckDefault">
                    By continuing, you agree to Fortier's <a href="{{ route('cms.page', 'terms-of-use') }}">Terms of
                      Use</a> and <a href="{{ route('cms.page', 'privacy-policy') }}">Privacy
                      Policy</a>.
                  </label>
                  <p class="msg-error error"></p>
                </div>

                <!-- <div class="googlelogin">
                  <a href="{{ route('auth.google') }}" title="Continue with Google">
                    <span><img src="{{ asset('public/frontend/assets/img/icons/google-icon.svg') }}" alt="Google"
                        title="Google" /></span>
                    <span>Continue with Google</span>
                  </a>
                </div> -->
                @if (session('error'))
                  <div id="flash-message" style="color: #ef4444; padding: 10px 14px; border-radius: 8px; border: 1px solid #fecaca; background: #fef2f2; margin-top: 15px; font-size: 13.5px;">
                    {{ session('error') }}
                  </div>

                  <script>
                    setTimeout(function() {
                      var flash = document.getElementById('flash-message');
                      if (flash) {
                        flash.style.display = 'none';
                      }
                    }, 5000);
                  </script>
                @endif
              </form>
            </div>

            <!-- <div class="commonforms otpField" id="otpForm" style="display: none;">
              <div class="righthead">
                <h1 class="font25">Verify your email</h1>
                <p class="c--menuc">We’ve emailed a 6-digit verification code to <span id="otpSentTo"
                    class="fw-bold text-dark"></span>
                  <a href="javascript:void(0);" title="Change Email" class="text-decoration-underline ms-1" id="changeEmail">Change</a>.
                  Please enter it below.
                </p>
              </div>

              <form class="allForm" id="otpVerifyForm" method="POST" action="{{ route('verifyotp') }}"
                autocomplete="off">
                @csrf
                <div class="otpElement">
                  <div class="form-element">
                    <input name="otp[0]" id="otp1" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[1]" id="otp2" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[2]" id="otp3" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[3]" id="otp4" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[4]" id="otp5" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                  <div class="form-element">
                    <input name="otp[5]" id="otp6" inputmode="numeric" type="text"
                      class="form-field text-center only-integers otp-input px-1">
                  </div>
                </div>
                <span id="otp-error" class="msg-error error text-center d-block mb-3"></span>

                <button type="submit" id="verifyOtpBtn" class="btn btn-dark w-100 btn-auth-submit">Verify &
                  Continue</button>
              </form>
              <div class="existing text-center">Didn't receive the code? <a href="javascript:void(0);" id="resendOtpBtn"
                  title="Resend Code">Resend Code</a>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
  </section>


  {{-- This is FAQ page content --}}
  {{-- ============================================================================================================================================================ --}}
  {{-- <section class="faq">
    <div class="container">
      <div class="inner-container">
        <h1 class="font45">Frequently Asked Questions</h1>
        <div class="tabContainer">
          <div class="row">
            <div class="col-2 pr-0">
              <ul class="tabMenu">
                <li class="font20"><a href="javascript: void(0);" class="actv">Top Queries</a></li>
                <li class="font20"><a href="javascript: void(0);">My Account</a></li>
                <li class="font20"><a href="javascript: void(0);">Returns</a></li>
                <li class="font20"><a href="javascript: void(0);">Payment Options</a></li>
                <li class="font20"><a href="javascript: void(0);">Shipping and delivery</a></li>
                <li class="font20"><a href="javascript: void(0);">Warranty</a></li>
                <li class="font20"><a href="javascript: void(0);">Sign Up and Login</a></li>
              </ul>
            </div>
            <div class="col-10 pl-0">
              <div class="tabContents">
                <div class="tabContent" style="display: block;">
                  <div class="title_BtnWrap">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="font25">Top Queries</h2>
                        <p class="desc c--gry mb-0">Lorem ipsum dolor sit amet consectetur. At.</p>
                      </div>
                      <div class="col-4">
                        <a href="javascript: void(0);"
                          class="btn btn-outline-dark d-inline-flex px-4 py-3 align-items-center gap-2">Track Orders</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordWrap accord">
                    <div class="accordion">
                      <h5 class="accord-btn font20 actv">Question will go here?</h5>
                      <div class="accord-target" style="display:block;">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tabContent">
                  <div class="title_BtnWrap">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="font25">My Account</h2>
                        <p class="desc c--gry mb-0">Lorem ipsum dolor sit amet consectetur. At.</p>
                      </div>
                      <div class="col-4">
                        <a href="javascript: void(0);"
                          class="btn btn-outline-dark d-inline-flex px-4 py-3 align-items-center gap-2">Go to My
                          Account</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordWrap accord">
                    <div class="accordion">
                      <h5 class="accord-btn font20 actv">Question will go here?</h5>
                      <div class="accord-target" style="display:block;">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tabContent">
                  <div class="title_BtnWrap">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="font25">Returns</h2>
                        <p class="desc c--gry mb-0">Lorem ipsum dolor sit amet consectetur. At.</p>
                      </div>
                      <div class="col-4">
                        <a href="javascript: void(0);"
                          class="btn btn-outline-dark d-inline-flex px-4 py-3 align-items-center gap-2">Track Orders</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordWrap accord">
                    <div class="accordion">
                      <h5 class="accord-btn font20 actv">Question will go here?</h5>
                      <div class="accord-target" style="display:block;">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tabContent">
                  <div class="title_BtnWrap">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="font25">Payment Options</h2>
                        <p class="desc c--gry mb-0">Lorem ipsum dolor sit amet consectetur. At.</p>
                      </div>
                      <div class="col-4">
                        <a href="javascript: void(0);"
                          class="btn btn-outline-dark d-inline-flex px-4 py-3 align-items-center gap-2">Track Orders</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordWrap accord">
                    <div class="accordion">
                      <h5 class="accord-btn font20 actv">Question will go here?</h5>
                      <div class="accord-target" style="display:block;">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tabContent">
                  <div class="title_BtnWrap">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="font25">Shipping and delivery</h2>
                        <p class="desc c--gry mb-0">Lorem ipsum dolor sit amet consectetur. At.</p>
                      </div>
                      <div class="col-4">
                        <a href="javascript: void(0);"
                          class="btn btn-outline-dark d-inline-flex px-4 py-3 align-items-center gap-2">Track Orders</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordWrap accord">
                    <div class="accordion">
                      <h5 class="accord-btn font20 actv">Question will go here?</h5>
                      <div class="accord-target" style="display:block;">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tabContent">
                  <div class="title_BtnWrap">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="font25">Warranty</h2>
                        <p class="desc c--gry mb-0">Lorem ipsum dolor sit amet consectetur. At.</p>
                      </div>
                      <div class="col-4">
                        <a href="javascript: void(0);"
                          class="btn btn-outline-dark d-inline-flex px-4 py-3 align-items-center gap-2">Track Orders</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordWrap accord">
                    <div class="accordion">
                      <h5 class="accord-btn font20 actv">Question will go here?</h5>
                      <div class="accord-target" style="display:block;">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="tabContent">
                  <div class="title_BtnWrap">
                    <div class="row">
                      <div class="col-8">
                        <h2 class="font25">Sign Up and Login</h2>
                        <p class="desc c--gry mb-0">Lorem ipsum dolor sit amet consectetur. At.</p>
                      </div>
                      <div class="col-4">
                        <a href="javascript: void(0);"
                          class="btn btn-outline-dark d-inline-flex px-4 py-3 align-items-center gap-2">Track Orders</a>
                      </div>
                    </div>
                  </div>
                  <div class="accordWrap accord">
                    <div class="accordion">
                      <h5 class="accord-btn font20 actv">Question will go here?</h5>
                      <div class="accord-target" style="display:block;">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                    <div class="accordion">
                      <h5 class="accord-btn font20">Question will go here?</h5>
                      <div class="accord-target">
                        <p class="desc c--gry">Gain real-time analytics and comprehensive reports to optimize performance
                          and
                          drive business growth.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section> --}}
  {{-- This is FAQ page content --}}
  {{-- ============================================================================================================================================================ --}}
@endsection

@push('scripts')
  <script src="{{ asset('public/common/js/custom_input.js') }}"></script>
  <script>
    $('#togglePassword').on('click', function() {
      const input = $('#passwordInput');
      const span_icon = $(this).find('.material-symbols-outlined');

      if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        span_icon.text('visibility_off');
      } else {
        input.attr('type', 'password');
        span_icon.text('visibility');
      }
    });

    $(document).ready(function() {
      const loginForm = $('#loginRegisterForm');
      const emailField = $('#email');
      const passwordField = $('#passwordInput');
      const rememberCheckbox = $('#rememberme');

      // Prefill email if remembered
      const savedEmail = localStorage.getItem('rememberedEmail');
      if (savedEmail) {
        emailField.val(savedEmail).trigger('change');
        rememberCheckbox.prop('checked', true);
      }

      function sendAjaxRequest(url, data, successCallback, errorCallback) {
        $.ajax({
          url,
          method: 'POST',
          data: {
            ...data,
            "_token": "{{ csrf_token() }}"
          },
          success: successCallback,
          error: errorCallback || function(xhr) {
            let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : "Something went wrong. Please try again.";
            iziNotify("Oops!", msg, "error");
          }
        });
      }

      const validationSettings = {
        errorPlacement: (error, element) => element.siblings('.msg-error').text(error.text()),
        highlight: element => $(element).addClass('is-invalid'),
        unhighlight: element => $(element).removeClass('is-invalid').siblings('.msg-error').text('')
      };

      loginForm.validate({
        ...validationSettings,
        rules: {
          email: {
            required: true,
            email: true
          },
          password: {
            required: true,
            minlength: 6
          },
          flexCheckDefault: {
            required: true
          }
        },
        messages: {
          email: {
            required: "Please enter your email address.",
            email: "Please enter a valid email address."
          },
          password: {
            required: "Please enter your password.",
            minlength: "Password must be at least 6 characters."
          },
          flexCheckDefault: {
            required: "Please agree to the Terms of Use and Privacy Policy to continue."
          }
        },
        submitHandler: function() {
          let $submitBtn = loginForm.find('button[type="submit"]').prop('disabled', true).html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Logging in...'
          );

          if (rememberCheckbox.is(':checked')) {
            localStorage.setItem('rememberedEmail', emailField.val());
          } else {
            localStorage.removeItem('rememberedEmail');
          }

          sendAjaxRequest(
            '{{ route('signuplogin') }}', {
              email: emailField.val(),
              password: passwordField.val(),
              remember: rememberCheckbox.is(':checked') ? 1 : 0
            },
            function(res) {
              if (res.success) {
                iziNotify("", res.message, "success");
                setTimeout(function() {
                  window.location.href = res.redirect || '{{ route('category.list') }}';
                }, 700);
              } else {
                $submitBtn.prop('disabled', false).html('Login Here');
                iziNotify("Oops!", res.message, "error");
              }
            },
            function(xhr) {
              $submitBtn.prop('disabled', false).html('Login Here');
              let msg = "Invalid credentials. Please try again.";
              if (xhr.responseJSON) {
                if (xhr.responseJSON.message) {
                  msg = xhr.responseJSON.message;
                } else if (xhr.responseJSON.errors) {
                  let firstKey = Object.keys(xhr.responseJSON.errors)[0];
                  msg = xhr.responseJSON.errors[firstKey][0];
                }
              }
              iziNotify("Oops!", msg, "error");
            }
          );
        }
      });
    });
  </script>
@endpush
