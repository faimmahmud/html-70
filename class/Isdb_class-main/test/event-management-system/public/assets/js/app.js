document.addEventListener("DOMContentLoaded", () => {
    const nav = document.getElementById("premiumNav");
    const revealItems = document.querySelectorAll(".reveal");

    const onScroll = () => {
        if (window.scrollY > 20) {
            nav?.classList.add("scrolled");
        } else {
            nav?.classList.remove("scrolled");
        }
    };

    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15 }
    );

    revealItems.forEach((el) => observer.observe(el));
});
