#!/bin/bash

# Composer
wget -N http://getcomposer.org/composer.phar
error=$?
if [ $error -ne 0 ] ; then
  echo "Falha ao realizar download"
  exit 1
fi

php composer.phar install --ansi --optimize-autoloader
error=$?
if [ $error -ne 0 ] ; then
  echo "Falha ao executar deploy"
  exit 1
fi