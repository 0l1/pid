module.exports = function(grunt) {
	// require it at the top and pass in the grunt instance
  require('time-grunt')(grunt);

	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		compass: {
			dist: {
				options: {
					config: 'config.rb'
				}
			}
		},
		watch: {
			options: {
        livereload: true,
      },
			php: {
				files: '../*.php',
			},
			css: {
				files: '../**/*.scss',
				tasks: ['compass'],
			},
			js: {
				files: '../js/*.js',
			},
		},
		jshint: {
			all: '../js/*.js',
		}
	});
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',['watch']);
}
