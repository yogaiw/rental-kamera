
PHP | Laravel | XAMPP |
--- | --- | --- |
v8.0.3 | v8.83.1 | v3.3.0 |

## Installation
1. Clone this repo
2. install dependecies `composer install`
3. copy `example.env` and rename it to `.env`
4. generate app key `php artisan key:generate`
5. run migration `php artisan migrate`
6. run seeder `php artisan db:seed`
7. Last, Run the app `php artisan serve`

## Overview
![Dashboard](https://github.com/yogaiw/yogaiw.github.io/blob/master/content/kancilrentreadme/1.png)
![Memberarea](https://github.com/yogaiw/yogaiw.github.io/blob/master/content/kancilrentreadme/3.png)
![Schedule check](https://github.com/yogaiw/yogaiw.github.io/blob/master/content/kancilrentreadme/7.png)
![Admin Dashboard](https://github.com/yogaiw/yogaiw.github.io/blob/master/content/kancilrentreadme/4.png)

## Status
Payment {1: Ditinjau, 2: Belum Bayar, 3: Pengambilan, 4: Selesai}
Order {1: Ditinjau, 2: ACC, 3: Ditolak}

## API
Android Retrofit Consume API example : https://github.com/yogaiw/rental-mobile <br>
***
**ENDPOINT** /api/v1 <br>

### **GET** `/alat`
### **GET** `/alat?category={id}`
```json
{
    "message": "success",
    "data": [
        {
            "id": 1,
            "kategori_id": 1,
            "nama_alat": "Sony a7ii Body Only",
            "harga24": 200000,
            "harga12": 175000,
            "harga6": 125000,
            "nama_kategori": "Kamera"
        },
        {
            "id": 2,
            "kategori_id": 1,
            "nama_alat": "Sony a6000",
            "harga24": 100000,
            "harga12": 80000,
            "harga6": 50000,
            "nama_kategori": "Kamera"
        },
        {
            // ...
        }
    ]
}
```
### **GET** `/alat/{id}`
```json
{
    "message": "success",
    "data": {
        "id": 1,
        "kategori_id": 1,
        "nama_alat": "Sony a7ii Body Only",
        "harga24": 200000,
        "harga12": 175000,
        "harga6": 125000
    },
    "booked": [
        {
            "start": "2022-07-09 21:00:00",
            "end": "2022-07-10 21:00:00"
        },
        {
            "start": "2022-07-08 13:00:00",
            "end": "2022-07-09 01:00:00"
        },
        {
            "start": "2022-09-20 14:01:00",
            "end": "2022-09-21 14:01:00"
        }
    ]
}
```
### **GET** `/category`
```json
{
    "message": "success",
    "data": [
        {
            "id": 1,
            "nama_kategori": "Kamera"
        },
        {
            "id": 2,
            "nama_kategori": "Lensa"
        },
        {
            // ...
        }
    ]
}
```
