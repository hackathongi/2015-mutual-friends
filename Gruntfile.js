/* global module, require */
module.exports = function(grunt){

    require('load-grunt-tasks')(grunt);

    // Init some params to run our tasks
    grunt.params = {
        dependencies: {
            // Define the Bower components directory (where bower stores the libraries)
            folder: 'bower_components/'
        }
    };

    grunt.initConfig({

        // Import package manifest
        pkg: grunt.file.readJSON("package.json"),

        dependenciesJs: {
            task: {}
        },
        dependenciesStyles: {
            task: {}
        },
        buildStyles: {
            task: {}
        },
        buildJs: {
            task: {}
        },
        watch: {
            styles: {
                files: [
                    'less/*.less'
                ],
                tasks: ['build-styles'],
                options: {
                    livereload: true
                }
            },
            js: {
                files: [
                    'src/*'
                ],
                tasks: ['build-js'],
                options: {
                    livereload: true
                }
            }
        }

    });

    // Load in any and all tasks in the `tasks` folder
    grunt.loadTasks('tasks');

    // Dependencies JS task
    grunt.registerTask('dependencies-js', function() {
        grunt.task.run('dependenciesJs');
    });

    // Dependencies Styles task
    grunt.registerTask('dependencies-styles', function() {
        grunt.task.run('dependenciesStyles');
    });

    // Dependencies Common task
    grunt.registerTask('dependencies', function() {
        grunt.task.run('dependencies-js', 'dependencies-styles');
    });

    // Build Styles
    grunt.registerTask('build-styles', function() {
        grunt.task.run('buildStyles');
    });

    // Build JS
    grunt.registerTask('build-js', function() {
        grunt.task.run('buildJs');
    });

    // Build Common Task
    grunt.registerTask('build', function() {
        grunt.task.run('build-styles', 'build-js');
    });
        

    // Default task
    grunt.registerTask('default', function() {
        grunt.task.run('dependencies', 'build');
    });

};
