
module.exports = function(grunt) {

    // load all grunt tasks
    require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

    grunt.initConfig({

        // watch for changes and trigger compass, jshint, uglify and livereload
        watch: {
            js: {
                files: ['js/*.js', 'api/js/lib/*.js', 'api/js/src/*.js'],
                tasks: ['uglify']
            },
            css: {
                files: ['css/*.scss', 'api/css/*.scss'],
                tasks: ['sass'],
                options: {
                    livereload: true
                }
            }
        },

        // we use the Sass
        sass: {
            dist: {
                options: {
                    // nested, compact, compressed, expanded
                    style: 'compressed'
                },
                files: {
                    'css/main.css': 'css/main.scss',
                    'api/css/widget.css': 'api/css/widget.scss'
                }
            }
        },

        // uglify to concat, minify, and make source maps
        uglify: {
            dist: {
                files: {
                    // minify site assets
                    'js/main.min.js': 'js/main.js',

                    // minify widget assets
                    'api/js/widget.js': [
                        'api/js/lib/jquery.js',
                        'api/js/lib/jquery-map.js',
                        'api/js/src/api.js',
                        'api/js/src/widget-overlay.js',
                        'api/js/src/widget-toolbox.js',
                        'api/js/src/widget-errors.js',
                        'api/js/src/widget-search.js',
                        'api/js/src/widget-markers.js',
                        'api/js/src/widget.js'
                    ],
                }
            }
        }

    });

    // register task
    grunt.registerTask('default', ['watch']);
};