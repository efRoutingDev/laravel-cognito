# laravel-cognito
AWS Cognito package for PHP Laravel

## Installation
First you need to add this repositiory to composer.json
Add this code to the target project:

```json
    // composer.json
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/efRoutingDev/laravel-cognito"
        }
    ],
```

Next add the project to composer.json require:
```json
    // composer.json
    "require": {
        ...
        "efrouting/laravel-cognito": "dev-main"
    },
```
With main being the target branch you wish to download.

Now you must run composer update
```bash
    composer update efRouting/laravel-cognito
```
You'll most likely get prompt for a Github account access code. Input it in the terminal and continue.

Last but not least, add package configs:
```bash
    php artisan vendor:publish --provider="Efrouting\\LaravelCognito\\Providers\\CognitoServiceProvider"
```

