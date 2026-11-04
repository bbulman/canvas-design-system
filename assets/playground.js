document.getElementById('copy-component-code').addEventListener('click', async () => {
    const code = document.getElementById('component-code');
    const status = document.getElementById('copy-status');
    try {
        await navigator.clipboard.writeText(code.textContent);
        status.textContent = 'PHP copied.';
    } catch (error) {
        const selection = window.getSelection();
        const range = document.createRange();
        range.selectNodeContents(code);
        selection.removeAllRanges();
        selection.addRange(range);
        status.textContent = 'Copy the selected PHP with your keyboard.';
    }
});
