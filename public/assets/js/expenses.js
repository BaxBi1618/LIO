document.addEventListener('DOMContentLoaded', () => {
    const monthElement = document.getElementById('monthNameDiv');
    const monthNames = [
        "Styczeń", "Luty", "Marzec", "Kwiecień",
        "Maj", "Czerwiec", "Lipiec", "Sierpień",
        "Wrzesień", "Październik", "Listopad", "Grudzień"
    ];

    const now = new Date();
    monthElement.textContent = monthNames[now.getMonth()];
});