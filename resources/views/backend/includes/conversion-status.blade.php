@props(['filter' => true, 'link' => false])

<div class="card card-h-100">
  <div class="d-flex card-header justify-content-between align-items-center">
    <h4 class="header-title">Conversion Overview</h4>

    @if ($filter)
      <div class="dropdown ms-1">
        <div class="d-flex me-2">
          <div class="input-group input-group-text font-14 bg-white" id="conversionStatusRange" wire:ignore>
            <i class="mdi mdi-calendar-range font-14 d-flex me-2"></i>
            <span></span>
          </div>
        </div>
      </div>
    @endif

    <div class="dropdown ms-1">
      <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown">
        <i class="mdi mdi-dots-vertical"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-end">
        <a href="javascript:void(0);" class="dropdown-item" id="downloadPngConversion">
          Download PNG
        </a>
        <a href="javascript:void(0);" class="dropdown-item" id="downloadCsvConversion">
          Download CSV
        </a>
      </div>
    </div>
  </div>

  <div class="card-body">
    <div id="conversionStatusChart"></div>
  </div>
</div>

@push('component-scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
  const chartElement = document.getElementById("conversionStatusChart");
  let chart = null;

  document.getElementById('downloadPngConversion').addEventListener('click', () => {
    if (chart) {
      chart.dataURI().then(({ imgURI }) => {
        const link = document.createElement("a");
        link.href = imgURI;
        link.download = `conversion-status-${Date.now()}.png`;
        link.click();
      });
    }
  });

  document.getElementById('downloadCsvConversion').addEventListener('click', () => {
    if (chart) chart.exportToCSV();
  });

  const fetchChartData = (start, end) => {
    fetch('{{ route('admin.reports.conversion-status-json') }}', {
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
    .then(r => r.json())
    .then(options => {
      if (chart) chart.destroy();
      chart = new ApexCharts(chartElement, options);
      chart.render();
    });
  };

  const startOfYear = moment().startOf('year').format('YYYY-MM-DD');
  const today = moment().format('YYYY-MM-DD');

  $('#conversionStatusRange').daterangepicker({
    startDate: startOfYear,
    endDate: today,
    locale: { format: 'YYYY-MM-DD' }
  }, (start, end) => {
    $('#conversionStatusRange span').html(`${start.format('MMMM D, YYYY')} - ${end.format('MMMM D, YYYY')}`);
    fetchChartData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
  });

  $('#conversionStatusRange span').html(
    `${moment(startOfYear).format('MMMM D, YYYY')} - ${moment(today).format('MMMM D, YYYY')}`
  );

  fetchChartData(startOfYear, today);
});
</script>
@endpush
