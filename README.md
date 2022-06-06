# Wicara Website

## Naming Conventions
- menggunakan Bahasa Inggris

### Controller, Route, Variables, Views
- <b>PascalCase</b>: untuk penamaan controller dan singular, contoh: UserController.php
- <b>kebab-case</b>: untuk membuat route url, contoh: ```/auth/password-reset```
- <b>snake_case</b>: untuk penamaan route dan file blade, contoh: ```route('customer.password_reset') dan some_blade.blade.php```
- <b>camelCase</b> untuk variable dan function, contoh: <b>someVariables</b>

### Database
- Nama Tabel: menggunakan <b>snake_case</b> dan plural, contoh: ```customers, cart_items```
- Nama Kolom: menggunakan <b>snake_case</b>, contoh: ```first_name, last_name```
- Primary Key: gunakan ```id```
- Model: menggunakan PascalCase dan singular, contoh: ```User, Customer```


## Folder Structure

### Controller

```
Controller/
    |-Admin/    => semua controller yang berhubungan dengan Admin
    |    |- ...
    |-Auth  => semua controller yang berhubungan dengan Authentication
    |   |- ...
    |-Clients/  => semua controller yang berhubungan dengan Clients
    |   |- ...
    |-Controller.php
```

### Views
```
views/
    |-admin/
    |   |-layouts/  => layouting with adminlte
    |   |   |-partials/
    |   |   |   |- ..
    |   |   |-app.blade.php
    |   |
    |   |-pages/    => semua halaman untuk admin
    |   |   |- ..
    |
    |-auth/
    |   |-pages/ => semua halaman untuk authentication
    |   |   |-login.blade.php
    |
    |-client/
    |   |-layouts/
    |   |   |-partials/
    |   |   |   |- ..
    |   |   |-app.blade.php
    |   |   |-plain.blade.php
    |   |
    |   |-pages/    => semua halaman untuk client
    |   |   |- ..
    |
    |-welcome.blade.php
```
catatan:
- satu halaman diwakili satu folder:
```
|-user/ => halaman user
|   |-index.blade.php
|   |-create.blade.php
|   |-edit.blade.php
```


### Public
```
public/
    |-audio
    |-img/
    |   |-icons
    |   |-illustrations
    |
    |-uploads
    |-vendor/
    |   |-adminlte
    |   |   |- ..
    |
    |   |-onepage
    |   |   |- ..
    |
    |-.htaccess
    |-favicon.ico
    |-index.php
    |-robots.txt
```
