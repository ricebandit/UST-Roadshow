# WordPress-Compiler

Compiler Workflow that allows for Node Pre-Processors during WordPress Development

### Requirements

Node v14.19.3

### Optional

Visual Studio Code (This package utilizes Live Sass Compiler extension)

### OVERALL STRUCTURE OF WORDPRESS SET UP:

- build

  - Core WP files
  - wp-content

- source
  - .git
  - .gitignore
  - package.json
  - src
    - Copy of WP Core files
    - dev-scripts
      - copy.js
      - scss

### OVERALL WORKFLOW

This set up will allow you to use Node for building WordPress sites.

All Development should be from the "source" directory. I use Visual Studio Code to watch for Sass changes. After each save, Live Watch will compile and save style.css in the src directory.

Additional template files and folders can be added to the src folder and will automatically be added to the list of files to copy over.

WHEN READY TO PREVIEW, "npm run copy". This will copy all theme files and directories into build/wp-content/themes/customtheme

CAVEAT! Deleting a file from your src directory will not remove it from the compiled version, so you will need to remove it manually.

### PREPARATION

1. Create your local directory. This directory will be used to store two directories:

- build
  - By default, this package assumes the name of the WordPress root directory is named "build". If not, you'll need to go to /src/dev-scripts/copy.js, and change the "rootName" variable to the name of that folder.
- this package

2. In the build directory, install a fresh WordPress instance. Easiest way is to use MAMP (https://www.mamp.info/en).

3. If you already have a theme, activate it. If not, there are minimalist boilerplate themes you can download, such as \_underscores (https://underscores.me/).

4. Once you are able to activate a theme, go into it's directory at /wp-content/themes/yourtheme. You'll want to copy all of the contents (files and directories) and paste them in step 6, below.

5. Paste all of your theme files (from step 4) into the /src directory of this package.

The dev-scripts folder should be included along with the rest of your theme files. IT WILL NOT BE INCLUDED IN THE COPY LIST.

6. TO AVOID FUTURE POTENTIAL CONFUSION, I recommend deleting the .git file linking to this repository.

### SOURCE FOLDER

Go to /src/dev-scripts/copy.js, open the file and change the themeName variable to whatever the name of your theme directory.

Any time you're ready to update your build's files and folders, run the following command:

```
npm run copy
```

If Bootstrap will be used (or any other package with CSS, for that matter), install via NPM.

### SET UP SASS

Sass files should live in the src/dev-scripts directory

If Visual Studio Code, there's a SASS watcher that waits for changes and auto-compiles when SCSS files are saved.

Search for "Live Sass Compiler" extension

Settings can be applied for User & Workspaces. In this case, apply the below settings to Workspace. Click on the Extensions tab on the left-most column (square grid icon). Click on the cog wheel to the right of the Live Sass Compiler listing.

Click on "Edit in settings.json" link, and add the following:

```
"liveSassCompile.settings.formats":[
  {
    "format": "compressed",
    "extensionName": ".css",
    "savePath": "/src"
  }
]
```

- Work Space = Project
- User = Global/App-wide

### SASS Files

Open src/dev-scripts/style.scss

By default this boilerplate assumes Bootstrap will be used and is pointing to those SCSS files in the compile. (I left this in so you won't have to find the path to node_modules)
