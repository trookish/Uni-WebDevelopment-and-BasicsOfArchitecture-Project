const banner = document.getElementById('banner');
let isDragging = false;
let startX;

banner.addEventListener('wheel', (e) => {
    e.preventDefault();
    banner.scrollLeft += e.deltaY * 0.3;
});

banner.addEventListener('mousedown', (e) => {
    isDragging = true;
    startX = e.pageX - banner.offsetLeft;
    banner.style.cursor = 'grabbing';
});

banner.addEventListener('mouseup', () => {
    isDragging = false;
    banner.style.cursor = 'grab';
});

banner.addEventListener('mousemove', (e) => {
    if (!isDragging) return;
    e.preventDefault();
    const x = e.pageX - banner.offsetLeft;
    const walk = x - startX;
    banner.scrollLeft -= walk;
    startX = x;
});
