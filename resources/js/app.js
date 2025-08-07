import "./bootstrap";

document.addEventListener("alpine:init", () => {
    Alpine.data("planSelection", () => ({
        plans: [],

        init() {
            this.plans = window.plansData || [];
        },
    }));
});

Alpine.start();
