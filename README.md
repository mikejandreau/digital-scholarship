Colby Libstaff
===

[![digitalscholarship](https://img.shields.io/badge/Built%20For%20WordPress-%E2%93%A6-lightgrey.svg?style=flat-square)](https://github.com/mikejandreau/digitalscholarship) [![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

This is a custom WordPress theme built on Underscores as a starting point. It features a [theme wrapper](http://scribu.net/wordpress/theme-wrappers.html) inspired by Scribu, a responsive grid based on [Skeleton](http://getskeleton.com/) by Dave Gamache, and a workflow built on [WPGulp](https://labs.ahmadawais.com/WPGulp/) by Ahmad Awais. 

It has no external library/framework dependencies such as jQuery, Bootstrap, or Foundation. The minified CSS/JS files weigh in at about 77kb combined.


Quick Start Guide
---

This quick-start guide assumes you already have a local development environment with WordPress already installed and running. If you've done this type of thing before it should be easy to get going. First, either download the files from this repo on GitHub or run the following commands in your terminal:

```shell
$ cd your-wp-directory/wp-content/themes
$ git clone https://github.com/ColbyCommunications/Colby-Libstaff.git
```

Once the theme files are in <code>wp-content/themes</code>, open <code>gulpfile.js</code> in your code editor and look for this:

```javascript
var projectURL = 'dev3'; // Project URL. Could be something like localhost:8888.
```

When developing this theme the folder where WordPress was installed happened to be <code>dev3</code> on my machine. You'll need to update that line above to reflect your local development settings for BrowserSync to work properly.

Once you’ve done that, <code>cd</code> into your theme folder and run <code>npm install</code> to install your dependencies.

```shell
$ cd your-wp-directory/wp-content/themes/colby-libstaff
$ npm install
```

After a few seconds (maybe longer, depending on your computer), run <code>gulp</code> and your default browser should pop up with your site, ready to get to work.

```shell
$ gulp
```

Any time you save a .scss, .js, or .php file, Gulp will re-compile your code and reload your browser.

