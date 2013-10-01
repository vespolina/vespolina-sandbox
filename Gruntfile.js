module.exports = function (grunt) {
    grunt.initConfig({
        shell: {
            tests: {
                command: [
                    'clear',
                    'bin/behat -v --ansi'
                ].join('&&'),
                options: {
                    stdout: true
                }
            },
            specs: {
                command: [
                    'clear',
                    'php bin/phpspec run -v -n --ansi'
                ].join('&&'),
                options: {
                    stdout: true
                }
            }
        },
        watch: {
            tests: {
                files: ['{lib,src,spec,features}/**/*.{php,feature}'],
                tasks: ['shell:tests']
            },
            specs: {
                files: ['{lib,src,spec,features}/**/*.{php,feature}'],
                tasks: ['shell:specs']
            }
        }
    });

    // plugins
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-shell');

    // tasks
    grunt.registerTask('tests', ['shell:tests', 'watch:tests']);
    grunt.registerTask('specs', ['shell:specs', 'watch:specs']);
};