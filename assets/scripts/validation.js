(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation');

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            console.log('valid');
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })


    document.querySelectorAll("input:not([type=file]), textarea").forEach(element => {
        element.addEventListener('blur', (event) => {
            console.log(event.currentTarget.value = event.currentTarget.value.trim());
        });
    });
})();