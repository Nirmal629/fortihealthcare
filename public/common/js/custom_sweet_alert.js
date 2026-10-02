let swalSettings;

function initializeSwal() {
  swalSettings = {
    success: { icon: "success", confirmButtonColor: "#3085d6" },
    error: { icon: "error", confirmButtonColor: "#d33" },
    warning: { icon: "warning", confirmButtonColor: "#f1c40f" },
    info: { icon: "info", confirmButtonColor: "#3498db" },
    confirm: {
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#0acf97",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes",
      cancelButtonText: "Cancel"
    }
  };
}

function loadSwalCDN() {
  initializeSwal();
  if (typeof Swal !== 'undefined') {
    return;
  }
  const currentScript = document.currentScript || Array.from(document.scripts).find(s => s.src && s.src.includes('custom_sweet_alert.js'));
  let swalSrc = '/public/common/js/sweetalert2.min.js';
  if (currentScript && currentScript.src) {
    swalSrc = currentScript.src.replace('custom_sweet_alert.js', 'sweetalert2.min.js');
  }

  const script = document.createElement('script');
  script.src = swalSrc;
  script.async = false;
  script.onload = initializeSwal;
  document.head.appendChild(script);
}

loadSwalCDN();

function swalNotify(title, message, type) {
  if (!swalSettings) initializeSwal();
  const settings = swalSettings ? (swalSettings[type] || {}) : {};
  if (typeof Swal === 'undefined') {
    alert(title + ': ' + message);
    return Promise.resolve();
  }
  return Swal.fire({ title: title, text: message, ...settings });
}

function swalConfirm(title, message) {
  if (!swalSettings) initializeSwal();
  const settings = swalSettings ? swalSettings.confirm : {};
  if (typeof Swal === 'undefined') {
    const confirmed = confirm(title + '\n' + message);
    return Promise.resolve({ isConfirmed: confirmed });
  }
  return Swal.fire({ title: title, text: message, ...settings });
}
