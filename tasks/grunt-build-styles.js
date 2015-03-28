module.exports = function(grunt) {

    grunt.registerMultiTask('buildStyles', 'Description', function() {

        // Tell grunt this task is asynchronous.
        var done = this.async();

        // Define the tasks list
        var taskList = [];
        // ------------------------
        // Start Cleaning
        var clean = {
            demo: [
                'dist/css/*'
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
                        flatten: true,
                        src: 'less/*',
                        dest: 'dist/less/hackajobs-landing/'
                    }
                ]
            }
        };
        grunt.config.set('copy', copy);
        taskList.push('copy');
        // ------------------------
        // Less Tasks
        var less = {
            dev: {
                options: {
                    compress: false
                },
                files: [
                    {"dist/css/hackajobs-landing.css":"dist/less/hackajobs-landing/hackajobs-landing.less"}
                ]
            },
            dist: {
                options: {
                    compress: true
                },
                files: [
                    {"dist/css/hackajobs-landing.min.css":"dist/less/hackajobs-landing/hackajobs-landing.less"}
                ]
            }
        };
        grunt.config.set('less', less);
        taskList.push('less');
        // ------------------------
        // ------------------------
        // RUN ALL TASKS
        grunt.task.run(taskList);

        done();

    });

};
