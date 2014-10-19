module.exports = (grunt) ->

  cssBanner = [
    '/**'
    ' * Theme Name: VCP Niedersachsen'
    ' * Description: VCP-Nds-Theme auf Basis des Yoko-Themes'
    ' * Author: Elmastudio/AG Medien'
    ' * Author URI: http://www.elmastudio.de/en/themes/'
    ' * Version: 0.1.0'
    ' *'
    ' * License: GNU/GPL Version 2 or later'
    ' * License URI: http://www.gnu.org/licenses/gpl.html'
    ' *'
    ' * Wird automatisch generiert!!'
    ' */'
    ''
  ].join '\n'

  grunt.initConfig

    pkg: grunt.file.readJSON('package.json')

    paths:
      styles: 'assets/styles/'
      scripts: 'assets/scripts/'
      vendor: 'assets/vendor/'

    sass:
      options:
        outputStyle: 'compressed'
        precision: 6
      dist:
        files:
          '<%= paths.styles %>.tmp.css': '<%= paths.styles %>main.scss'

    copy:
      sass:
        src: '<%= paths.styles %>.tmp.css'
        dest: 'style.css'
        options:
          process: (content) ->
            cssBanner + content

    clean:
      sass: ['<%= paths.styles %>.tmp.css']
      js: ['<%= paths.styles %>main.js', '<%= paths.styles %>main.min.js']

    watch:
      dev:
        files: ['<%= paths.styles %>**/*.scss', '<%= paths.scripts %>project/*.js']
        tasks: ['scss', 'js']

    concat:
      options:
        separator: ';'
      dist:
        src: [
          '<%= paths.vendor %>magnific-popup/dist/jquery.magnific-popup.js'
          '<%= paths.scripts %>project/*.js'
        ]
        dest: '<%= paths.scripts %>main.js'

    uglify:
      dist:
        files:
          '<%= paths.scripts %>main.min.js': ['<%= paths.scripts %>main.js']


  grunt.loadNpmTasks 'grunt-sass'
  grunt.loadNpmTasks 'grunt-contrib-copy'
  grunt.loadNpmTasks 'grunt-contrib-clean'
  grunt.loadNpmTasks 'grunt-contrib-watch'
  grunt.loadNpmTasks 'grunt-contrib-concat'
  grunt.loadNpmTasks 'grunt-contrib-uglify'

  grunt.registerTask 'scss', ['sass', 'copy:sass', 'clean:sass']
  grunt.registerTask 'js', ['clean:js', 'concat:dist']
  grunt.registerTask 'build', ['scss', 'js', 'uglify:dist']
