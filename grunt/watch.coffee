module.exports =
  siteSass:
    files: ["assets/css/scss/**/*.scss"]
    tasks: [
      "sass:plugin"
      "group_css_media_queries:plugin"
      "autoprefixer"
      "cssmin:plugin"
    ]
    options:
      spawn: false

  livereload:
    options:
      livereload: true
      spawn: false

    files: [
      "assets/css/*.css"
      "assets/js/*.js"
      "**/*.php"
      "!**/node_modules/**"
      "**/*.{png,jpg,gif}"
    ]