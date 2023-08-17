document.addEventListener('alpine:init', () => {
    window.Alpine.magic('clipboard', () => subject => {
        if (typeof navigator !== 'undefined' && navigator.clipboard) {
            navigator.clipboard.writeText(subject)
                .then(() => {
                    alert('Text copied to clipboard');
                })
                .catch(error => {
                    console.error('Error copying to clipboard:', error);
                });
        } else {
            const input = document.getElementById('shareUrl');
            input.select();

            try {
                document.execCommand('copy');
                alert('Text copied to clipboard');
            } catch (error) {
                console.error(error);
            }
        }
    });
});
