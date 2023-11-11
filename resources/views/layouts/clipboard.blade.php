<script>
    document.addEventListener('alpine:init', () => {
        window.Alpine.magic('clipboard', () => subject => {
            if (typeof navigator !== 'undefined' && navigator.clipboard) {
                navigator.clipboard.writeText(subject)
                    .then(() => {
                        $('#copied').removeClass('hidden');
                        setTimeout(() => {
                            $('#copied').addClass('hidden');
                        }, 5000);
                    })
                    .catch(error => {
                        console.error('Error copying to clipboard:', error);
                    });
            } else {
                const input = document.getElementById('shareUrl');
                input.select();

                try {
                    document.execCommand('copy');
                    $('#copied').removeClass('hidden');
                    setTimeout(() => {
                        $('#copied').addClass('hidden');
                    }, 5000);
                } catch (error) {
                    console.error(error);
                }
            }
        });
    });
</script>
