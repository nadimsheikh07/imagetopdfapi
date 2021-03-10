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
http://127.0.0.1:8000/api/image_export?images=[1,3,4]
```