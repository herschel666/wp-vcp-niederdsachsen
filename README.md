WP-VCP-Niedersachsen
====

The official template of [www.vcp-niedersachsen.de](http://www.vcp-niedersachsen.de/) based on [Yoko](http://www.elmastudio.de/wordpress-themes/yoko/) by [Elmastudio](http://www.elmastudio.de/). WIP!

## Prerequisites

In order to contribute to this template, you need [Git](http://git-scm.com/), [Node.js](http://nodejs.org/), [Bower-CLI](http://bower.io/#install-bower) and [Grunt-CLI](http://gruntjs.com/getting-started#installing-the-cli) installed on your system.

## Installation

Clone the repo and install the dependencies.

```bash
$ git clone git@github.com:herschel666/wp-vcp-niederdsachsen.git
$ cd wp-vcp-niederdsachsen
$ bower install && npm install
```

## Icon Font

The theme uses a custom icon font. To edit/change/extend it, grab the [`selection.json`](https://github.com/herschel666/wp-vcp-niederdsachsen/tree/master/assets/fonts/selection.json), go to [Icomoon](https://icomoon.io/app/), import the JSON-file and make your changes. After that, download the new package, swap the font-files and the `selection.json` in the `assets/fonts`-folder and make the changes to the CSS in the `webfonts.scss`-file. That should do the trick.

## Contributing

If there's a problem, open an issue. If you're feeling brave and want to contribute code, I highly encourage you to do so. In this case follow these steps:

1. Fork this repo
2. Create a feature-branch from the master-branch of your fork
3. Edit/add/remove whatever ou want
4. Make a pull-request to the original repo

Thanks in advance!


## License

Copyright (C) 2014  Emanuel Kluge

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
