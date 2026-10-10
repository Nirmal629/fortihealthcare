<?php $__env->startPush('component-styles'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('/public/backend/assetss/daterangepicker.css')); ?>">
<?php $__env->stopPush(); ?>
<div class="row min-VH">
  <div class="col-xl-12 col-lg-12">
    <div class="card card-h-100">
      <div class="d-flex card-header justify-content-between align-items-center">
        <h4 class="header-title mb-0"><?php echo e($cardHeader); ?> </h4>
        <div class="d-flex align-items-center">
          <?php if($addBtnShow): ?>
            <?php if(hasUserPermission($addBtn)): ?>
              <a href="<?php echo e(route($addBtn)); ?>" id="addBtn"
                class="btn d-flex align-items-center btn-success btn-sm gap-1 me-2">Add
                New <i class="mdi mdi-plus ms-1 font-16"></i></a>
            <?php else: ?>
              <a href="javascript:void(0);"
                class="btn d-flex align-items-center btn-success btn-sm gap-1 me-2 disabled-link" id="addBtn">Add
                New <i class="mdi mdi-plus ms-1 font-16"></i></a>
            <?php endif; ?>
          <?php endif; ?>
          <button type="button" class="btn d-flex align-items-center btn-warning btn-sm gap-1 me-2"
            id="refresh">Refresh <i class="mdi mdi-refresh ms-1 font-16"></i></button>

          <div class="dropdown ms-1">
            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
              aria-expanded="false">
              <i class="mdi mdi-dots-vertical"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-end">
              
              <?php if(hasUserPermission($exportUrl)): ?>
                <a href="javascript:void(0);" class="dropdown-item" onclick="exportTableCSV(true, false)">Export
                  Visible to CSV</a>
                <a href="javascript:void(0);" class="dropdown-item" onclick="exportTableCSV(false, true)">Export All to
                  CSV</a>
              <?php else: ?>
                <a href="javascript:void(0);" class="dropdown-item disabled-link">Export Visible to CSV</a>
                <a href="javascript:void(0);" class="dropdown-item disabled-link">Export All to CSV</a>
              <?php endif; ?>
            </div>
          </div>
        </div>

      </div>
      <div class="card-body">
        <?php echo e($slot); ?>

      </div>
    </div>
  </div>
</div>

<?php $__env->startPush('component-scripts'); ?>
  <script src="<?php echo e(asset('/public/backend/assetss/js/moment.min.js')); ?>"></script>
  <script src="<?php echo e(asset('/public/backend/assetss/js/daterangepicker.js')); ?>"></script>
  <script src="<?php echo e(asset('/public/common/js/ajax.js?v=3' . time())); ?>"></script>
  <script>
    var exportUrl = "<?php echo e($exportUrl ? route($exportUrl) : null); ?>";
    //alert(exportUrl);

    function exportTableCSV(o = !1) {
      exportUrl && $.ajax({
        url: exportUrl,
        method: "GET",
        data: {
          _token: "<?php echo e(csrf_token()); ?>"
        },
        success: function(r) {
          Livewire.dispatch("exportCSVComponent", [o])
        },
        error: function(o) {
          403 === o.status && swalNotify("Error!", "You do not have permission to export this data.", "error")
        }
      })
    }

    function updateBadgeStatus(id, t) {
      const isActive = t == true || t == 1;
      const status = (t == 2) ? "Revoked" : (isActive) ? "Active" : "Inactive";
      const addClass = (isActive) ? "badge-success-lighten" : "badge-danger-lighten";
      const removeClass = (isActive) ? "badge-danger-lighten" : "badge-success-lighten";

      $("#status_" + id).removeClass(removeClass).addClass(addClass).text(status);
    }

    function clearCheckbox() {
      mainCheckbox.prop("checked", !1), checkboxes.prop("checked", !1), deleteBtn.hide()
    }
    $("#refresh").on("click", (function() {
      Livewire.dispatch("refreshComponent"), $("#reportrange").trigger("cancel.daterangepicker")
    })), $((function() {
      var e = null,
        t = null;

      function n(e, t) {
        e && t ? ($("#reportrange span").html(e.format("MMMM D, YYYY") + " - " + t.format("MMMM D, YYYY")), e = e
          .format("YYYY-MM-DD 00:00:00"), t = t.format("YYYY-MM-DD 23:59:59")) : $("#reportrange span").html(
          "Select a Date"), Livewire.dispatch("updateDateRangeComponent", {
          start: e,
          end: t
        })
      }
      $("#reportrange").daterangepicker({
        startDate: moment(),
        endDate: moment(),
        maxDate: moment(),
        ranges: {
          Today: [moment(), moment()],
          Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
          "Last 7 Days": [moment().subtract(6, "days"), moment()],
          "Last 30 Days": [moment().subtract(29, "days"), moment()],
          "This Month": [moment().startOf("month"), moment().endOf("month")],
          "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf(
            "month")]
        }
      }, (function(e, t) {
        n(e, t)
      })), n(e, t), $("#reportrange").on("apply.daterangepicker", (function(e, t) {
        n(t.startDate, t.endDate)
      })), $("#reportrange").on("cancel.daterangepicker", (function() {
        n(e = null, t = null)
      }))
    }));
  </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\xampp\htdocs\vscode\resources\views/components/list-card.blade.php ENDPATH**/ ?>