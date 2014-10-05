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

    watch:
      css:
        files: 'assets/styles/**/*.scss'
        tasks: ['scss']

  grunt.loadNpmTasks 'grunt-sass'
  grunt.loadNpmTasks 'grunt-contrib-copy'
  grunt.loadNpmTasks 'grunt-contrib-clean'
  grunt.loadNpmTasks 'grunt-contrib-watch'

  grunt.registerTask 'scss', ['sass', 'copy:sass', 'clean:sass']
