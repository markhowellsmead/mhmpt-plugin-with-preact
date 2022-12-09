# Base for a WordPress plugin with a Preact-based admin view

This plugin provides the basis for a WordPress plugin which enqueues compiled JavaScript and CSS in the WordPress
Admin area. The JavaScript provides an interactive screen using React logic, for example fetching data from the
WordPress REST API and displaying this in a list.

The Preact source code is not compiled but loaded as external dependencies. These files are in the _assets/plugins_ folder.

## Usage

-   Duplicate the base repository and rename the functions, classes and namespaces.
-   Install the NPM dependencies by running `npm install`.
-   Run the NPM watcher using `npm start`.
-   Write your JavaScipt code in the files in the _.build/preact_ subfolders.
-   Each _index.js_ in each subfolder of _.build/preact_ will generate its own dist file. For example, _.build/preact/admin-list/index.js_ will generate _assets/preact/admin-list.min.js_.

## Author

Mark Howells-Mead | mark@permanenttourist.ch

Public Github version since December 2022.
