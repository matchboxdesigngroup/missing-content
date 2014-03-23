# @todo Version number releases
module.exports =
	dist:
		files: [
			expand: true
			src:  [
					'**',
					'!node_modules/**',
					'!releases/**',
					'!.git/**',
					'!.sass-cache/**',
					'!**/scss/**',
					'!assets/js/src/**',
					'!screenshots/**',
					'!Gruntfile.js',
					'!package.json',
					'!.gitignore',
					'!README.md',
					'!LICENSE',
					'!phpdoc.dist.xml',
					'!st3-ignores.txt',
					'!grunt/**',
					'!docs/**',
					'!**/*.map',
					'!**/.DS_Store',
				],
			dest: 'releases/missing-content/'
		]