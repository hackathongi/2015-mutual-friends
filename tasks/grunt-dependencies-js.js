module.exports = function(grunt) {

    grunt.registerMultiTask('dependenciesJs', 'Description', function() {

        // Tell grunt this task is asynchronous.
        var done = this.async();

        // Define the tasks list
        var taskList = [];
        // ------------------------
        // Start Cleaning
        var clean = {
            demo: [
                'dist/js/**/*'
            ]
        };
        grunt.config.set('clean', clean);
        taskList.push('clean');
        // ------------------------
        // Copy tasks
        var copy = {
            dependencies: {
                files: [
                    {   // hackajobs JS Files
                        expand: true,
                        flatten: true,
                        src: '<%= grunt.params.dependencies.folder %>hackajobs-stylesheet/demo/js/hackajobs-stylesheet-dependencies.js',
                        dest: 'dist/js/'
                    },
                    {   // angular JS Files
                        expand: true,
                        flatten: true,
                        src: '<%= grunt.params.dependencies.folder %>angular/angular.js',
                        dest: 'dist/js/'
                    }
                ]
            }
        };

        grunt.config.set('copy', copy);
        taskList.push('copy');
        // ------------------------
        // ------------------------
        // RUN ALL TASKS
        grunt.task.run(taskList);

        done();

    });

};
