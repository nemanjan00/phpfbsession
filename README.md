# phpfbsession

Script for maintaining session from browser for facebook automation

## Adding session

First, you need to get cookies from your web browser. 

To do that, I would recommend [cookies.txt](https://chrome.google.com/webstore/detail/cookiestxt/njabckikapfpffapmjgojcnbfjonfjfg)

After you got your cookies, you should run: 

```bash
php addAccount.php
```

Now, paste cookies and pres ``Enter`` twice! 

## Keeping session in working order? 

To keep session in working order make sure you do not log out in browser or simply delete cookies in browser. 

## How to get something from facebook? 

```php
<?php
require_once("./vendor/autoload.php");

require_once("./Config.php");
require_once("./Parser.php");

$config = new Config;

$parser = new Parser($config->get("accounts"));

echo $parser->get("https://www.facebook.com/");

```

## CLI menu

If you prefer to run CLI menu, you can do so by: 

```bash
php index.php
```

## Troubleshooting

### I have problem with session, what do I do? 

```bash
php checkAccounts.php
```

If problem stays, just delete that account from config.json and readd it. 

## Authors

 * [nemanjan00](https://github.com/nemanjan00)

