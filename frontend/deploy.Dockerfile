FROM node:16.11.1-alpine as build-stage

WORKDIR /app

COPY frontend/package*.json ./

RUN npm install

COPY frontend/ .

RUN npm run build

FROM nginx:1.21.3-alpine as production-stage

WORKDIR /usr/share/nginx/html

RUN rm -rf ./*
COPY --from=build-stage /app/dist .

COPY frontend/.build/nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
