import "./bootstrap";

document.addEventListener("alpine:init", () => {
    Alpine.data("planSelection", () => ({
        selectedPlan: null,
        plans: [],

        init() {
            this.plans = window.plansData || [];
            this.selectedPlan = this.plans.find((plan) => plan.default);
        },

        isSelected(plan) {
            return this.selectedPlan === plan;
        },

        getMonthFromSlug(slug) {
            return Array.from(slug)[0];
        },

        getBillingPeriod(slug) {
            let billingPeriod = this.getMonthFromSlug(slug);

            return billingPeriod > 1
                ? `Billed every ${billingPeriod} months`
                : `Billed every month`;
        },

        formatPrice(price) {
            return `€${price.toFixed(2)}`;
        },

        getMonthlyPrice(plan) {
            let numberOfMonths = parseInt(this.getMonthFromSlug(plan.slug));
            let pricePerMonth = plan.pricing["price"] / numberOfMonths;
            return this.formatPrice(pricePerMonth);
        },

        handleOrder() {
            window.location.href = this.selectedPlan.order_route;
        },
    }));

    Alpine.data("countdownBanner", () => ({
        timeLeft: 0,
        hours: 0,
        minutes: 0,
        seconds: 0,
        interval: null,

        init() {
            this.initializeCountdown();
            this.startCountdown();
        },

        initializeCountdown() {
            const startTimeKey = "countdown_start_time";
            let startTime = sessionStorage.getItem(startTimeKey);

            if (!startTime) {
                startTime = Date.now();
                sessionStorage.setItem(startTimeKey, startTime);
            } else {
                startTime = parseInt(startTime);
            }

            const duration = 2 * 60 * 60 * 1000;
            const elapsed = Date.now() - startTime;
            this.timeLeft = Math.max(0, duration - elapsed);

            this.updateDisplay();
        },

        startCountdown() {
            this.interval = setInterval(() => {
                if (this.timeLeft > 0) {
                    this.timeLeft -= 1000;
                    this.updateDisplay();
                } else {
                    this.stopCountdown();
                }
            }, 1000);
        },

        stopCountdown() {
            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
        },

        updateDisplay() {
            const totalSeconds = Math.floor(this.timeLeft / 1000);
            this.hours = Math.floor(totalSeconds / 3600);
            this.minutes = Math.floor((totalSeconds % 3600) / 60);
            this.seconds = totalSeconds % 60;
        },

        formatTime(value) {
            return value.toString().padStart(2, "0");
        },
    }));
});

Alpine.start();
