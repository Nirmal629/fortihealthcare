@props(['cart_items', 'coupon' => false])

<div class="cart_summery {{ cartCount() == 0 ? 'd-none' : '' }}">

  <div class="summary_header">
    <h3 class="summary_title">Order Summary</h3>
    <span class="summary_count_badge">
      {{ cartCount() }} {{ cartCount() == 1 ? 'Item' : 'Items' }}
    </span>
  </div>

  @php
    use Illuminate\Support\Facades\DB;

    $extra_charges = DB::table('charges')->where('status', true)->get();
  @endphp
  <div class="cart_totals_grid">
    @php
      $total = 0;
      $totalTax = 0;
      $totalCategoryTaxPercent = 0;
    @endphp

    <div class="summary_items_list">
      @foreach ($cart_items as $item)
        @php
          $variant = $item->productVariant;
          $promo = findSalePrice($variant->id);

          $displayPrice = $promo['display_price'];
          $regularPrice = $promo['regular_price'];
          $discount = $promo['display_discount'];
          if ($promo['regular_price_true'] == true) {
              $unitPrice = $regularPrice;
          } else {
              $unitPrice = $displayPrice;
          }

          $subtotal = $unitPrice * $item->quantity;
          $total += $subtotal;

          $categoryTaxRate = $variant?->category?->tax ?? 0;
          $itemTax = ($unitPrice * $item->quantity * $categoryTaxRate) / 100;
          $totalTax += $itemTax;
          $totalCategoryTaxPercent += $categoryTaxRate;
        @endphp

        <div class="summary_item_row">
          <div class="pe-2 text-truncate" style="max-width: 68%;">
            <a class="item_title" href="{{ route('product.show', $variant->sku) }}">
              {{ $variant->name }}
            </a>
            <span class="item_qty">× {{ $item->quantity }}</span>
            <i class="ri-information-line text-primary ms-1 font13" data-bs-toggle="tooltip" data-bs-placement="top"
              title="{{ config('defaults.tax_name') }}: {{ $categoryTaxRate }}% ({{ displayPrice($itemTax) }})">
            </i>
            @if ($discount > 0)
              <div><span class="badge bg-success-subtle text-success border border-success-subtle" style="font-size: 10px; padding: 2px 6px;">{{ $discount }} OFF</span></div>
            @endif
          </div>
          <div class="item_price">{{ displayPrice($subtotal) }}</div>
        </div>
      @endforeach
    </div>

    @php
      $avgTax = count($cart_items) > 0 ? $totalCategoryTaxPercent / count($cart_items) : 0;
      $grandTotal = $total + $totalTax;
    @endphp

    <div class="summary_calc_list">
      <div class="summary_calc_row">
        <span class="calc_label">Subtotal</span>
        <span class="calc_val">{{ displayPrice($total) }}</span>
      </div>

      <div class="summary_calc_row">
        <span class="calc_label">Estimated Tax</span>
        <span class="calc_val">{{ displayPrice($totalTax) }}</span>
      </div>

      {{-- === Delivery Charges Section === --}}
      @php
        $deliveryChargesTotal = 0;
      @endphp

      @foreach ($extra_charges as $charge)
        @php
          $applyCharge = true;
          $conditions = json_decode($charge->conditions, true) ?? [];

          // Apply min_order condition
          if (isset($conditions['min_order']) && $grandTotal < $conditions['min_order']) {
              $applyCharge = false;
          }

          if (!$applyCharge) {
              continue;
          }

          $chargeAmount = 0;
          switch ($charge->calculation_method) {
              case 'fixed':
                  $chargeAmount = $charge->value;
                  break;
              case 'percentage':
                  $chargeAmount = ($grandTotal * $charge->value) / 100;
                  break;
          }

          // Skip if charge amount is 0
          if ($chargeAmount <= 0) {
              continue;
          }

          $deliveryChargesTotal += $chargeAmount;
        @endphp

        <div class="summary_calc_row">
          <span class="calc_label">
            {{ $charge->name }}
            @if ($charge->calculation_method === 'percentage')
              <small class="text-muted">({{ $charge->value }}%)</small>
            @endif
          </span>
          <span class="calc_val">{{ displayPrice($chargeAmount) }}</span>
        </div>
      @endforeach
    </div>

    @php
      $grandTotalWithDelivery = $grandTotal + $deliveryChargesTotal;
    @endphp

    <div id="coupon-section"></div>
    @if ($coupon)
      <form id="coupon-form" class="mt-2 mb-2">
        @csrf
        <div class="input-group">
          <input type="hidden" name="order_amount" id="order_amount" value="{{ $grandTotalWithDelivery }}">
          <input type="text" name="coupon_code" id="coupon_code" class="form-control font13"
            placeholder="Coupon code" style="border-radius: 6px 0 0 6px;">
          <button type="submit" class="btn text-white px-3 font13 fw-semibold" style="background-color: #f0b334; border-radius: 0 6px 6px 0;">Apply</button>
        </div>
      </form>
      <div class="search-coupon text-end mb-2">
        <a href="javascript:void(0);" onclick="showCouponModal()" class="font12 text-decoration-none" style="color: #f0b334; font-weight: 500;">
          <i class="ri-coupon-3-line me-1"></i> View Available Coupons
        </a>
      </div>
    @endif

    <div class="summary_total_row">
      <div class="total_label_group">
        <span class="total_label">Order Total</span>
        <span class="tax_note">Inclusive of all taxes</span>
      </div>
      <span class="total_val order-total-amount">{{ displayPrice($grandTotalWithDelivery) }}</span>
    </div>
  </div>
