# Lumen PHP Framework

[![Build Status](https://travis-ci.org/laravel/lumen-framework.svg)](https://travis-ci.org/laravel/lumen-framework)
[![Total Downloads](https://img.shields.io/packagist/dt/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![Latest Stable Version](https://img.shields.io/packagist/v/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)
[![License](https://img.shields.io/packagist/l/laravel/framework)](https://packagist.org/packages/laravel/lumen-framework)

Laravel Lumen is a stunningly fast PHP micro-framework for building web applications with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Lumen attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as routing, database abstraction, queueing, and caching.

## Official Documentation

Documentation for the framework can be found on the [Lumen website](https://lumen.laravel.com/docs).

## Contributing

Thank you for considering contributing to Lumen! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Security Vulnerabilities

If you discover a security vulnerability within Lumen, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Lumen framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).


# Tutorial

## Software a instalar

* [Postman](https://www.postman.com/downloads/)
* [Composer](https://getcomposer.org/download/)
* [PHP](https://www.php.net/downloads.php)
* [Xammp](https://www.apachefriends.org/pt_br/download.html) - o Xammp deve ser instalado na diretoria "C:\" de modo a ficar como se mostra de seguida "C:\xampp"

## Instruções

1. Ir até à diretoria "C:\xampp\htdocs" e criar um ficheiro com nome "lumen"  
Command: cd C:\xampp\htdocs

2. Mudar para a diretoria "C:\xampp\htdocs\lumen"  
Command: cd lumen

3. Clonar o repositório do backend  
Command: git clone https://github.com/andreitataru/PTIR.back-end

4. Instalar Composer, fazer o comando seguinte em cada repositório clonado  
Command: composer install

5. Fazer update do Composer  
Command: composer update

6. Mudar para a diretoria do projeto "C:\xampp\htdocs\lumen\PTIR.back-end"  
Command: cd C:\xampp\htdocs\lumen\PTIR.back-end

7. Mudar o nome do file ".env.example" para ".env", fazer o comando seguinte em cada repositório clonado 

8. Criar um file novo denominado de ".env.example", fazer o comando seguinte em cada repositório clonado   
 
9. Copiar todo o conteúdo do ".env" para o ".env.example", fazer o comando seguinte em cada repositório clonado   

10. Gerar uma key random, fazer o comando seguinte em cada repositório clonado   
Command: php artisan key:generate

11. Gerar key, dar update ao ".env" automaticamente, fazer o comando seguinte em cada repositório clonado   
Command: php artisan jwt:secret

## Testar server

### Parte 1
1. Correr o server, o comando irá devolver um link do localhost e **deixar o server a correr**  
Command: php artisan serve  
Exemplo output:   
Laravel development server started: <http://127.0.0.1:8000>  
[Thu Mar 25 17:06:56 2021] PHP 8.0.3 Development Server (http://127.0.0.1:8000) started  

2. Aceder ao link do comando anterior  

3. Verificar se o myphpadmin está a funcionar  
URL: http://localhost/phpmyadmin/  

4. No site myphpadmin criar uma nova base de dados de nome "db"  

5. Correr as migrations   
Command: php artisan migrate  

### Parte 2 - Postman

#### Exemplo de utilização do Postman

1. Entrar no workspace do Postman

2. Criar um request ("Create Request" por baixo do "Get Started")

3. No "Enter request URL" por "http://127.0.0.1:8000/api/register", mudar o URL para o localhost especifico da pessoa( ver Passo 1 na Parte 1 )

4. Mudar o request para o "request type" ou tipo do método
ex: GET, POST, DELETE, COPY, etc.  

5. Ir ao "Body", escolher "form-data" e adicionar as "keys" e "values" segundo o que se quer testar  

6. Testar o Request, ou seja, carregar no "Send"  

## Outras informações pertinentes  

* No file "C:\xampp\htdocs\lumen\PTIR.back-end\app\Http\Controllers" criam-se as funções segundo onde devem estar em termos de organização, por exemplo autenticação do user estará no "\Controllers\AuthController"  

* Os controllers devem sempre ter o sufixo Controller e serem começados com letra maiuscula  
ex: ..\RandomExampleController"  

* As routes são adicionadas no "\routes\web.php"  

* As tabelas estão na "\database\migrations" e se por exemplo se adicionar outra coluna a uma base de dados nesse file tem que se adicionar também a nova informação da coluna no "\App\Models\Users"  

