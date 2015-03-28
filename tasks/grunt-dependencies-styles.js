module.exports = function(grunt) {

    grunt.registerMultiTask('dependenciesStyles', 'Description', function() {

        // Tell grunt this task is asynchronous.
        var done = this.async();

        // Define the tasks list
        var taskList = [];
        // ------------------------
        // Start Cleaning
        var clean = {
            demo: [
                'dist/less/**/*'
            ]
        };
        grunt.config.set('clean', clean);
        taskList.push('clean');
        // ------------------------
        // Copy tasks
        var copy = {
            lessFiles: {
                files: [
                    {   // Hackajobs LESS Files
                        expand: true,
                        cwd: '<%= grunt.params.dependencies.folder %>hackajobs-stylesheet/demo/less/',
                        src: '**/*',
                        dest: 'dist/less/'
                    }
                ]
            },
            fontFiles: {
                files: [
                    {   // Hackajobs FONT Files
                        expand: true,
                        cwd: '<%= grunt.params.dependencies.folder %>hackajobs-stylesheet/demo/fonts/',
                        src: '**/*',
                        dest: 'dist/fonts/'
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
