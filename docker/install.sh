#!/usr/bin/env sh
set -eux

: "Install build tools" && {
  apk update
  apk add --no-cache --virtual .build-deps autoconf g++ make
}

: "Install Xdebug" && {
  docker-php-source extract
  case "$PHP_VERSION" in
    5.2.*|5.3.*) XDEBUG=xdebug-2.2.7;;
          5.4.*) XDEBUG=xdebug-2.4.1;;
          7.2.*) XDEBUG=xdebug-2.6.0alpha1;;
  	          *) XDEBUG=xdebug;;
  esac
  pecl install "$XDEBUG"
  docker-php-ext-enable xdebug
  docker-php-source delete
}

: "Install Composer" && {
  curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

  : "Speed up Composer" && {
    : "Use Japan mirror server if the region is Japan" && {
      [[ $(curl -s https://ipapi.co/country) == "JP" ]] &&
        composer config -g repos.packagist composer https://packagist.jp
    }
    : "Add parallel install plugin" && {
      composer global require hirak/prestissimo
    }
  }
}

: "Make sandbox directory" && {
    mkdir /copy
}

: "Cleanup" && {
  rm -rf /tmp/*
  rm -rf /var/cache/apk/*
  apk del .build-deps
}
