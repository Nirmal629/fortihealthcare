<div class="modal genericmodal fade AddNewAddressModal modern_address_modal" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modern_modal_content">
      <div class="modal-header modern_modal_header">
        <div class="d-flex align-items-center gap-3">
          <div class="modal_header_icon">
            <span class="material-symbols-outlined">location_on</span>
          </div>
          <div>
            <h5 class="modal-title modern_modal_title address-modal-title">Add Address</h5>
            <p class="modal_subtitle mb-0">Enter your complete address details</p>
          </div>
        </div>
        <button type="button" class="btn-close modern_close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modern_modal_body">
        <form class="allForm modern_address_form" id="add_address_form">
          @csrf
          <input type="hidden" name="id" id="address_id">

          <div class="form-element name">
            <label class="form-label">Full Name <em>*</em></label>
            <input name="name" id="name" type="text" class="form-field only-alphabet-symbols" placeholder="Enter recipient full name">
          </div>
          <div class="form-element mobile has-value">
            <label class="form-label">Phone <em>*</em></label>
            <div class="phone-input-container">
              <input type="text" class="form-field only-numbers" name="phone" id="custom-phone"
              autocomplete="new-phone" inputmode="numeric" placeholder="Phone" value="">
              <i class="msg-error"></i>
              <div class="custom-phone-error-container"></div>
            </div>
          </div>
          <div class="form-element address">
            <label class="form-label">Address / Street <em>*</em></label>
            <input name="address" type="text" class="form-field" placeholder="Flat, House no., Building, Apartment" value="">
          </div>
          <div class="form-element locality">
            <label class="form-label">Landmark <em>*</em></label>
            <input name="landmark" type="text" class="form-field" placeholder="E.g. Near Apollo Hospital, opposite park" value="">
          </div>
          <div class="form-element city">
            <label class="form-label">City / District <em>*</em></label>
            <input name="city" type="text" class="form-field" placeholder="City or district" value="">
          </div>
          <div class="form-element state has-value">
            <label class="form-label">State <em>*</em></label>
            <select class="form-field form-select" name="state" id="state">
              <option value="">Select State</option>
              @forelse ($states as $state)
                <option value="{{ Hashids::encode($state->id) }}"> {{ $state->name }}</option>
              @empty
              @endforelse
            </select>
          </div>
          <div class="form-element pincode">
            <label class="form-label">Pincode <em>*</em></label>
            <input name="pincode" type="text" class="form-field" placeholder="6-digit PIN code">
          </div>
          <div class="form-check modern_default_check defaultaddress mb-3">
            <input class="form-check-input" type="checkbox" name="is_default" id="defaultaddress">
            <label class="form-check-label font14 fw-medium" for="defaultaddress">Make this as my default address</label>
          </div>
          <div class="action modern_modal_actions d-flex align-items-center gap-3 pt-2">
            <button type="button" class="btn modern_cancel_btn custom-btn-close" data-bs-dismiss="modal">Cancel</button>
            <button type="submit" class="btn modern_save_btn">Save Details</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
