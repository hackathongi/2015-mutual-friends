module.exports = function(grunt) {

    grunt.registerMultiTask('buildJs', 'Description', function() {

        // Tell grunt this task is asynchronous.
        var done = this.async();

        // Define the tasks list
        var taskList = [];
        // ------------------------
        // Start Cleaning
        var clean = {
            demo: [
                'dist/js/hackajobs-landing.js'
            ]
        };
        grunt.config.set('clean', clean);
        taskList.push('clean');
        // ------------------------
        // Copy tasks
        var copy = {
            jsFiles: {
                files: [
                    {   
                        expand: true,
                        flatten: true,
                        src: 'src/hackajobs-landing.js',
                        dest: 'dist/js'
                    }
                ]
            }
        };
        grunt.config.set('copy', copy);
        taskList.push('copy');
        // ------------------------
        // Concat-Tasks
        var concat = {
            options: {
                separator: ';'
            },
            demo: {
                files: {
                    // Concat all JS third party dependencies into single file
                    'dist/js/hackajobs-landing-with-dependencies.js' : [
                        'dist/js/hackajobs-stylesheet-dependencies.js',
                        'dist/js/angular.js',
                        'dist/js/hackajobs-landing.js'
                    ]
                }
            }
        };
        grunt.config.set('concat', concat);
        taskList.push('concat');
        // ------------------------
        // Uglify-Tasks
        var uglify = {
            options: {
                mangle: false  // Use if you want the names of your functions and variables unchanged
            },
            dist: {
                files: {
                    'dist/js/hackajobs-landing-with-dependencies.min.js'
                        : 'dist/js/hackajobs-landing-with-dependencies.js'
                }
            }
        };
        grunt.config.set('uglify', uglify);
        taskList.push('uglify');
        // ------------------------
        // ------------------------
        // RUN ALL TASKS
        grunt.task.run(taskList);

        done();

    });

};
