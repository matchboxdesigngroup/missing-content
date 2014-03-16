# @todo Version number releases
module.exports =
  dist:
    options:
      mode: 'zip'
      archive: 'releases/latest.zip'
    expand: true,
    cwd: 'releases/',
    src: ['latest/**/*'],