</div>

{{-- <!-- Coupon Modal --> --}}
<div class="modal genericmodal fade" id="couponModal" tabindex="-1" aria-labelledby="couponModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="couponModalLabel">Available Coupons</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="coupon-modal-body">
        ...
      </div>
    </div>
  </div>
</div>

@push('component-scripts')
  <script>
    $(document).on('click', '#remove-coupon-btn', function() {
      $.ajax({
        url: "{{ route('checkout.coupon.remove') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}"
        },
        success: function(response) {
          if (response.success) {
            iziNotify("", response.message, "success");
            $('#coupon-section').html('');
            $('#coupon-form').removeClass('d-none').addClass('d-flex');
            $('#coupon_code').val('');
            location.reload();
          } else {
            iziNotify("Oops!", response.message, "error");
          }
        },
        error: function() {
          iziNotify("Oops!", "Something went wrong!", "error");
        }
      });
    });

    $('#coupon-form').validate({
      rules: {
        coupon_code: {
          required: true
        }
      },
      messages: {
        coupon_code: {
          required: "Please enter a coupon code."
        }
      },
      errorElement: "span",
      errorPlacement: function(error, element) {
        if (element.attr('id') === 'coupon_code') {
          element.closest('.stock-delivery').after(error);
        } else {
          error.insertAfter(element);
        }
      },
      submitHandler: function(form) {
        let code = $('#coupon_code').val();
        let orderAmount = $('#order_amount').val();
        applyCoupon(code, orderAmount);
      }
    });

    function applyCoupon(code, orderAmount) {
      $.ajax({
        url: "{{ route('checkout.coupon.apply') }}",
        type: "POST",
        data: {
          _token: "{{ csrf_token() }}",
          coupon_code: code,
          order_amount: orderAmount
        },
        success: function(response) {
          if (response.success) {
            iziNotify("", response.message, "success");
            $('#couponModal').modal('hide');
            $('#coupon-section').html(response.html);
            $('#coupon-form').addClass('d-none');
            $('.order-total-amount').text(response.final_amount);
            $('#coupon_id').val(response.coupon_id);
            $('#coupon_discount').val(response.discount);
          } else {
            iziNotify("Oops!", response.message, "error");
          }
        },
        error: function() {
          iziNotify("Oops!", "Something went wrong!", "error");
        }
      });
    }

    function showCouponModal() {
      $('#couponModal').appendTo('body').modal('show');
      $.ajax({
        url: "{{ route('checkout.list-of-coupons') }}",
        type: "GET",
        success: function(response) {
          $('#couponModal #coupon-modal-body').empty();
          if (response.data.length > 0) {
            let htmlContent = '<div class="row row-cols-1 g-3" style="max-height: 400px; overflow-y: auto;">';

            $.each(response.data, function(index, coupon) {
              htmlContent += `
            <div class="col">
              <div class="card border-info shadow-sm h-100 apply-coupon-card" data-code="${coupon.code}" style="cursor: pointer;">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title mb-0 text-dark">
                      <i class="ri-coupon-3-line me-1"></i> ${coupon.code}
                    </h5>
                    <span class="badge bg-dark fs-6">
                     ${coupon.amount} OFF
                    </span>
                  </div>
                  ${coupon.min_order_value !== 0
                    ? `<p class="card-text text-muted mb-0">
                                                                                                             <i class="ri-shopping-basket-line me-1"></i> Min Order: ₹${coupon.min_order_value}
                                                                                                           </p>`
                    : ''
                  }
                </div>
              </div>
            </div>
          `;
            });

            htmlContent += '</div>';
            $('#coupon-modal-body').html(htmlContent);

            // Attach click event to each coupon card
            $('.apply-coupon-card').on('click', function() {
              const code = $(this).data('code');
              const orderAmount = $('#order_amount').val();
              applyCoupon(code, orderAmount);
            });

          } else {
            $('#coupon-modal-body').html('<p class="text-warning">No coupons available at this time.</p>');
          }
        },
        error: function() {
          $('#couponModal #coupon-modal-body').html('<p class="text-danger">Failed to load coupon data.</p>');
          iziNotify("Oops!", "Something went wrong!", "error");
        }
      });
    }
  </script>
@endpush
