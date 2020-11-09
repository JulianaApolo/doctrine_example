.PHONY: help coverage test install autoload update

help:
	@echo "Uso 'make <target>'"
	@echo "  help          => mostra este menu de ajuda"
	@echo "  coverage      => mostra o relatório de cobertura de testes"
	@echo "  test          => roda todos os testes"
	@echo "  install       => instala o projeto"
	@echo "  autoload      => gera um novo autoloader"
	@echo "  update        => atualiza as dependências"
	@echo "  clean         => apaga todas as dependências"

coverage:
	php phpunit.phar --coverage-text

test:
	php phpunit.phar

install: clean
	php ./build/deploy.php

autoload:
	php composer.phar dump-autoload --profile -v

update:
	php composer.phar update --profile -v --optimize-autoloader

clean:
	-rm -rf vendor
	-rm -rf composer.phar
