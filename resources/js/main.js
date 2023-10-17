import e from "./event";

/* Event Timer/Counter functionality. */
document.addEventListener('alpine:init', () => {
    Alpine.data('authModal', () => ({
        openLoginModal: false,
        openSignUpModal: false,
        openForgotPasswordModal: false,
        openCreateTimerModal: false,

        toggle() {
            this.openLoginModal = !this.openLoginModal;
            this.openSignUpModal = !this.openSignUpModal;
        },
        forgotPassword() {
            this.openLoginModal = !this.openLoginModal;
            this.openForgotPasswordModal = !this.openForgotPasswordModal;
        },
        signIn() {
            this.openForgotPasswordModal = !this.openForgotPasswordModal;
            this.openLoginModal = !this.openLoginModal;
        }
    }));

    Alpine.store('openCreateTimerModal', {
        on: false,

        toggle() {
            this.on = !this.on
        }
    });

    Alpine.store('counter', {
        on: false,

        toggle() {
            this.on = !this.on
        }
    });

    Alpine.store('playBtn', {
        on: true,

        toggle() {
            this.on = !this.on
        }
    });
});

// Event object.
window.e = e;
