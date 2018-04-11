# docker-kubernetes-slides
A simple docker kubernetes presentation

Launch reveal js server with :
```
docker build -t reveal .
docker run --rm -ti -p 8000:8000 -p 35729:35729 -v $(pwd):/revealjs/prez reveal
```
