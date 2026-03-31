function deActiveForms() {
    var forms = document.querySelectorAll('form');
    forms.forEach(form => {
        setTimeout(() => {
            form.addEventListener('submit', e => {
                e.preventDefault();
            });
        }, 200)
    });
}
deActiveForms();