
const ownerCreatePass = document.querySelector('#owner-create-pass');
const ownerConfirmPass = document.querySelector('#owner-confirm-pass');

function checkPasswordMatch() {
    if (ownerCreatePass.value !== ownerConfirmPass.value) {
        ownerConfirmPass.parentElement.classList.add('error');
    } else {
        ownerConfirmPass.parentElement.classList.remove('error');
    }
}

ownerConfirmPass.addEventListener('input', checkPasswordMatch);
