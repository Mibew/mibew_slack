var fs = require('fs'),
    https = require('https'),
    exec = require('child_process').exec,
    eventStream = require('event-stream'),
    gulp = require('gulp'),
    chmod = require('gulp-chmod'),
    zip = require('gulp-zip'),
    tar = require('gulp-tar'),
    gzip = require('gulp-gzip'),
    rename = require('gulp-rename');

var composer = require("gulp-composer"),
    gutils = require("gulp-util");

// ...

composer("init", { "no-interaction": true });
composer('require maknz/slack', {});

if (gutils.env.production) {
    composer({
        "bin":          "/build/share/composer.phar",
        "no-ansi":      true,
        "self-install": false,
    });
} else {
    //default install
    composer();
}

gulp.task('prepare-release', function() {
    var version = require('./package.json').version;

    return eventStream.merge(
        getSources()
            .pipe(zip('slack-' + version + '.zip')),
        getSources()
            .pipe(tar('slack-' + version + '.tar'))
            .pipe(gzip())
    )
    .pipe(chmod(0644))
    .pipe(gulp.dest('release'));
});

// Builds and packs plugins sources
gulp.task('default', ['prepare-release'], function() {
    // The "default" task is just an alias for "prepare-release" task.
});

/**
 * Returns files stream with the plugin sources.
 *
 * @returns {Object} Stream with VinylFS files.
 */
var getSources = function() {
    return gulp.src([
            'Plugin.php',
            'README.md',
            'LICENSE',
            './vendor/**/*.*'
        ],
        {base: './'}
    )
    .pipe(rename(function(path) {
        path.dirname = 'Mibew/Mibew/Plugin/Slack/' + path.dirname;
    }));
}
