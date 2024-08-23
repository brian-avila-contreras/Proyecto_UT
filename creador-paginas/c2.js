const savePageBtn = document.getElementById('savePage');
const pageNameInput = document.getElementById('pageName');
const sectionsContainer = document.getElementById('sectionsContainer');
let sectionCount = 0;

document.addEventListener('DOMNodeInserted', (event) => {
    if (event.target.classList && event.target.classList.contains('section')) {
        sectionCount++;
        checkConditions();
    }
});

pageNameInput.addEventListener('input', checkConditions);
sectionsContainer.addEventListener('input', checkConditions);

function checkConditions() {
    const pageName = pageNameInput.value.trim();
    const validName = /^[a-z0-9]{1,20}$/.test(pageName);
    const allSections = sectionsContainer.querySelectorAll('.section');
    let allFieldsFilled = true;
    let emptyFieldsCount = 0;
    let sectionWarnings = [];

    allSections.forEach((section, index) => {
        const inputs = section.querySelectorAll('input[required], textarea[required], select[required]');
        let sectionHasEmptyFields = false;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                allFieldsFilled = false;
                sectionHasEmptyFields = true;
                emptyFieldsCount++;
            }
        });

        if (sectionHasEmptyFields) {
            sectionWarnings.push(`La sección ${index + 1} tiene campos vacíos.`);
        }
    });

    let message = '';
    if (!validName) {
        message = 'El nombre de la página no es válido';
    } else if (sectionCount < 3) {
        message = `Faltan ${3 - sectionCount} secciones`;
    } else if (!allFieldsFilled) {
        message = sectionWarnings.join(' ');
    } else {
        message = 'Guardar página';
    }

    savePageBtn.innerText = message;
    savePageBtn.disabled = !(sectionCount >= 3 && validName && allFieldsFilled);
}