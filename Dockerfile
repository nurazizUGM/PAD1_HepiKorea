from php:8.2.25-cli-alpine

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Git
RUN apk add --no-cache git  nodejs npm

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql

# Copy the application code
COPY . /app

# Set the working directory
WORKDIR /app

# Install the dependencies
RUN composer install && npm install

# Build the assets
RUN npm run build

RUN php artisan storage:link

# Expose the port
EXPOSE 8000

# Start the server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
