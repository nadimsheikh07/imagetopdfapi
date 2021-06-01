# web services

## Setup

clone the repo and then run `composer install`.

### Run Application

Run the following command to run application.

```bash
php artisan serve
```
Run the following command to link storage.

```bash
php artisan storage:link
```


Run the following url to export pdf.

```bash
http://127.0.0.1:8000/api/image_export?images=[1,2,3,4]
https://nearyoutech.com/imagetopdfapi/api/image_export?images=[1,2,3,4]
```


For sending mail 

```bash
http://127.0.0.1:8000/api/send_mail

HTTP Header

API_KEY=fa8a911eafa549f9bdd9bbdbbbbfbad6

HTTP METHOD POST

Params

email:abcd@gmail.com
subject:test subject
body:<h1>Hello World</h1>
cc:["nadim.sheikh.07@gmail.com"]
bcc:["nadim.sheikh.07@gmail.com"]

```
