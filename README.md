
# multiple-role-blog

## Without Docker

### Requirement
```
 * "php": ">= 7.0", stable version

 ```
### Installing

```
$ git clone https://github.com/ul2002/multiple-role-blog.git
$ cd multiple-role-blog
$ cp .env.example .env
```

installing dependencies
```
composer install

```
generating key

```
php artisan key:generate

```

run migration
```
php artisan migrate

```
seed the database
```
php artisan db:seed

```

## With Docker

### Requirement

Docker >= 17.06 CE
Docker Compose

###  Installing
```
$ git clone https://github.com/ul2002/multiple-role-blog.git
$ cd multiple-role-blog
$ cp .env.example .env
```
build our image 
```
$ docker-compose build
```
run the app in the background, in detached mode:
```
$ docker-compose up -d

```
you can now run the following command
```
$ docker exec -it blog composer install
$ docker exec -it blog php artisan key:generate
$ docker exec -it blog php artisan migrate 
$ docker exec -it blog php artisan db:seed 
```


## Docummentation

Check api documentation at https://multiple-role-blog.herokuapp.com .<br/>
You could also check it in the folder ./documentations/

###Initial Accounts 

Admin (email: admin@blog.test , password: secret)
Manager (email: manager@blog.test , password: secret)
Member (email: member1@blog.test , password: secret)

### base url

```
 localhost/api/v1/

```


```
# Authors
  [Ulrich Ntella](https://www.linkedin.com/in/ulrichsoft/). Senior Sofware/DevSecOPs Enginner

# License
This project is released under the MIT license.
