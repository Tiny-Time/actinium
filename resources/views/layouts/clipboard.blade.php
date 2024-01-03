<script>
    document.addEventListener('alpine:init', () => {
        const input = document.getElementById('shareUrl');

        window.Alpine.magic('clipboard', () => subject => {
            const textToCopy = input.value;

            if (typeof navigator !== 'undefined' && navigator.clipboard) {
                navigator.clipboard.writeText(textToCopy)
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
