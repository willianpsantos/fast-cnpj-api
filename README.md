# fast-cnpj-api
API de consulta de CNPJ para a Fast.

Para rodar a aplicação, siga os passos a seguir 

1 - Crie uma base de dados no MySQL, usando o comando abaixo:

CREATE DATABASE `fast_cnpj_api` CHARSET utfmb4 COLLATE utf8mb4_general_ci;

2 - Configure os dados de acesso a base de dados no .env

3 - Navegue até a pasta do projeto via prompt de comando.

3 - Execute as migrations através do comando:

php artisan migrate

4 - Execute o comando:

php artisan serve

5 - Teste a API utilizando a URL gerada pelo comando acima.

Os endpoints da API são

GET <base_url>/empresa/{cnpj} - Para buscar os dados de uma empresa e salvá-los no banco de dados

PUT <base_url>/empresa/{cnpj} - Para atualizar os dados salvos no banco de dados

O corpo da requisição de atualização deve conter os campos que serão atualizados. O payload da requisição é:

{
    razao_social: string (opcional),
    nome_fantasia: string (opcional),
    atividade_principal: string (opcional),
    data_abertura: json_date (opcional)
    natureza_juridica: string (opcional),

    endereco: {
        cep: string (opcional), 
        logradouro: string (opcional),
        codigo_ibge: int (opcional)
        cidade: string (opcional),
        estado: string (opcional),
        bairro: string (opcional),
        numero: string  (opcional),
        pais: string (opcional),
        complemento: string
    }
}

DELETE <base_url>/empresa/{cnpj} - Para excluir os dados salvos no banco de dados
