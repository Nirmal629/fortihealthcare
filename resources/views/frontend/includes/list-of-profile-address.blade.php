@php
  $defaultAddresses = $addresses->where('primary', 1)->sortByDesc('id')->take(1);
  $otherAddresses = $addresses->where('primary', 0);
@endphp

<!-- Default Address Section -->
<div class="address_section_block mb-4">
  <div class="d-flex align-items-center gap-2 mb-3">
    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: rgba(240, 179, 52, 0.15); color: #f0b334;">
      <span class="material-symbols-outlined" style="font-size: 18px;">home</span>
    </div>
    <h3 class="font16 fw-bold text-dark m-0">Default Address</h3>
  </div>

  @forelse ($defaultAddresses as $address)
    @php
      $addressData = array_merge($address->toArray(), [
        'encoded_state_id' => Hashids::encode($address->state_id),
        'pincode' => $address->pin,
        'address_line_1' => $address->address_1,
        'city_name' => $address->city,
      ]);
    @endphp
    <div class="modern_address_card is-default">
      <div>
        <div class="modern_address_card_header">
          <div class="d-flex align-items-center gap-2">
            <div class="address_card_icon_wrap">
              <span class="material-symbols-outlined">home_pin</span>
            </div>
            <div>
              <h4 class="address_recipient_name">{{ $address->name }}</h4>
              <span class="text-muted font12">Primary Shipping Address</span>
            </div>
          </div>
          <span class="user-member-badge d-inline-flex align-items-center gap-1">
            <span class="material-symbols-outlined" style="font-size: 13px;">verified</span>
            Default
          </span>
        </div>

        <div class="address_body_text">
          <div>{{ $address->address_1 ? truncateNoWordBreak($address->address_1, 120) : '' }}</div>
          @if ($address->landmark)
            <div class="text-muted font12 mt-1"><strong>Landmark:</strong> {{ $address->landmark }}</div>
          @endif
          <div class="mt-1 font13"><strong>{{ $address->city }}</strong> - {{ $address->pin }}, {{ $address->state->name ?? '' }}</div>
        </div>

        @if ($address->phone)
          <div class="address_phone_info">
            <span class="material-symbols-outlined">phone_iphone</span>
            <span class="fw-semibold text-dark">{{ $address->phone }}</span>
          </div>
        @endif
      </div>

      <div class="modern_address_actions">
        <a href="javascript:void(0);"
          class="btn modern_address_btn edit-btn create-or-edit-address"
          title="Edit Address"
          data-address='@json($addressData)'
          data-address-id="{{ Hashids::encode($address->id ?? '') }}">
          <span class="material-symbols-outlined font16">edit</span>
          <span>Edit</span>
        </a>

        <a href="javascript:void(0);"
          class="btn modern_address_btn delete-btn delete-default-address"
          title="Remove Address"
          data-address-id="{{ $address->id ?? '' }}">
          <span class="material-symbols-outlined font16">delete</span>
          <span>Remove</span>
        </a>
      </div>
    </div>
  @empty
    <div class="modern_empty_address_box">
      <div class="empty-icon-wrap">
        <span class="material-symbols-outlined">location_off</span>
      </div>
      <h5 class="fw-bold font15 text-dark mb-1">No Default Address</h5>
      <p class="text-muted font13 mb-0">You don't have a default delivery address set yet.</p>
    </div>
  @endforelse
</div>

<!-- Other Addresses Section -->
<div class="address_section_block mt-4 pt-2">
  <div class="d-flex align-items-center gap-2 mb-3">
    <div class="d-flex align-items-center justify-content-center rounded-circle" style="width: 28px; height: 28px; background: #f1f5f9; color: #64748b;">
      <span class="material-symbols-outlined" style="font-size: 18px;">domain</span>
    </div>
    <h3 class="font16 fw-bold text-dark m-0">Other Addresses</h3>
    <span class="badge bg-light text-secondary border rounded-pill px-2 py-1 font11">{{ $otherAddresses->count() }}</span>
  </div>

  @if ($otherAddresses->count() > 0)
    <div class="modern_address_grid">
      @foreach ($otherAddresses as $address)
        @php
          $addressData = array_merge($address->toArray(), [
            'encoded_state_id' => Hashids::encode($address->state_id),
            'pincode' => $address->pin,
            'address_line_1' => $address->address_1,
            'city_name' => $address->city,
          ]);
        @endphp
        <div class="modern_address_card">
          <div>
            <div class="modern_address_card_header">
              <div class="d-flex align-items-center gap-2">
                <div class="address_card_icon_wrap" style="background: #f8fafc; color: #64748b;">
                  <span class="material-symbols-outlined">location_on</span>
                </div>
                <div>
                  <h4 class="address_recipient_name">{{ $address->name }}</h4>
                  <span class="text-muted font12">Additional Address</span>
                </div>
              </div>
            </div>

            <div class="address_body_text">
              <div>{{ $address->address_1 ? truncateNoWordBreak($address->address_1, 120) : '' }}</div>
              @if ($address->landmark)
                <div class="text-muted font12 mt-1"><strong>Landmark:</strong> {{ $address->landmark }}</div>
              @endif
              <div class="mt-1 font13"><strong>{{ $address->city }}</strong> - {{ $address->pin }}, {{ $address->state->name ?? '' }}</div>
            </div>

            @if ($address->phone)
              <div class="address_phone_info">
                <span class="material-symbols-outlined">phone_iphone</span>
                <span class="fw-semibold text-dark">{{ $address->phone }}</span>
              </div>
            @endif
          </div>

          <div class="modern_address_actions">
            <a href="javascript:void(0);"
              class="btn modern_address_btn edit-btn create-or-edit-address"
              title="Edit Address"
              data-address='@json($addressData)'
              data-address-id="{{ Hashids::encode($address->id ?? '') }}">
              <span class="material-symbols-outlined font16">edit</span>
              <span>Edit</span>
            </a>

            <a href="javascript:void(0);"
              class="btn modern_address_btn delete-btn delete-default-address"
              title="Remove Address"
              data-address-id="{{ $address->id ?? '' }}">
              <span class="material-symbols-outlined font16">delete</span>
              <span>Remove</span>
            </a>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="modern_empty_address_box">
      <div class="empty-icon-wrap" style="background: #f1f5f9; color: #94a3b8;">
        <span class="material-symbols-outlined">domain_disabled</span>
      </div>
      <h5 class="fw-bold font15 text-dark mb-1">No Additional Addresses</h5>
      <p class="text-muted font13 mb-0">You have no other saved addresses. Click "Add New Address" above to save another location.</p>
    </div>
  @endif
</div>