FROM node:8-alpine

RUN apk --no-cache add --update git

RUN mkdir -p /revealjs
WORKDIR /revealjs
RUN git clone https://github.com/hakimel/reveal.js.git . && npm install && mkdir prez

RUN rm -f /revealjs/index.html && \
    touch /revealjs/prez/index.html && \
    ln -s /revealjs/prez/index.html /revealjs/index.html && \
    touch /revealjs/prez/prez.md && \
    ln -s /revealjs/prez/prez.md /revealjs/prez.md
    
EXPOSE 8000
EXPOSE 35729

VOLUME /revealjs/prez

CMD npm start
