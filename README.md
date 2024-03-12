# Tamago Flex Theme

[![Version](https://badgen.net/badge/release/v1.0.0/green)]()
[![Node Version](https://badgen.net/badge/node/>=16/green)]()

The Tamago Flex theme is a theme for creating custom templates based on Flex modules for WordPress versions greater than 6.

## 🔧 Tech/framework used

All modules, libraries and frameworks used in the starter package are described in the package.json and composer.json files

## 💾 Installation

1. Clone the project in wp-content/themes in root folder WordPress

```bash
  git clone https://github.com/ImaggoDev/tamago-flex.git
```

2. Go to the project directory `cd tamago-flex`
3. Install dependencies (using [composer](https://getcomposer.org/)) `composer install`
4. Copy script `composer run-script config`
5. Install dependencies front-end (using yarn) `yarn`
6. Start the theme development `yarn dev`

Runs the app in development mode.

The page will automatically reload if you make changes to the code.
You will see the build errors and lint warnings in the console.

## Deployment

To deploy this project run

```bash
  composer install
  yarn
  yarn build
```
