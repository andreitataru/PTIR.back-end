FROM php:7.4-fpm-alpine

# Install system dependencies
#RUN apt-get update && apt-get install -y \
#    git \
#    curl
RUN apk add --update \
    git \
    curl \
    freetype \
	freetype-dev \
	libpng \
	libpng-dev \
	libjpeg-turbo \
	libjpeg-turbo-dev \
        libjpeg \
	libtool \
	libxml2-dev \
	make \
	g++ \
	autoconf \
	imagemagick-dev \
	libtool 

# Clear cache
#RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo_mysql exif pcntl bcmath gd mysqli
RUN pecl install imagick
RUN docker-php-ext-enable imagick
RUN apk del autoconf g++ libtool make
RUN rm -rf /tmp/* /var/cache/apk/*

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www
# Add docker-compose-wait tool -------------------
ENV WAIT_VERSION 2.8.0
ADD https://github.com/ufoscout/docker-compose-wait/releases/download/$WAIT_VERSION/wait /wait
RUN chmod +x /wait