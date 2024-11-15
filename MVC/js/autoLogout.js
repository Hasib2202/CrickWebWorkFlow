// autoLogout.js
class AutoLogout {
  constructor(timeout = 180000) {
    // 1 minute
    this.timeout = timeout;
    this.warningTimeout = 30000; // Show warning 30 seconds before logout
    this.timer = null;
    this.warningTimer = null;
    this.lastActivity = new Date();

    // Ensure initialization after DOM is fully loaded
    if (document.readyState === "loading") {
      document.addEventListener("DOMContentLoaded", () => this.init());
    } else {
      this.init();
    }
  }

  init() {
    this.createWarningModal();
    this.addEventListeners();
    this.startTimer();
    console.log("AutoLogout initialized"); // Debug log
  }

  createWarningModal() {
    const modal = document.createElement("div");
    modal.innerHTML = `
            <div class="modal fade" id="logoutWarningModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Session Timeout Warning</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p>Your session will expire in 30 seconds due to inactivity.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Continue Session</button>
                        </div>
                    </div>
                </div>
            </div>`;
    document.body.appendChild(modal);

    this.warningModal = new bootstrap.Modal(
      document.getElementById("logoutWarningModal")
    );
  }

  addEventListeners() {
    const events = [
      "mousemove",
      "mousedown",
      "keypress",
      "scroll",
      "touchstart",
    ];

    events.forEach((event) => {
      document.addEventListener(event, () => this.resetTimer());
    });

    // Reset timer when warning modal is dismissed
    document
      .getElementById("logoutWarningModal")
      .addEventListener("hidden.bs.modal", () => {
        this.resetTimer();
      });
  }

  startTimer() {
    this.timer = setTimeout(
      () => this.showWarning(),
      this.timeout - this.warningTimeout
    );
    this.warningTimer = setTimeout(() => this.logout(), this.timeout);
  }

  resetTimer() {
    clearTimeout(this.timer);
    clearTimeout(this.warningTimer);
    this.warningModal?.hide();
    this.startTimer();
  }

  showWarning() {
    this.warningModal.show();
  }

  async logout() {
    try {
      const response = await fetch(
        "../Controllers/UserController.php?action=logout",
        {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
        }
      );

      if (response.ok) {
        window.location.href = "../Views/login.php";
      }
    } catch (error) {
      console.error("Logout failed:", error);
      window.location.href = "../Views/login.php";
    }
  }
}
