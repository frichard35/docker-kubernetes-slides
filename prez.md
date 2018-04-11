<!-- EDIT in UTF-8 -->

# Docker / Kubernetes
### Quick introduction 
<small>Created by <a href="">François RICHARD</a></small>



## Inside a container
![architecture](prez/img/architecture.jpg "docker image")
Note: Ne marche que sous linux


## Docker on Windows and Mac OS</h2>
* Docker toolbox
  * Based on Virtualbox.
  * Compatible windows / Mac OS
* Docker for mac (based on xhyve)
* Docker for windows (windows 10 minimum)
  * Based on Hyper-V
  * Windows containers !!
Note:Demo 0 (isolation pid + user)  
screen ~/Library/Containers/com.docker.docker/Data/com.docker.driver.amd64-linux/tty
  
tail -f /etc/passwd
docker run -d alpine --user ftp tail -f /etc/passwd



## Exchange with the outside
* Data Volume
  * Volume
  * Bind mount
  * Tmpfs mount
* Networking
  * Default mode bridge
  * Publish port
Note:
Demo 1 (mariadb)  
docker run --name mydb \  
-e MYSQL_DATABASE=gestion \  
-e MYSQL_ROOT_PASSWORD=password \  
-p 3306:3306 \  
-v $(pwd):/docker-entrypoint-initdb.d \  
-d mariadb  
  
docker run -ti --rm mariadb mysql -u root -h 10.0.1.12 -p



## docker registry
* Reuse the storage layer mechanism
* Public or Private
* Smooth and effective usage



## docker-compose
#### Use docker declaratively with yaml files
Note: Demo 2 (docker-compose)
docker-compose up



## Actually in the TSP Team
* Private Docker Registry (Nexus)
* Jenkins for documentation
* Sesame Mocks
* Websphere Testing
* Oracle XE



### Jenkinsfile
```
pipeline {
    agent none
    stages {
        stage('Back-end') {
            agent {
                docker { image 'maven:3-alpine' }
            }
            steps {
                sh 'mvn --version'
            }
        }
        stage('Front-end') {
            agent {
                docker { image 'node:7-alpine' }
            }
            steps {
                sh 'node --version'
            }
        }
    }
}
```
<!-- .element: class="stretch" -->



## Container Orchestration, Why ?
* Managing multiple Docker host
* Deploy abstract service
  * Scaling
  * Load balancing
* Hot deploy
* Secret management
* Metrics



## Competitors
* Apache Mesos
* Docker Swarm
* Kubernetes



## Kubernetes Architecture
![Kubernetes Architecture](prez/img/kubernetes3.jpg "k")
Note: Demo 3 (kubernetes)
minikube start  
minikube status  
eval $(minikube docker-env)  
docker build -t demodb -f Dockerfile-db .  
docker build -t demoweb -f Dockerfile-web .  
kubectl run demo-db --image=demodb \
--port=3306 \
--image-pull-policy=Never \
--env="MYSQL_DATABASE=gestion" \
--env="MYSQL_ROOT_PASSWORD=password"  
  
kubectl describe pods demo-db-68bc679f98-6nj9j | grep IP  
  
kubectl run demo-web --image=demoweb \
--port=8080 \
--image-pull-policy=Never \
--env="GESTION_DB_HOST=172.17.0.3" \
--env="GESTION_DB_USER=root" \
--env="GESTION_DB_PASSWORD=password"  
  
kubectl expose deployment/demo-web --type="LoadBalancer" --port 8080  
kubectl get services  
kubectl scale deployments/demo-web --replicas=3  



## Questions ?

