# Exemplo de uso do ORM doctrine

## Instalação do ambiente
Copie o .env_example e altere as configurações:
```
cp .env_example .env
```

Rode o docker-compose para criação dos containers da aplicação e do banco de dados:
```
docker-compose up --build -d
```

Para acessar o container da aplicação utilize:
```
docker-compose exec doctrine_app bash
```

Rode o composer, dentro do container:
```
make install
```

Crie as tabelas no banco de dados com o comando abaixo, dentro do container:
```
vendor/bin/doctrine orm:schema-tool:create
```

## Rodando a aplicação
Para rodar a aplicação, acesse via browser:
http://localhost:<porta configurada no .env>

## Outras ferramentas

Para rodar o phpcbf, dentro do container:
```
php composer.phar phpcbf
```

Para atualizar a base de dados de acordo com os models, utilize no container:
```
vendor/bin/doctrine orm:schema-tool:update --force
```

Para excluir e recriar a base de dados, utilize no container:
```
vendor/bin/doctrine orm:schema-tool:drop --force
vendor/bin/doctrine orm:schema-tool:create
```

[Documentação do ORM do doctrine](https://www.doctrine-project.org/projects/doctrine-orm/en/2.7/index.html)

