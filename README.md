# Twitter Poster Ovreview

## Requirement 

#### 1 - Composer 2

#### 2 - apache 2

#### 3 - php 7.4 | 8 

#### 4 - Mysql 8


## Installation

#### 1 - Download The Project 

```bash
git clone https://github.com/mohammadalathamena/Tweet.git
```

### 1 - Create Database
```bash
mysql -u<your username >-p
```
```bash
password: <your-password>
```
```bash 
create database <your-database-name> ;
```
```bash
exit
```
### 2 - copy .env.example : 
```bash
cp .env.example .env
```

### 3 - reconfig .env : 

 set your database username and password in .env file and set your Twitter accsess token key 

DB_DATABASE=

DB_USERNAME=

DB_PASSWORD=

You must open twitter application to get key [Twitter developer](https://developer.twitter.com/en/apps)

#### you can not tweet without this key :

TWITTER_CONSUMER_KEY=

TWITTER_CONSUMER_SECRET=

#### you can tweet without this key but you must login with twitter every time you want use the app :

TWITTER_ACCESS_TOKEN= 

TWITTER_ACCESS_TOKEN_SECRET=

### 4 - run composer :
```bash
composer install
```

### 5 - generate key
```bash
php artisan key:generate
```


### 6 - run migration file :
```bash
php artisan migrate
```


### 7 - run npm :
```bash
npm install
```


## Usage
### 1 - run artisan server 
 ```bash
 php artisan serve 
```
### 2 - Open Local Host Url 
server open in 8000 port by default 
 ```bash
127.0.0.1:8000
```
### 3 - [Register](http://127.0.0.1:8000/register)

### 4 - [Log In](http://127.0.0.1:8000/login)
### 5 - [Add Credentials](http://127.0.0.1:8000/twitter/credentials/create)

then click on Twitter Logo 

### 6 - [tweet](http://127.0.0.1:8000/twitter/create) :
tweet in Write Tweet page 




# License
[MIT](https://choosealicense.com/licenses/mit/)