FROM node:latest

RUN yarn global add @vue/cli
RUN yarn global add @vue/cli-init

WORKDIR /app

COPY entrypoint.sh /entrypoint.sh
ENTRYPOINT ["/bin/sh", "/entrypoint.sh"]

ENV HOST 0.0.0.0