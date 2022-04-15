
# Birthday Mailer App
Small application developed using Laravel
To start using you first need to have Docker installed and run the following command:


```bash
./vendor/bin/sail up
```


## Send Emails 

```bash
./vendor/bin/sail artisan mail:birthday 
```

As an alteranative you can pass the date you want ex: 
```bash
./vendor/bin/sail artisan mail:birthday 2022-12-12
```


# You can check the sent e-mails on MailHog using the link:  http://127.0.0.1:8025/



