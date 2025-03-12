import './bootstrap';
import { copyPassword } from './utils/copyPassword';

document.addEventListener('DOMContentLoaded', () => {
    const copyButton = document.querySelectorAll(`[data-copy-button]`);

    copyButton.forEach(button => {
        button.addEventListener('click', copyPassword);
    });
});