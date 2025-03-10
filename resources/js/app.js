import './bootstrap';
import { copyPassword } from './utils/copyPassword';

document.addEventListener('DOMContentLoaded', () => {
    const copyButton = document.getElementById('copyButton');
    if (copyButton) {
        copyButton.addEventListener('click', copyPassword);
    }
});