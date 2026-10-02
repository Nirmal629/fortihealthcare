{{-- backend/includes/product-revenue.blade.php --}}

@props(['filter' => true])

<div class="card card-h-100">
  <div class="d-flex card-header justify-content-between align-items-center">
    <h4 class="header-title">Product Revenue</h4>

    @if ($filter)
      <div class="input-group input-group-text font-14 bg-white" id="productRevenueRange" wire:ignore>
        <i class="mdi mdi-calendar-range me-2"></i>
        <span></span>
      </div>
    @endif
  </div>

  <div class="card-body">
    <div id="productRevenueChart"></div>
  </div>
</div>

@push('component-scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      let chart;

      const fetchData = (start, end) => {
        fetch('{{ route('admin.reports.product-revenue-json') }}', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
              start_date: start,
              end_date: end
            })
          })
          .then(res => res.json())
          .then(options => {
            if (chart) chart.destroy();
            chart = new ApexCharts(document.querySelector("#productRevenueChart"), options);
            chart.render();
          });
      };

      const start = moment().startOf('year');
      const end = moment();

      $('#productRevenueRange').daterangepicker({
        startDate: start,
        endDate: end,
        locale: {
          format: 'YYYY-MM-DD'
        }
      }, function(start, end) {
        $('#productRevenueRange span').html(
          start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
        );
        fetchData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
      });

      $('#productRevenueRange span').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
      );

      fetchData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });
  </script>
@endpush
