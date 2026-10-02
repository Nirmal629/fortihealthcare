

<label class="modern_address_card address-item" for="default_address_{{ $singleAddress->id ?? '' }}">
  <div class="card_radio_wrap">
    <input type="radio" name="default_address" id="default_address_{{ $singleAddress->id ?? ''}}" value="{{ $singleAddress->id ?? '' }}"
      class="modern_addr_radio" data-attr-type="{{ $singleAddress->type ?? '' }}" {{ !empty($singleAddress) && $singleAddress->primary == 1 ? 'checked' : '' }}>
  </div>
  <div class="card_content_wrap" id="address_{{ $singleAddress->id ?? '' }}">
    <div class="d-flex align-items-center justify-content-between mb-1">
      <h4 class="addr_name">{{ $singleAddress->name ?? '' }}</h4>
      @if(!empty($singleAddress) && $singleAddress->primary == 1)
        <span class="default_badge">Default</span>
      @endif
    </div>
    <p class="addr_details mb-1">
      {{ $singleAddress->address_1 ? truncateNoWordBreak($singleAddress->address_1,100) : '' }},
      {{ $singleAddress->city ?? '' }}@if(!empty($singleAddress->landmark)), {{ $singleAddress->landmark }}@endif<br>
      {{ $singleAddress->state_name ?? ($singleAddress->state->name ?? '') }} - {{ $singleAddress->pin ?? '' }},
      {{ $singleAddress->country_name ?? ($singleAddress->state->country->name ?? '') }}
    </p>
    <div class="addr_phone">
      <span class="material-symbols-outlined font15 text-muted me-1">call</span>
      <span>{{ $singleAddress->phone ?? '' }}</span>
    </div>
  </div>
</label>
