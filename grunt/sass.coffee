module.exports =
  plugin:
    options:
      style: "compressed"
      sourcemap: true

    files: [
      expand: true
      cwd: "assets/css/scss/"
      src: ["mcs-plugin.scss"]
      dest: "assets/css/"
      ext: ".min.css"
    ]