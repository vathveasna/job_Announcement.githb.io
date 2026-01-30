
document.addEventListener('DOMContentLoaded', function() {
    // 1. Smooth Count Up for "Positions Found"
    const badge = document.querySelector('.bg-custom-badge');
    if (badge) {
        const count = parseInt(badge.innerText);
        let start = 0;
        const duration = 1000;
        const increment = count / (duration / 16);
        
        const timer = setInterval(() => {
            start += increment;
            if (start >= count) {
                badge.innerHTML = Math.floor(count) + " Positions Found";
                clearInterval(timer);
            } else {
                badge.innerHTML = Math.floor(start) + " Positions Found";
            }
        }, 16);
    }

    // 2. Button Hover Sparkle Effect (Simple scale)
    const buttons = document.querySelectorAll('.btn-custom-primary');
    buttons.forEach(btn => {
        btn.addEventListener('mouseenter', () => {
            btn.style.transition = "transform 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275)";
            btn.style.transform = "scale(1.05)";
        });
        btn.addEventListener('mouseleave', () => {
            btn.style.transform = "scale(1)";
        });
    });
});