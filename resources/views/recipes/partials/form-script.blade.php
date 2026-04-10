<script>
    document.addEventListener('DOMContentLoaded', function () {
        const stepsWrapper = document.getElementById('steps-wrapper');
        const addStepButton = document.getElementById('add-step');
        const form = document.getElementById('{{ $formId }}');
        let submitting = false;

        if (!form) {
            return;
        }

        const getFormSnapshot = () => {
            return JSON.stringify(
                Array.from(new FormData(form).entries())
                    .filter(([name]) => name !== '_token' && name !== '_method')
            );
        };

        let initialSnapshot = getFormSnapshot();

        const hasUnsavedChanges = () => !submitting && getFormSnapshot() !== initialSnapshot;

        window.addEventListener('beforeunload', function (event) {
            if (!hasUnsavedChanges()) {
                return;
            }

            event.preventDefault();
            event.returnValue = '';
        });

        document.addEventListener('click', function (event) {
            const link = event.target.closest('a[href]');

            if (!link || !hasUnsavedChanges()) {
                return;
            }

            const shouldLeave = window.confirm('Discard unsaved changes and leave this page?');

            if (!shouldLeave) {
                event.preventDefault();
            }
        });

        form.addEventListener('submit', function () {
            submitting = true;
        });

        if (!stepsWrapper || !addStepButton) {
            return;
        }

        const renumberSteps = () => {
            const rows = stepsWrapper.querySelectorAll('.step-row');
            rows.forEach((row, index) => {
                const badge = row.querySelector('.step-number');
                if (badge) {
                    badge.textContent = index + 1;
                }
            });
        };

        const createStepRow = (value = '') => {
            const row = document.createElement('div');
            row.className = 'step-row flex items-start gap-3';
            row.innerHTML = `
                <span class="step-number mt-2 inline-flex h-8 w-8 items-center justify-center rounded-full bg-orange-100 text-orange-700 text-xs font-black">0</span>
                <input
                    type="text"
                    name="steps[]"
                    value="${value.replace(/"/g, '&quot;')}"
                    placeholder="e.g. Heat oil in a pan over medium heat..."
                    class="flex-1 px-4 py-3 rounded-2xl border-2 border-slate-200 focus:border-orange-500 focus:ring-0 transition"
                    required
                >
                <button type="button" class="remove-step mt-1 px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition-colors">
                    Remove
                </button>
            `;

            return row;
        };

        addStepButton.addEventListener('click', function () {
            stepsWrapper.appendChild(createStepRow(''));
            renumberSteps();
        });

        const publishButton = document.querySelector('.js-publish-btn');
        if (publishButton) {
            publishButton.addEventListener('click', function (event) {
                const shouldPublish = window.confirm('Are you sure you want to publish this recipe now?');

                if (!shouldPublish) {
                    submitting = false;
                    event.preventDefault();
                }
            });
        }

        stepsWrapper.addEventListener('click', function (event) {
            const target = event.target;
            if (!target.classList.contains('remove-step')) {
                return;
            }

            const rows = stepsWrapper.querySelectorAll('.step-row');
            if (rows.length === 1) {
                const input = rows[0].querySelector('input[name="steps[]"]');
                if (input) {
                    input.value = '';
                    input.focus();
                }
                return;
            }

            const row = target.closest('.step-row');
            if (row) {
                row.remove();
                renumberSteps();
            }
        });

        renumberSteps();
        initialSnapshot = getFormSnapshot();
    });
</script>
