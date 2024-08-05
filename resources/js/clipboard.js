import $ from "jquery";
window.jQuery = window.$ = $;

document.addEventListener('alpine:init', () => {
    window.Alpine.magic('clipboard', () => (subject, isShareURL) => {
        if (isShareURL) {
            subject = $('#shareUrl').val();
        }

        copyToClipboard(subject);
    });
});


function copyToClipboard(subject) {
    if (typeof navigator !== 'undefined' && navigator.clipboard) {
        navigator.clipboard.writeText(subject)
            .then(() => {
                $('#copied').removeClass('hidden');
                setTimeout(() => {
                    $('#copied').addClass('hidden');
                }, 5000);
                console.log('Copied to clipboard 1');
            })
            .catch(error => {
                console.error('Error copying to clipboard:', error);
            });
    } else {

        try {
            // Copy subject to clipboard
            const el = document.createElement('textarea');
            el.value = subject;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            $('#copied').removeClass('hidden');
            setTimeout(() => {
                $('#copied').addClass('hidden');
            }, 5000);
            console.log('Copied to clipboard 2');
        } catch (error) {
            console.error(error);
        }
    }
}
