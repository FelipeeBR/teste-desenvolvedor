# Teste Desenvolvedor Full Stack no Paytour

## Passos para instalar e testar

1. Clonar o repositorio
   ```
   git clone https://github.com/FelipeeBR/teste-desenvolvedor
   ```
2. Configurar o .env
   Copie o .env.example para .env:
   
   Ajuste as variáveis de banco de dados para o Docker:
   ```
    DB_CONNECTION=mysql
    DB_HOST=db
    DB_PORT=3306
    DB_DATABASE=db_curriculo
    DB_USERNAME=admin
    DB_PASSWORD=admin123
   ```
   Gere a chave do aplicativo:
   ```
   php artisan key:generate
   ```
   
3. Build e start dos containers
   ```
   docker-compose up -d --build
   ```
   Deve aparecer app-teste, queue e db-teste-dev

4. Instalar dependências do Laravel
   ```
   docker exec -it app-teste bash
   composer install
   ```
5. Rodar migrations
   ```
   docker exec -it app-teste php artisan migrate
   ```

## Testes Unitarios:

- test_can_create_curriculum
- test_cannot_create_curriculum_without_name
- test_cannot_create_curriculum_without_email
- test_cannot_create_curriculum_without_phone
- test_cannot_create_curriculum_without_position
- test_cannot_create_curriculum_without_education
- test_cannot_create_curriculum_without_file
- test_cannot_create_curriculum_with_size_file
- test_cannot_create_curriculum_with_extension_file

#### Para testes no postman, utilize o ```Accept: application/json``` no Postman no headers, e o form-data com os campos/keys tipo text: (name, email, phone, position, education, observations) e campo file do tipo File

name = nome

email = email

phone = telefone

position = cargo prentendido

education = escolaridade [Ensino Médio, Graduação, Mestrado, Doutorado]

observations = observações

file = para upload do cv
