module.exports =
  plugin:
    options:
      style: "compressed"
      sourcemap: true

    files: [
      expand: true
      cwd: "assets/css/scss/"
      src: ["mcn-plugin.scss"]
      dest: "assets/css/"
      ext: ".min.css"
    ]

  dist:
    options:
      style: "expanded"
      sourcemap: false

    files: [
      expand: true
      cwd: "assets/css/scss/"
      src: ["mcn-plugin.scss"]
      dest: "assets/css/"
      ext: ".min.css"
    ]