
FROM node:14-alpine

WORKDIR /app

COPY package*.json ./
COPY ./ /app

RUN npm install

EXPOSE 8080

CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]