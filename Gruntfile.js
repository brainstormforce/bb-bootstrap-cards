module.exports = function( grunt ) {

	'use strict';
	var banner = '/**\n * <%= pkg.homepage %>\n * Copyright (c) <%= grunt.template.today("yyyy") %>\n * This file is generated automatically. Do not edit.\n */\n';
	// Project configuration
	grunt.initConfig( {

		pkg: grunt.file.readJSON( 'package.json' ),

		addtextdomain: {
			options: {
				textdomain: 'bb-bootstrap-cards',
			},
			target: {
				files: {
					src: [ '*.php', '**/*.php', '!node_modules/**', '!php-tests/**', '!bin/**' ]
				}
			}
		},

		wp_readme_to_markdown: {
			your_target: {
				files: {
					'README.md': 'readme.txt'
				}
			},
		},

		makepot: {
			target: {
				options: {
					domainPath: '/languages',
					mainFile: 'bb-bootstrap-cards.php.php',
					potFilename: 'bb-bootstrap-cards.pot',
					potHeaders: {
						poedit: true,
						'x-poedit-keywordslist': true
					},
					type: 'wp-plugin',
					updateTimestamp: true
				}
			}
		},

		copy: {
			main: {
				options: {
					mode: true
				},
				src: [
					"**",
					"!node_modules/**",
					"!.git/**",
					"!*.sh",
					"!*.zip",
					"!eslintrc.json",
					"!README.md",
					"!Gruntfile.js",
					"!package.json",
					"!package-lock.json",
					"!.gitignore",
					"!*.zip",
					"!Optimization.txt",
					"!composer.json",
					"!composer.lock",
					"!phpcs.xml.dist",
					"!vendor/**",
					"!src/**",
					"!scripts/**",
					"!config/**"
				],
				dest: "bb-bootstrap-cards/"
			}
		},
		compress: {
			main: {
				options: {
					archive: "bb-bootstrap-cards-<%= pkg.version %>.zip",
					mode: "zip"
				},
				files: [
					{
						src: [
							"./bb-bootstrap-cards/**"
						]

					}
				]
			}
		},
		clean: {
			main: ["bb-bootstrap-cards"],
			zip: ["*.zip"],
		},
		wp_readme_to_markdown: {
			your_target: {
				files: {
					"README.md": "readme.txt"
				}
			},
		},

	} );

	/* Load Tasks */
	grunt.loadNpmTasks( "grunt-contrib-copy" )
	grunt.loadNpmTasks( "grunt-contrib-compress" )
	grunt.loadNpmTasks( "grunt-contrib-clean" )

    grunt.loadNpmTasks('grunt-wp-i18n');
    grunt.loadNpmTasks('grunt-wp-readme-to-markdown');

    /* Register task started */
    grunt.registerTask("release", ["clean:zip", "copy","compress","clean:main"]);
    grunt.registerTask('i18n', ['addtextdomain', 'makepot']);
    grunt.registerTask('readme', ['wp_readme_to_markdown']);

    // Generate Read me file
    grunt.registerTask( "readme", ["wp_readme_to_markdown"] )

	grunt.util.linefeed = '\n';

};
