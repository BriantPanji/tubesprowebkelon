function toggleClass(element, classList) {
    if (Array.isArray(element)) {
        element.forEach((i) => {
            classList.forEach((j) => {
                i.classList.toggle(j);
            });
        });
    } else {
        classList.forEach((i) => {
            element.classList.toggle(i);
        });
    }
}
 
const sidebar = document.querySelector('#sidebar');
const sided = sidebar.querySelector(".sidebar");
const sidebarBg = sidebar.querySelector('.blurred');
let sideBtn = [];
sideBtn.push(document.querySelector('#sideBtn'));
sideBtn.push(document.querySelector('#sideBtnMbl'));

sideBtn.forEach((btn) => {
    btn.addEventListener('click', () => {
        if (sidebar.classList.contains('sidebarOn')) {
            toggleClass(sidebar, ['sidebarOn', 'sidebarOff']);
            toggleClass(document.body, ['overflow-hidden']);
        } else {
            toggleClass(sidebar, ['sidebarOff', 'sidebarOn']);
            toggleClass(document.body, ['overflow-hidden']);
        }
    });
});

sidebarBg.addEventListener('click', () => {
    if (sidebar.classList.contains('sidebarOn')) {
        toggleClass(sidebar, ['sidebarOn', 'sidebarOff']);
        toggleClass(document.body, ['overflow-hidden']);
    } else {
        toggleClass(sidebar, ['sidebarOff', 'sidebarOn']);
        toggleClass(document.body, ['overflow-hidden']);
    }
});
