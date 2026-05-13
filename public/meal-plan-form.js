(function () {
    const container = document.querySelector('[data-meals-container]');
    const addButton = document.querySelector('[data-add-meal]');
    const template = document.querySelector('[data-meal-template]');

    if (!container || !addButton || !template) {
        return;
    }

    const updateMealIndexes = () => {
        const fieldsets = container.querySelectorAll('[data-meal-fieldset]');

        fieldsets.forEach((fieldset, index) => {
            const legend = fieldset.querySelector('legend');

            if (legend) {
                legend.textContent = `Refeicao ${index + 1}`;
            }

            fieldset.querySelectorAll('[data-meal-input]').forEach((input) => {
                input.name = `meals[${index}][${input.dataset.mealInput}]`;
            });

            const removeButton = fieldset.querySelector('[data-remove-meal]');

            if (removeButton) {
                removeButton.hidden = fieldsets.length === 1;
            }
        });
    };

    addButton.addEventListener('click', () => {
        const fragment = template.content.cloneNode(true);

        container.appendChild(fragment);
        updateMealIndexes();

        const lastFieldset = container.querySelector('[data-meal-fieldset]:last-child');
        lastFieldset?.querySelector('input')?.focus();
    });

    container.addEventListener('click', (event) => {
        const removeButton = event.target.closest('[data-remove-meal]');

        if (!removeButton) {
            return;
        }

        const fieldsets = container.querySelectorAll('[data-meal-fieldset]');

        if (fieldsets.length === 1) {
            return;
        }

        removeButton.closest('[data-meal-fieldset]')?.remove();
        updateMealIndexes();
    });

    updateMealIndexes();
})();
