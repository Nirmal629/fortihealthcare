function loadiziToast() {
    var script = document.createElement("script");
    script.setAttribute(
        "src",
        "https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js"
    );
    script.async = true;
    script.onload = initializeIziToast; // Initialize iziToast settings after loading
    document.head.appendChild(script);

    // Load iziToast CSS
    var link = document.createElement("link");
    link.setAttribute("rel", "stylesheet");
    link.setAttribute(
        "href",
        "https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css"
    );
    document.head.appendChild(link);
}

// Load iziToast
loadiziToast();

let iziToastSettings;

const iziToastDefaultSettings = {
    theme: "dark",
    // position: "topRight",
    position: "center",
    progressBarColor: "#28a745",
    backgroundColor: "#28a745",
    messageColor: "#ffffff",
    titleColor: "#ffffff",
    timeout: 3000,
};

function initializeIziToast() {
    iziToastSettings = {
        success: { ...iziToastDefaultSettings, icon: "ri-check-line" },
        error: {
            ...iziToastDefaultSettings,
            icon: "ri-close-circle-line",
            progressBarColor: "#dc3545",
            backgroundColor: "#dc3545",
        },
        warning: {
            ...iziToastDefaultSettings,
            icon: "ri-error-warning-line",
            progressBarColor: "#ffc107",
            backgroundColor: "#ffc107",
        },
        info: {
            ...iziToastDefaultSettings,
            icon: "ri-information-line",
            progressBarColor: "#17a2b8",
            backgroundColor: "#17a2b8",
        },
        confirm: {
            theme: "dark",
            icon: "ri-error-warning-line",
            position: "center",
            progressBarColor: "#0acf97",
            backgroundColor: "#333",
            messageColor: "#ffffff",
            titleColor: "#ffffff",
            buttons: [
                [
                    "<button>Yes</button>",
                    (instance, toast) =>
                        instance.hide(
                            { transitionOut: "fadeOut" },
                            toast,
                            "confirm"
                        ),
                    true,
                ],
                [
                    "<button>Cancel</button>",
                    (instance, toast) =>
                        instance.hide(
                            { transitionOut: "fadeOut" },
                            toast,
                            "cancel"
                        ),
                ],
            ],
        },
    };
}

function iziNotify(title, message, type) {
    if (message && typeof message === 'string' && message.toLowerCase().includes('pan india')) {
        if (typeof window.showPanIndiaToast === 'function') {
            window.showPanIndiaToast(message);
            return;
        }
    }
    const settings = (typeof iziToastSettings !== 'undefined' && iziToastSettings[type]) ? iziToastSettings[type] : {};
    if (window.iziToast) {
        iziToast.show({
            title: title,
            message: message,
            ...settings,
        });
    }
}

// Professional PAN India Delivery Toast Component
(function() {
    let toastTimer = null;
    let toastActive = false;
    let lastToastTime = 0;

    window.showPanIndiaToast = function(customMessage) {
        const now = Date.now();
        const container = document.getElementById('panIndiaToastContainer') || createContainer();
        const existing = document.getElementById('panIndiaActiveToast');

        if (existing && toastActive) {
            existing.classList.remove('pan-toast-shake');
            void existing.offsetWidth; // trigger reflow
            existing.classList.add('pan-toast-shake');
            resetProgress(existing);
            return;
        }

        if (now - lastToastTime < 900) {
            return;
        }
        lastToastTime = now;

        const messageText = customMessage || "This is a PAN india company, deliveries restricted to India Only";

        if (existing) {
            existing.remove();
        }

        const toastEl = document.createElement('div');
        toastEl.id = 'panIndiaActiveToast';
        toastEl.className = 'pan-india-toast-card';
        toastEl.setAttribute('role', 'alert');
        toastEl.setAttribute('aria-live', 'assertive');

        toastEl.innerHTML = `
            <div class="pan-india-toast-content">
                <div class="pan-india-toast-icon-wrap">
                    <span class="material-symbols-outlined">local_shipping</span>
                </div>
                <div class="pan-india-toast-text">
                    <div class="pan-india-toast-badge">
                        <span>PAN INDIA ONLY</span>
                    </div>
                    <div class="pan-india-toast-title">Delivery Restriction</div>
                    <p class="pan-india-toast-msg">${messageText}</p>
                </div>
                <button type="button" class="pan-india-toast-close" aria-label="Close" title="Dismiss">&times;</button>
            </div>
            <div class="pan-india-toast-progress-track">
                <div class="pan-india-toast-progress-bar"></div>
            </div>
        `;

        container.appendChild(toastEl);
        toastActive = true;

        const closeBtn = toastEl.querySelector('.pan-india-toast-close');
        if (closeBtn) {
            closeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                dismissToast(toastEl);
            });
        }

        toastEl.addEventListener('mouseenter', function() {
            pauseToast(toastEl);
        });
        toastEl.addEventListener('mouseleave', function() {
            resumeToast(toastEl);
        });

        startProgress(toastEl, 4500);
    };

    function createContainer() {
        let container = document.getElementById('panIndiaToastContainer');
        if (!container) {
            container = document.createElement('div');
            container.id = 'panIndiaToastContainer';
            container.className = 'pan-india-toast-container';
            document.body.appendChild(container);
        }
        return container;
    }

    function startProgress(toastEl, duration) {
        const progressBar = toastEl.querySelector('.pan-india-toast-progress-bar');
        if (!progressBar) return;

        progressBar.style.transition = `width ${duration}ms linear`;
        progressBar.style.width = '100%';

        requestAnimationFrame(() => {
            requestAnimationFrame(() => {
                progressBar.style.width = '0%';
            });
        });

        clearTimeout(toastTimer);
        toastTimer = setTimeout(() => {
            dismissToast(toastEl);
        }, duration);
    }

    function resetProgress(toastEl) {
        clearTimeout(toastTimer);
        startProgress(toastEl, 4500);
    }

    function pauseToast(toastEl) {
        clearTimeout(toastTimer);
        const progressBar = toastEl.querySelector('.pan-india-toast-progress-bar');
        if (progressBar) {
            const computedWidth = window.getComputedStyle(progressBar).width;
            progressBar.style.transition = 'none';
            progressBar.style.width = computedWidth;
        }
    }

    function resumeToast(toastEl) {
        startProgress(toastEl, 2500);
    }

    function dismissToast(toastEl) {
        if (!toastEl || toastEl.classList.contains('pan-toast-closing')) return;
        clearTimeout(toastTimer);
        toastEl.classList.add('pan-toast-closing');
        toastEl.addEventListener('animationend', function() {
            toastEl.remove();
            toastActive = false;
        }, { once: true });
        setTimeout(() => {
            if (toastEl.parentNode) {
                toastEl.remove();
                toastActive = false;
            }
        }, 350);
    }
})();

function iziConfirm(title, message) {
    return new Promise((resolve) => {
        const settings = iziToastSettings.confirm;
        iziToast.question({
            title: title,
            message: message,
            ...settings,
            onClosing: function (instance, toast, closedBy) {
                resolve(closedBy === "confirm");
            },
        });
    });
}
