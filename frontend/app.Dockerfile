FROM node:16.18.1 as development

WORKDIR /var/www/html/frontend

COPY frontend/ .

RUN npm install

RUN apt-get update && apt-get install -y nginx

RUN sed -i 's|/usr/share/nginx/html|/var/www/html/frontend|g' /etc/nginx/nginx.conf

COPY frontend/.build/nginx.dev.conf /etc/nginx/conf.d/default.conf

COPY frontend/.build/start-dev.sh /start-dev.sh
RUN chmod +x /start-dev.sh

EXPOSE 80 5173

CMD ["/start-dev.sh"]
