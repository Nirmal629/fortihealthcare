<div class="accordion modern-product-accordion" id="product-accordion">
  @if (!empty($productVariant->product->product_details))
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#pd-accordion1" aria-expanded="false" aria-controls="pd-accordion1">
          <span class="material-symbols-outlined" style="font-size: 20px; color: #f0b334;">info</span>
          <span>Product Details</span>
        </button>
      </h2>
      <div id="pd-accordion1" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
        data-bs-parent="#product-accordion">
        <div class="accordion-body">
          {!! $productVariant->product->product_details !!}
        </div>
      </div>
    </div>
  @endif

  @if (!empty($productVariant->product->specifications))
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#pd-accordion2" aria-expanded="false" aria-controls="pd-accordion2">
          <span class="material-symbols-outlined" style="font-size: 20px; color: #f0b334;">tune</span>
          <span>Specifications</span>
        </button>
      </h2>
      <div id="pd-accordion2" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
        data-bs-parent="#product-accordion">
        <div class="accordion-body">
          {!! $productVariant->product->specifications !!}
        </div>
      </div>
    </div>
  @endif

  @if (!empty($productVariant->product->care_maintenance))
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#pd-accordion3" aria-expanded="false" aria-controls="pd-accordion3">
          <span class="material-symbols-outlined" style="font-size: 20px; color: #f0b334;">cleaning_services</span>
          <span>Care & Maintenance</span>
        </button>
      </h2>
      <div id="pd-accordion3" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
        data-bs-parent="#product-accordion">
        <div class="accordion-body">
          {!! $productVariant->product->care_maintenance !!}
        </div>
      </div>
    </div>
  @endif

  @if (!empty($productVariant->product->warranty))
    <div class="accordion-item">
      <h2 class="accordion-header">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
          data-bs-target="#pd-accordion5" aria-expanded="false" aria-controls="pd-accordion5">
          <span class="material-symbols-outlined" style="font-size: 20px; color: #f0b334;">verified_user</span>
          <span>Warranty</span>
        </button>
      </h2>
      <div id="pd-accordion5" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
        data-bs-parent="#product-accordion">
        <div class="accordion-body">
          {!! $productVariant->product->warranty !!}
        </div>
      </div>
    </div>
  @endif
</div>