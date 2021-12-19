# Задача
[![Build Status](https://travis-ci.org/Carsak/octo-weather.svg?branch=master)](https://travis-ci.org/Carsak/octo-weather)
  
Необходимо реализовать функционал, который будет получать информацию о  
погоде из любого публичного API.  
Он должен уметь сохранять полученные данные в файле формата json и xml в  
зависимости от переданного в него параметра типа файла.  
  
Для JSON первыми по порядку должны быть поля:  
Дата  
Температура  
Направление ветра  
т.д.  
  
Для XML:  
Дата  
Скорость ветра  
Температура  
т.д.

## Способ установки:
Склонировать репозиторий

    git clone https://github.com/Carsak/octo-weather.git
## Способ запуска
#### Вариант первый 
 через Docker, версия  >= 18.x
В корне проекта запустить команду

    docker-compose up --build
http://joxi.ru/bmoB1g3f3knzzr  
Приложение будет доступно по адресу:
[http://localhost/](http://localhost/)  

####Вариант второй:
Через LAMP, XAMPP или виртуальную машину
Требования:
- Nginx >= 1.10
- PHP >=7.2
- composer

##Запуск тестов

 1 через Docker

    Powershell
        docker run -v ${pwd}:/app --rm phpunit/phpunit tests
    Linux
        docker run -v $(pwd):/app --rm phpunit/phpunit tests
        


 2 Через phpunit 

     composer install
    ./vendor/bin/phpunit tests
