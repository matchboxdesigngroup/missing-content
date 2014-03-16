module.exports = function(grunt) {
	// Measures the time each task takes
	require('time-grunt')(grunt);

	// Load Grunt Configurations
	require('load-grunt-config')(grunt);

	// Load Tasks
	// This will load all grunt-* tasks that are in the package.json devDependencies
	require('load-grunt-tasks')(grunt, { scope: 'devDependencies' });

	/**
	 * Runs the phpdoc command to generate  PHPDocumentation.
	 *
	 * @return  {void}
	 */
	grunt.registerTask('phpdoc', 'Executes PHPDocumentor command.', function() {
		var exec = require('child_process').exec;

		exec('phpdoc', this.async());
	});

	// Register Tasks
	grunt.registerTask('default', [ 'watch' ]);
	grunt.registerTask('conflict', [ 'sass:plugin' ]);
	grunt.registerTask('build', [ 'sass', 'autoprefixer', 'group_css_media_queries', 'cssmin', 'phpdoc' ]);
};
