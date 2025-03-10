export const copyPassword = () => {
    const passwordInput = document.getElementById('password_input');
    passwordInput.select();
    passwordInput.setSelectionRange(0, 99999);

    try {
        if (navigator.clipboard) {
            navigator.clipboard.writeText(passwordInput.value)
                .then(() => {
                    alert('Contraseña copiada al portapapeles');
                })
                .catch((err) => {
                    console.error('Falló al copiar: ', err);
                    fallbackCopyText(passwordInput.value);
                });
        } else {
            fallbackCopyText(passwordInput.value);
        }
    } catch (err) {
        console.error('Falló al copiar: ', err);
    }
};

const fallbackCopyText = (text) => {
    const textarea = document.createElement('textarea');
    textarea.value = text;
    document.body.appendChild(textarea);
    textarea.select();
    try {
        document.execCommand('copy');
        alert('Contraseña copiada al portapapeles');
    } catch (err) {
        console.error('Falló al copiar usando el método alternativo: ', err);
    } finally {
        document.body.removeChild(textarea);
    }
};