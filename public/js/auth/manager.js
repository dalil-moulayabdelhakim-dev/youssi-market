const roleSelect2 = document.getElementById('roleSelect');
if (roleSelect2) {
    roleSelect2.addEventListener('change', function () {
        var role = roleSelect2.value;
        const specialtyContainer = document.getElementById('specialtyContainer');
        const genderContainer = document.getElementById('genserContainer');
        const privacyContainer = document.getElementById('privacyContainer');
        const agreementContainer = document.getElementById('agreementContainer');

        if (role == 2) {
            agreementContainer.style.display = 'none';
            specialtyContainer.style.display = 'none';
            genderContainer.style.display = 'none';
            privacyContainer.style.display = 'none';

            agreementContainer.children[1].removeAttribute('required');
            genderContainer.children[1].removeAttribute('required');
            privacyContainer.children[1].removeAttribute('required');
            specialtyContainer.children[1].removeAttribute('required');
        } else {
            if (role != 3) {
                agreementContainer.style.display = 'unset';
                specialtyContainer.style.display = 'none';
                genderContainer.style.display = 'none';
                privacyContainer.style.display = 'none';

                agreementContainer.children[1].setAttribute('required', '');
                specialtyContainer.children[1].removeAttribute('required');
                genderContainer.children[1].removeAttribute('required');
                privacyContainer.children[1].removeAttribute('required');
            } else {
                specialtyContainer.style.display = 'unset';
                genderContainer.style.display = 'unset';
                privacyContainer.style.display = 'unset';


                specialtyContainer.children[1].setAttribute('required', '');
                genderContainer.children[1].setAttribute('required', '');
                privacyContainer.children[1].setAttribute('required', '');

                var privacy = privacySelect.value;
                if (privacy == 1) {
                    agreementContainer.style.display = 'none';
                    agreementContainer.children[1].removeAttribute('required');
                } else {
                    agreementContainer.style.display = 'unset';
                    agreementContainer.children[1].setAttribute('required', '');
                }
            }
        }
    });
}
const privacySelect2 = document.getElementById('privacySelect');
if (privacySelect2) {
    privacySelect2.addEventListener('change', function () {
        var privacy = privacySelect2.value;
        const agreementContainer = document.getElementById('agreementContainer');

        if (privacy != 2) {
            agreementContainer.style.display = 'none';
            agreementContainer.children[1].removeAttribute('required');
        } else {
            agreementContainer.style.display = 'unset';
            agreementContainer.children[1].setAttribute('required', '');
        }
    });
}


//home
function mLogout() {
    var form = document.createElement('form');
    form.action = "logout";
    form.method = 'POST';

    var submit = document.getElementById('submit');
    var csrfToken = submit.getAttribute('data-csrf')

    var csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    csrfInput.autocomplete = 'off';

    form.appendChild(csrfInput);

    document.body.appendChild(form);
    form.submit();
}


//password tooltip
const passwordTooltip = document.getElementById('passwordTooltip');
const pass2 = document.getElementById('password');
if (pass2) {
    pass2.addEventListener('focus', function () {
        passwordTooltip.style.display = 'block';
    });

    pass2.addEventListener('blur', function () {
        passwordTooltip.style.display = 'none';
    });
}


function verifyEmail() {
    const form = getElementById('verifyEmailForm');
    form.submit;
}

function showAlertWithRedirect(message, redirectUrl, data) {
    // Set the alert message in the modal
    document.getElementById('alert-message').textContent = message;


    if ( data == false ) {
        // Add custom action logic when the "OK" button is clicked
        document.getElementById('redirectBtn').setAttribute('href', redirectUrl)
        // Show the Bootstrap modal
        $('#customAlertModal').modal('show');
    }

}

// Example usage
document.addEventListener('DOMContentLoaded', function () {
    const elem = document.getElementById('alert-message');
    if (elem != null) {
        const data = elem.getAttribute('data-user');
    showAlertWithRedirect('We have sent a verification link to your email, check your inbox', 'http://mail.google.com/', data);
    }
});
