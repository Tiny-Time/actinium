const glob = require("glob");

function getThemeFiles() {
    return glob.sync("resources/views/themes/**/{*.css,*.js}");
}

module.exports = getThemeFiles;
