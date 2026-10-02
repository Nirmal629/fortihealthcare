@props(['filter' => true])

<div class="card card-h-100">
  <div class="d-flex card-header justify-content-between align-items-center">
    <h4 class="header-title">Cart vs Orders</h4>

    <div class="input-group input-group-text font-14 bg-white" id="cartOrderRange">
      <i class="mdi mdi-calendar-range me-2"></i>
      <span></span>
    </div>
  </div>

  <div class="card-body">
    <div id="cartOrderChart"></div>
  </div>
</div>

@push('component-scripts')
  <script>
    document.addEventListener('DOMContentLoaded', () => {

      let chart;

      const fetchChartData = (start, end) => {
        fetch('{{ route('admin.reports.cart-order-comparison-json') }}', {
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
            chart = new ApexCharts(document.querySelector("#cartOrderChart"), options);
            chart.render();
          });
      };

      const start = moment().startOf('year');
      const end = moment();

      $('#cartOrderRange').daterangepicker({
        startDate: start,
        endDate: end,
        locale: {
          format: 'YYYY-MM-DD'
        }
      }, function(start, end) {
        $('#cartOrderRange span').html(
          start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
        );
        fetchChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
      });

      $('#cartOrderRange span').html(
        start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY')
      );

      fetchChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });
  </script>
@endpush
