FROM nginx:stable-alpine

RUN mkdir -p /etc/nginx/certs

ADD ./default.conf /etc/nginx/conf.d/default.conf
ADD ./nginx.conf /etc/nginx/nginx.conf