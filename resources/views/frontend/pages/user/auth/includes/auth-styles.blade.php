<style>
  /* ==========================================================================
     Modern Authentication Styling (Login, Signup, Forgot/Reset Password)
     ========================================================================== */
  .living__signupwrap {
    padding: 60px 0 80px !important;
    background: #f8fafc !important;
    min-height: calc(100vh - 180px);
    display: flex;
    align-items: center;
    border-top: 1px solid #edf2f7;
  }

  .living__signupwrap .container {
    max-width: 1040px !important;
  }

  .living__signupwrap .inswrp {
    display: grid !important;
    grid-template-columns: 1fr 1.15fr !important;
    background: #ffffff !important;
    border-radius: 20px !important;
    box-shadow: 0 20px 45px -12px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(15, 23, 42, 0.04) !important;
    border: none !important;
    overflow: hidden !important;
    /* min-height: 560px; */
    align-items: flex-start;
  }

  /* Left Side: Modern Clean Image (No text / banner overlay) */
  .living__signupwrap .inswrp .left,
  .living__signupwrap .inswrp .auth-visual-side {
    position: relative !important;
    height: 100% !important;
    min-height: 100% !important;
    background: #f1f5f9 !important;
    overflow: hidden !important;
    display: block !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  .living__signupwrap .inswrp .left figure,
  .living__signupwrap .inswrp .auth-visual-side figure {
    position: relative !important;
    width: 100% !important;
    height: 100% !important;
    margin: 0 !important;
    padding: 0 !important;
  }

  .living__signupwrap .inswrp .left figure img,
  .living__signupwrap .inswrp .left .imageFit,
  .living__signupwrap .inswrp .auth-visual-side figure img,
  .living__signupwrap .inswrp .auth-visual-side .imageFit {
    width: 100% !important;
    height: 100% !important;
    object-fit: cover !important;
    object-position: center !important;
    display: block !important;
    position: static !important;
    border-radius: 0 !important;
  }

  /* Hide any legacy banner/txt elements */
  .living__signupwrap .inswrp .left .txt,
  .living__signupwrap .inswrp .auth-visual-side .txt {
    display: none !important;
  }

  /* Right Side: Modern Form Container */
  .living__signupwrap .inswrp .commonforms {
    padding: 44px 20px !important;
    display: flex !important;
    flex-direction: column !important;
    justify-content: center !important;
    background: #ffffff !important;
    width: 100% !important;
    box-sizing: border-box !important;
  }

  .living__signupwrap .inswrp .commonforms.otpField {
    padding: 44px 48px !important;
  }

  /* Header Section */
  .living__signupwrap .inswrp .commonforms .righthead {
    margin-bottom: 24px !important;
  }

  .living__signupwrap .inswrp .commonforms .righthead h1,
  .living__signupwrap .inswrp .commonforms .righthead h3 {
    font-size: 26px !important;
    font-weight: 700 !important;
    color: #0f172a !important;
    letter-spacing: -0.025em !important;
    margin-bottom: 6px !important;
    line-height: 1.25 !important;
  }

  .living__signupwrap .inswrp .commonforms .righthead p,
  .living__signupwrap .inswrp .commonforms .righthead .c--menuc {
    font-size: 14.5px !important;
    color: #64748b !important;
    margin-bottom: 0 !important;
    line-height: 1.5 !important;
  }

  /* Form Elements & Inputs */
  .living__signupwrap .inswrp .commonforms .allForm .form-element {
    margin-bottom: 18px !important;
    position: relative !important;
    width: 100% !important;
    float: none !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .form-element label,
  .living__signupwrap .inswrp .commonforms .allForm .form-label {
    position: static !important;
    display: block !important;
    font-size: 13.5px !important;
    font-weight: 600 !important;
    color: #334155 !important;
    margin-bottom: 6px !important;
    line-height: 1.3 !important;
    background: transparent !important;
    padding: 0 !important;
    pointer-events: auto !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .form-element label em {
    color: #ef4444 !important;
    font-style: normal !important;
    margin-left: 2px !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .form-element .form-field,
  .living__signupwrap .inswrp .commonforms .allForm .form-element input.form-field {
    width: 100% !important;
    min-height: 48px !important;
    height: 48px !important;
    padding: 10px 16px !important;
    font-size: 14.5px !important;
    color: #0f172a !important;
    background-color: #f8fafc !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 10px !important;
    outline: none !important;
    transition: all 0.2s ease !important;
    box-sizing: border-box !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .form-element .form-field:focus,
  .living__signupwrap .inswrp .commonforms .allForm .form-element input.form-field:focus {
    border-color: #f0b334 !important;
    background-color: #ffffff !important;
    box-shadow: 0 0 0 3.5px rgba(240, 179, 52, 0.16) !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .form-element .form-field.is-invalid,
  .living__signupwrap .inswrp .commonforms .allForm .form-element input.form-field.is-invalid {
    border-color: #ef4444 !important;
    background-color: #fff8f8 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12) !important;
  }

  /* Phone Number Input with Flag */
  .living__signupwrap .inswrp .commonforms .allForm .phone-input-container {
    position: relative !important;
    width: 100% !important;
    z-index: 50 !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .phone-input-container .iti {
    width: 100% !important;
    display: block !important;
    position: relative !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .phone-input-container .iti input.form-field,
  .living__signupwrap .inswrp .commonforms .allForm .phone-input-container input.form-field,
  .living__signupwrap .inswrp .commonforms .allForm .phone-input-container input[type="text"],
  .living__signupwrap .inswrp .commonforms .allForm .phone-input-container input[type="tel"] {
    padding-left: 64px !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .phone-input-container .iti__country-container {
    padding-left: 6px !important;
  }

  .living__signupwrap .iti--inline-dropdown .iti__dropdown-content,
  .living__signupwrap .iti__dropdown-content {
    position: absolute !important;
    z-index: 99999 !important;
    top: 100% !important;
    left: 0 !important;
    width: 100% !important;
    min-width: 300px !important;
    max-width: 100% !important;
    background: #ffffff !important;
    border: 1px solid #e2e8f0 !important;
    border-radius: 12px !important;
    box-shadow: 0 16px 36px -4px rgba(0, 0, 0, 0.16), 0 4px 12px rgba(0, 0, 0, 0.08) !important;
    margin-top: 6px !important;
    overflow: hidden !important;
    animation: itiDropdownSlide 0.2s ease-out !important;
  }

  @keyframes itiDropdownSlide {
    from {
      opacity: 0;
      transform: translateY(-6px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .living__signupwrap .iti__search-input {
    width: 100% !important;
    padding: 10px 14px !important;
    border: none !important;
    border-bottom: 1px solid #e2e8f0 !important;
    font-size: 13.5px !important;
    color: #0f172a !important;
    background: #f8fafc !important;
    outline: none !important;
    border-radius: 12px 12px 0 0 !important;
  }

  .living__signupwrap .iti__country-list {
    max-height: 200px !important;
    overflow-y: auto !important;
    padding: 6px 0 !important;
    margin: 0 !important;
    list-style: none !important;
    scrollbar-width: thin !important;
    scrollbar-color: #cbd5e1 #f8fafc !important;
  }

  .living__signupwrap .iti__country-list::-webkit-scrollbar {
    width: 6px !important;
  }

  .living__signupwrap .iti__country-list::-webkit-scrollbar-track {
    background: #f8fafc !important;
  }

  .living__signupwrap .iti__country-list::-webkit-scrollbar-thumb {
    background-color: #cbd5e1 !important;
    border-radius: 4px !important;
  }

  .living__signupwrap .iti__country {
    padding: 8px 14px !important;
    font-size: 13.5px !important;
    color: #334155 !important;
    display: flex !important;
    align-items: center !important;
    gap: 8px !important;
    transition: background-color 0.15s ease !important;
    cursor: pointer !important;
  }

  .living__signupwrap .iti__country:hover,
  .living__signupwrap .iti__country.iti__highlight {
    background-color: #f1f5f9 !important;
    color: #0f172a !important;
  }

  .living__signupwrap .iti__country .iti__country-name {
    font-weight: 500 !important;
    font-size: 13.5px !important;
    color: #1e293b !important;
  }

  .living__signupwrap .iti__country .iti__dial-code {
    font-size: 12.5px !important;
    color: #64748b !important;
    margin-left: auto !important;
  }

  .living__signupwrap .inswrp .commonforms .allForm .msg-error,
  .living__signupwrap .inswrp .commonforms .allForm .error {
    font-size: 12.5px !important;
    color: #ef4444 !important;
    margin-top: 4px !important;
    display: block !important;
    font-weight: 500 !important;
    font-style: normal !important;
  }

  /* Password Visibility Toggle */
  .living__signupwrap #togglePassword {
    position: absolute !important;
    right: 14px !important;
    top: 36px !important;
    cursor: pointer !important;
    color: #94a3b8 !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: color 0.2s ease !important;
    z-index: 2 !important;
    background: transparent !important;
  }

  .living__signupwrap #togglePassword:hover {
    color: #0f172a !important;
  }

  .living__signupwrap #togglePassword .material-symbols-outlined {
    font-size: 20px !important;
    line-height: 1 !important;
  }

  /* Checkbox & Remember Row */
  .living__signupwrap .rememberwrap {
    margin-bottom: 0px !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: start !important;
    width: 100% !important;
  }
  .registermainwrap{
    margin-bottom: 20px !important;
    font-size: 14px !important;
    color: #64748b !important;
    text-align: center !important;
  }

  .living__signupwrap .form-check {
    display: flex !important;
    align-items: flex-start !important;
    gap: 8px !important;
    /* padding-left: 0 !important; */
  }

  .living__signupwrap .form-check .form-check-input {
    width: 17px !important;
    height: 17px !important;
    margin-top: 2px !important;
    border-radius: 4px !important;
    border: 1.5px solid #cbd5e1 !important;
    accent-color: #f0b334 !important;
    cursor: pointer !important;
    flex-shrink: 0 !important;
    float: none !important;
  }

  .living__signupwrap .form-check .form-check-input:checked {
    background-color: #f0b334 !important;
    border-color: #f0b334 !important;
  }

  .living__signupwrap .form-check .form-check-label {
    font-size: 13.5px !important;
    color: #475569 !important;
    line-height: 1.45 !important;
    cursor: pointer !important;
    user-select: none !important;
  }

  .living__signupwrap .form-check a,
  .living__signupwrap .forgotpass a {
    color: #d97706 !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    transition: color 0.2s ease !important;
  }

  .living__signupwrap .form-check a:hover,
  .living__signupwrap .forgotpass a:hover {
    color: #b45309 !important;
    text-decoration: underline !important;
  }

  /* Submit Buttons */
  .living__signupwrap .btn-auth-submit,
  .living__signupwrap .btn-dark,
  .living__signupwrap button[type="submit"] {
    width: 100% !important;
    height: 48px !important;
    background: #0f172a !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 10px !important;
    font-size: 15px !important;
    font-weight: 600 !important;
    letter-spacing: 0.01em !important;
    cursor: pointer !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 8px !important;
    transition: all 0.25s ease !important;
    box-shadow: 0 4px 12px rgba(15, 23, 42, 0.12) !important;
    padding: 0 16px !important;
    margin-top:10px !important;
    margin-bottom: 20px !important;
  }

  .living__signupwrap .btn-auth-submit:hover,
  .living__signupwrap .btn-dark:hover,
  .living__signupwrap button[type="submit"]:hover {
    background: #f0b334 !important;
    color: #0f172a !important;
    box-shadow: 0 6px 18px rgba(240, 179, 52, 0.3) !important;
    transform: translateY(-1px) !important;
  }

  .living__signupwrap button[type="submit"]:disabled {
    opacity: 0.7 !important;
    cursor: not-allowed !important;
    transform: none !important;
  }

  /* Divider */
  .living__signupwrap .auth-divider {
    display: flex !important;
    align-items: center !important;
    text-align: center !important;
    margin: 20px 0 !important;
  }

  .living__signupwrap .auth-divider::before,
  .living__signupwrap .auth-divider::after {
    content: '' !important;
    flex: 1 !important;
    border-bottom: 1px solid #e2e8f0 !important;
  }

  .living__signupwrap .auth-divider span {
    padding: 0 14px !important;
    color: #94a3b8 !important;
    font-size: 12.5px !important;
    font-weight: 500 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.05em !important;
  }

  /* Google Social Login */
  .living__signupwrap .googlelogin {
    margin-top: 0 !important;
    background: transparent !important;
  }

  .living__signupwrap .googlelogin a {
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    width: 100% !important;
    height: 48px !important;
    min-height: 48px !important;
    background: #ffffff !important;
    border: 1.5px solid #e2e8f0 !important;
    border-radius: 10px !important;
    color: #334155 !important;
    font-size: 14.5px !important;
    font-weight: 600 !important;
    text-decoration: none !important;
    transition: all 0.2s ease !important;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
    padding: 0 16px !important;
  }

  .living__signupwrap .googlelogin a:hover {
    background: #f8fafc !important;
    border-color: #cbd5e1 !important;
    color: #0f172a !important;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.06) !important;
    text-decoration: none !important;
  }

  .living__signupwrap .googlelogin a img {
    width: 20px !important;
    height: 20px !important;
    flex-shrink: 0 !important;
  }

  /* Footer Switch Text */
  .living__signupwrap .existing {
    text-align: center !important;
    margin-top: 22px !important;
    font-size: 14px !important;
    color: #64748b !important;
  }

  .living__signupwrap .existing a {
    color: #0f172a !important;
    font-weight: 700 !important;
    text-decoration: none !important;
    border-bottom: 1.5px solid #f0b334 !important;
    padding-bottom: 1px !important;
    transition: color 0.2s ease !important;
  }

  .living__signupwrap .existing a:hover {
    color: #f0b334 !important;
  }

  /* OTP Elements */
  .living__signupwrap .otpElement {
    display: flex !important;
    justify-content: center !important;
    gap: 10px !important;
    margin: 20px 0 15px !important;
  }

  .living__signupwrap .otpElement .form-element {
    margin-bottom: 0 !important;
    width: auto !important;
  }

  .living__signupwrap .otpElement .otp-input {
    width: 48px !important;
    height: 52px !important;
    font-size: 20px !important;
    font-weight: 700 !important;
    text-align: center !important;
    border-radius: 10px !important;
    border: 1.5px solid #e2e8f0 !important;
    background: #f8fafc !important;
    color: #0f172a !important;
    transition: all 0.2s ease !important;
  }

  .living__signupwrap .otpElement .otp-input:focus {
    border-color: #f0b334 !important;
    background: #ffffff !important;
    box-shadow: 0 0 0 3.5px rgba(240, 179, 52, 0.18) !important;
    outline: none !important;
  }

  /* Responsive Design */
  @media (max-width: 991px) {
    .living__signupwrap {
      padding: 30px 15px !important;
      min-height: auto !important;
    }
    .living__signupwrap .inswrp {
      grid-template-columns: 1fr !important;
      min-height: auto !important;
      border-radius: 16px !important;
    }
    .living__signupwrap .inswrp .left,
    .living__signupwrap .inswrp .auth-visual-side {
      min-height: 220px !important;
      max-height: 260px !important;
    }
    .living__signupwrap .inswrp .commonforms {
      padding: 32px 22px !important;
    }
    .living__signupwrap .otpElement {
      gap: 6px !important;
    }
    .living__signupwrap .otpElement .otp-input {
      width: 40px !important;
      height: 46px !important;
      font-size: 17px !important;
    }
  }
</style>
