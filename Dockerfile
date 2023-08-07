FROM 10.168.26.20/library/php-laravel-octane-alpine:1.0
WORKDIR /usr/web-recon
COPY . .
RUN ls -la && composer install
EXPOSE 8000
CMD ["./entrypoint.sh"]

