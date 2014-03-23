# @todo Version number releases
module.exports =
  dist:
    options:
      mode: 'zip'
      archive: 'releases/missing-content.zip'
    expand: true,
    cwd: 'releases/',
    src: ['missing-content/**/*'],