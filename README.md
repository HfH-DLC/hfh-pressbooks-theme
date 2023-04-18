# HfH Pressbooks-Theme

Like all Pressbooks themes this theme is a child theme of the official [McLuhan](https://github.com/pressbooks/pressbooks-book) theme.

The initial setup was created according to https://pressbooks.org/dev-docs/theme-development/ using `wp scaffold book-theme`.

Since this default setup was fairly limiting, the `src` folder contains our own Sass files which are compiled to the `dist` folder by vite and included in `functions.php`. There are separate files for the editor (`editor.scss`) and h5p styles (`h5p.scss`). The `assets` folder and the scss files within usually don't need to be touched.

Given that this is a child theme and we want to stay as compatible as possible with any future changes to pressbooks and McLuhan, we override as few template files as possible.

## Usage

- Create a `.npmrc` file to be able to access the `@hfh-dlc/hfh-styleguide` package ([More information on the Github npm registry](https://docs.github.com/de/packages/working-with-a-github-packages-registry/working-with-the-npm-registry)).
- Install dependencies with `pnpm i`.
- For local development run `pnpm dev`.
- In order to create a .zip file for manual upload run `pnpm bundle`. This will create `hfh-pressbooks-theme.zip` in the `bundle` folder. For actual deployment you should create a Github relase (see "Deployment" below).

## Deployment

- Merging from the `dev` branch into the `main` branch will create a new release on Github. Before merging, make sure to update the version number in `package.json`, `style.css` and `functions.php`.

## Custom Additions

Due to accessibility reasons we don't allow `h1` elements within chapter content.
The `hfh_pressbooks_theme_remove_h1` function in `functions.php` removes the `h1` option from the richtext editor.

In order to find subsections within a chapter's content pressbooks by default looks for `h1` elements. This is used by both the table of contents and the collapse sections feature when the respective options are active. In order to still be able to use those features we adapted the code to work with `h2` elements instead. This is implemented in `inc/class-book.php` and `collapse-sections.js`.
