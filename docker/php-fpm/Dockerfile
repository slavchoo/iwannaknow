FROM phpdockerio/php72-fpm:latest
WORKDIR "/application"

# Install selected extensions and other stuff
RUN apt-get update \
    && apt-get -y --no-install-recommends install  php7.2-mysql php7.2-mongodb php7.2-xdebug \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install git
RUN apt-get update \
    && apt-get -y install git \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Install xdebug
RUN echo "error_reporting = E_ALL" > /etc/php/7.2/cli/php.ini \
    && echo "display_startup_errors = On" >> /etc/php/7.2/cli/php.ini \
    && echo "display_errors = On" >> /etc/php/7.2/cli/php.ini \
    && echo "xdebug.remote_enable=1" >> /etc/php/7.2/cli/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /etc/php/7.2/cli/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=\"PHPSTORM\"" >> /etc/php/7.2/cli/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /etc/php/7.2/cli/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /etc/php/7.2/cli/conf.d/docker-php-ext-xdebug.ini# Install xdebug

RUN echo "error_reporting = E_ALL" > /etc/php/7.2/fpm/php.ini \
    && echo "display_startup_errors = On" >> /etc/php/7.2/fpm/php.ini \
    && echo "display_errors = On" >> /etc/php/7.2/fpm/php.ini \
    && echo "xdebug.remote_enable=1" >> /etc/php/7.2/fpm/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> /etc/php/7.2/fpm/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=\"PHPSTORM\"" >> /etc/php/7.2/fpm/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /etc/php/7.2/fpm/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=0" >> /etc/php/7.2/fpm/conf.d/docker-php-ext-xdebug.ini

# Install yarn
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash - && \
    curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | apt-key add - && \
    echo "deb https://dl.yarnpkg.com/debian/ stable main" | tee /etc/apt/sources.list.d/yarn.list && \
    apt-get update && \
    apt-get install -qq -y build-essential nodejs yarn \
