module.exports = function(grunt) {
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
				files: '*.php',
			},
			css: {
				files: '**/*.scss',
				tasks: ['compass'],
			},
			js: {
				files: 'js/*.js',
			},
		},
	});
	grunt.loadNpmTasks('grunt-contrib-compass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.registerTask('default',['watch']);
}
