@props(['addresses'])
<div class="modal genericmodal fade modern_address_modal" id="AddressModal" tabindex="-1" aria-labelledby="AddressModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content modern_modal_content">
      <div class="modal-header modern_modal_header">
        <div class="d-flex align-items-center gap-3">
          <div class="modal_header_icon">
            <span class="material-symbols-outlined">home_pin</span>
          </div>
          <div>
            <h5 class="modal-title modern_modal_title" id="AddressModalLabel">Select Delivery Address</h5>
            <p class="modal_subtitle mb-0">Choose a saved address or add a new one</p>
          </div>
        </div>
        <button type="button" class="btn-close modern_close_btn" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body modern_modal_body">
        <a href="javascript:void(0);"
          class="btn modern_add_new_address_card add-new-address-btn"
          title="Add New Address">
          <span class="material-symbols-outlined icon">add_circle</span>
          <span>Add New Delivery Address</span>
        </a>
        <div class="profile_details h-100">
          <div class="info">
            <div class="address_block modern_address_list">
              @forelse ($addresses as $address)
                @include('frontend.includes.address-block', ['singleAddress' => $address])
              @empty
                <div id="no-address" class="text-center py-4 text-muted">
                  <span class="material-symbols-outlined font32 d-block mb-2" style="color: #f0b334;">location_off</span>
                  <p class="m-0 font14">No saved addresses found. Please add a new address.</p>
                </div>
              @endforelse
              <button type="button" class="btn modern_save_btn w-100 mt-3 submit-address-btn">
                <span>Deliver to this Address</span>
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@push('component-scripts')
  <script>
    /* let selectedShippingAddress  = `{{ session("selected_shipping_address") ?? ''}} `;
    let selectedBillingAddress = `{{ session('selected_billing_address') ?? '' }}`; */
    let selectedShippingAddress = @json(session('selected_shipping_address'));
    if (!selectedShippingAddress) {
        selectedShippingAddress = $('#shipping_address').val();
    }

    let selectedBillingAddress = @json(session('selected_billing_address'));
    if (!selectedBillingAddress) {
        selectedBillingAddress = $('#billing_address').val();
    }

    $(document).ready(function () {
      // let addressType = $('input[name="default_address"]:checked').data('attr-type2') || 'shipping';
      $('.add-new-address-btn').on('click', function(e) {
        $('#AddressModal').modal('hide');
        $('#AddNewAddressModal').modal('show');
      });

      $('.submit-address-btn').on('click', function (e) {
        e.preventDefault();

        const id = $('input[name="default_address"]:checked').val();
        const $addr = $('#address_' + id);
        if (!$addr.length) return;
        let addressCount =  parseInt($('#address_count').val());
        // Re-fetch addressType
        let addressType = $('input[name="default_address"]:checked').attr('data-attr-type2') || 'shipping';
        const target = '.' + addressType.replace('_address', '');
        const label = addressType.includes('shipping') ? 'Shipping' : 'Billing';

        // Save selected address to session
        $.ajax({
          url: `{{ route('address.set-selected-address') }}`,
          method: 'POST',
          data: {
            id: id,
            type: addressType,
            _token: `{{ csrf_token() }}`
          },
          success: function () {
            if (addressCount == 1) {
              $('.shipping').html(`${$addr.html()}
                <a href="javascript:void(0);" class="font16 change-address-btn" data-address-type="shipping">
                  Change Shipping Address
                </a>`);

              $('.billing').html(`${$addr.html()}
                <a href="javascript:void(0);" class="font16 change-address-btn" data-address-type="billing">
                  Change Billing Address
                </a>`);

              $('#shipping_address').val(id);
              $('#billing_address').val(id);
            }
            else{
              if(label == 'Shipping') {
                selectedShippingAddress= id;
              } else {
                selectedBillingAddress = id;
              }
              $(target).html(`${$addr.html()}
                <a href="javascript:void(0);" class="font16 change-address-btn" data-address-type="${addressType}">
                  Change ${label} Address
                </a>`);

              $('#' + addressType + '_address').val(id);
            }

            $('#AddressModal').modal('hide');
            // window.location.reload();
          }
        });
      });

    });
</script>

@endpush
