## Instalação 

### Obs: 
- é necessário um servidor redis para rodar as filas.

- Atenção para as configurações de Mail, é necessário configurar as variáveis de ambiente na ```.env```. Esse projeto contém envio de email.

- Clone o projeto
```
git clone git@github.com:Wallacewss2033/onfly-api.git
```

### Back-end

- Entre na pasta onfly-api e instale as dependencias
```
composer install
```
- logo após rode esses comandos
```
cp .env.example .env
```
```
php artisan key:generate
``` 

- Não esqueça de configurar o banco de dados na ``` .env ```
  
![image](https://github.com/Wallacewss2033/fullstack-challenge-20231205/assets/39920409/ec726dce-7762-4c68-b66c-668698afad41)


- Para criar o banco de dados
```
php artisan migrate
```

- Para popular o banco na tabela de usuário
```
php artisan db:seed
```
-  adione na .env a variável ``` REDIS_CLIENT ``` com o valor ``` 'predis' ```

![image](https://github.com/Wallacewss2033/fullstack-challenge-20231205/assets/39920409/8cc0f462-cefe-4e06-812b-d89af831a5f8)

-  altere na .env a variável ``` QUEUE_CONNECTION ``` para o valor de ``` 'redis' ```

![image](https://github.com/Wallacewss2033/fullstack-challenge-20231205/assets/39920409/a2398a76-7975-4cf3-b7ca-616854a50b8a)

- Agora altere as variáveis de Mail:

![image](https://github.com/Wallacewss2033/fullstack-challenge-20231205/assets/39920409/b18965dc-9a86-4d7d-9951-0e3137f5f198)


- Logo após rode os comandos em terminais diferentes
```
php artisan horizon
```
```
 php artisan queue:work
```
- Para rodar o projeto
```
php artisan serve
```
