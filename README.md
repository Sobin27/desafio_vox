# Desafio_Vox
Esse é um projeto feito em symfony, com o objetivo de realizar simples CRUD de Empresas e Sócios.


## Instalação
Para instalar o projeto, siga os passos abaixo:

1. Clone o repositório
```bash
git clone https://gitlab.com/teste6393635/desafio_vox.git
```
2. Acesse a pasta do projeto
```bash
cd desafio_vox
```
Após fazer o clone do projeto, você pode começar a configurar o seu ambiente de desenvolvimento:

3. Após acessar a pasta do projeto, você irá conseguir identificar que existe um docker-compose.yaml no projeto, com isso você pode subir o ambiente de desenvolvimento com os comandos abaixo:
```bash
sudo docker-compose up --build -d
```
Após o carregamento dos containers você precisará entrar no container do serviço backend para conseguir rodar as migrations necessárias.

* Ambiente Linux:
1. Acesse o container do serviço backend
```bash
sudo docker exec -it desafio_vox_backend bash
```
2. Rode as migrations
```bash
php bin/console doctrine:migrations:migrate
```
* Ambiente Windows:
1. Acesse o container do serviço backend atráves do Docker setup e terá está tela apresentada, clique nos 3 pontos do container backend e depois em "Open in terminal"
![img.png](img.png)
2. Após entrar no terminal do container, rode as migrations
```bash
php bin/console doctrine:migrations:migrate
```

Pronto, agora seu ambiente já está configurado para ser utilizado.
E não precisa se preocupar com as conexões do banco, elas ja foram feitas atráves do .env, caso queira acessar o  banco é só utilizar as credenciais nos campos abaixo:
DB_NAME, 
DB_USER, 
DB_PASSWORD
e o host é localhost.

## Utilização

Para testar os endpoints você pode usar o software de sua preferência, mas sugiro que utilize o Postman.

* CRUD de Empresas
1. Criar uma empresa

Rota: POST http://localhost:8000/api/empresa/create

Body:
```json
{
    "nomeFantasia": "Empresa Teste",
    "razaoSocial": "Empresa Teste LTDA",
    "cnpj": "12345678901234"
}
```
Com isso, você terá um retorno como true e status code de 201

2. Listar todas as empresas

Rota: GET http://localhost:8000/api/empresa/list

Com isso, você terá um retorno com todas as empresas cadastradas e status code de 200
```
[
    [
      "id" => 1,
      "nomeFantasia" => "Empresa Teste 2",
      "razaoSocial" => "Empresa Teste LTDA 2",
      "cnpj" => "12345678901234",
      "socios" => [
      [
        "id" => 1,
        "nome" => "Sócio Teste",
        "cpf" => "12345678901"
      ]
    ]
]
```

3. Atualizar uma empresa

Rota: PUT http://localhost:8000/api/empresa/update

Body:
```json
{
    "id": 1,
    "nomeFantasia": "Empresa Teste 2",
    "razaoSocial": "Empresa Teste LTDA 2"
}
```
Com isso, você terá um retorno como true e status code de 200

4. Deletar uma empresa

Rota: DELETE http://localhost:8000/api/empresa/delete/{id}

Com isso, você terá um retorno como true e status code de 200

==================================================================================
* CRUD de Sócios

1. Criar um sócio

Rota: POST http://localhost:8000/api/socio/create

Body:
```json
{
    "nome": "Sócio Teste",
    "cpf": "12345678901",
    "email": "test@example.com",
    "empresa_id": 1
}
```
Detalhe importante, você só conseguirá criar um sócio se a empresa_id existir no banco de dados. Com isso, você terá um retorno como true e status code de 201

2. Listar todos os sócios

Rota: GET http://localhost:8000/api/socio/list

Com isso, você terá um retorno com todos os sócios cadastrados e status code de 200
```
[
    [
      "id" => 1,
      "nome" => "Sócio Teste",
      "cpf" => "12345678901",
      "email" => "teste@example.com",
    ]
]
```
3. Atualizar um sócio

Rota: PUT http://localhost:8000/api/socio/update

Body:
```json
{
    "id": 1,
    "nome": "Sócio Teste 2",
    "email": "teste@example.com"
}
```
Com isso, você terá um retorno como true e status code de 200

4. Deletar um sócio

Rota: DELETE http://localhost:8000/api/socio/delete/{id}

Com isso, você terá um retorno como true e status code de 200