document.addEventListener('alpine:init', () => {
    window.Alpine.magic('clipboard', () => subject => {
        if (typeof navigator !== 'undefined' && navigator.clipboard) {
            navigator.clipboard.writeText(subject)
                .then(() => {
                    console.log('Text copied to clipboard:', subject);
                })
                .catch(error => {
                    console.error('Error copying to clipboard:', error);
                });
        } else {
            try {
                document.execCommand('copy');
                console.log('Text copied to clipboard:', subject);
            } catch (error) {
                console.error(error);
            } finally {
                textarea.remove();
            }
        }
    });
});
