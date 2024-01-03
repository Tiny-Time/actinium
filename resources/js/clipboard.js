document.addEventListener("alpine:init", () => {
    window.Alpine.magic("clipboard", () => (subject) => {
        const input = document.getElementById("shareUrl");

        if (typeof navigator !== "undefined" && navigator.clipboard) {
            const textToCopy = input.value;

            navigator.clipboard
                .writeText(textToCopy)
                .then(() => {})
                .catch((error) => {
                    console.error("Error copying to clipboard:", error);
                });
        } else {
            input.select();

            try {
                document.execCommand("copy");
            } catch (error) {
                console.error(error);
            }
        }
    });
});
