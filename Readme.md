# lemp-php8-nginx-mariadb

# Run Docker
docker-compose up -d --build


### -------------------------- How to Docker ------------------------ ###
### Docker command ###

# เราจะทำการ pull image จาก docker hub (สถานที่ฝาก docker ไว้บน cloud)
# pull image มาลงเครื่อง
# command
docker pull <url docker หรือชื่อ ถ้าอยู่ใน docker hub>
# example (สำหรับ hello world)
docker pull hello-world

# run image นั้นออกมาเป็น 1 container
# command
docker run <ชื่อ image ที่จะ run>

# example (run image hello-world)
docker run hello-world

### ----------------------------------------------------------------- ###
### ลองเขียน Dockerfile เพื่อ custom module ขึ้นมา ###

# Dockerfile เราจะได้ Dockerfile หน้าตาประมาณนี้ออกมา

# ------------------START Dockerfile --------------------------------
Dockerfile
# ทำการเลือก base image (จาก docker hub) มาเป็นตัว runtime เริ่มต้น เพื่อให้สามารถ run project ได้
# ในทีนี้เราทำการเลือก node image version 18 ออกมา
FROM node:18

# กำหนด directory เริ่มต้นใน container (ตอน run ขึ้นมา)
WORKDIR /usr/src/app

# ทำการ copy file package.json จากเครื่อง local เข้ามาใน container
COPY package.json ./

# ทำการลง dependency node
RUN npm install

# copy file index.js เข้ามาใน container
COPY index.js ./

# ทำการปล่อย port 8000 ออกมาให้ access ได้
EXPOSE 8000

# กำหนด command สำหรับเริ่มต้น run application (ตอน run container)
CMD ["node", "index.js"]

# ------------------END Dockerfile --------------------------------
# เรามาลองทำการ build image
# command
docker build -t <ชื่อ image ที่ต้องการตั้ง> -f <ตำแหน่ง dockerfile> <path เริ่มต้นที่จะใช้ run docker file>

# example ที่เราจะ run
docker build -t node-server -f ./Dockerfile .
# ถ้าเกิดเป็น Dockerfile อยู่แล้ว (ไม่ใช่ชื่ออื่น) สามารถย่อเหลือเพียงแค่
docker build -t node-server .

# ลองทำการ run ออกมาด้วยคำสั่ง docker run แต่คราวนี้จะต้องมีการ map port ออกมา เพื่อให้สามารถ access ไปยัง port ภายในที่ run node อยู่ได้ ด้วย -p

# command
docker run -p <port ภายนอก>:<port ภายใน> <ชื่อ image>

# example สำหรับ run เคสนี้
docker run -p 8000:8000 node-server

# ทีนี้คำสั่ง docker run อาจจะไม่สะดวก เวลาที่อนาคตเราจะต้อง run container หลายตัว เนื่องจากตอนใช้คำสั่ง มันจะเป็นการ run แบบ foreground (เราจะอยู่หน้าจอ process นั้นไว้ด้วย) เราจะเปลี่ยนให้ docker run มา run แบบ background แทน

# ทีนี้เราลอง ctrl+c ออกมาก่อน (ทำการ quit process) หากใคร quit ไม่ได้ ให้เปิด terminal (หรือ cmd ใหม่) แล้วใช้คำสั่งนี้
docker rm -f $(docker ps -a -q)

ถ้าถูกต้อง จะต้องยิง API localhost:8000 ไม่ได้แล้ว เปลี่ยนมาใช้คำสั่งนี้สำหรับการ run แทน

# เพิ่ม -d เพื่อให้สามารถ run background ได้
docker run -d -p 8000:8000 node-server

### ----------------------------------------------------------------- ###
### สำหรับ log ของ node (ที่พิมพ์คำว่า localhost) สามารถตรวจสอบได้จากการใช้คำสั่ง docker logs ###
# command
docker logs <ชื่อ container>

# example (ดูตามชื่อข้างหลังใน docker ps)
docker logs charming_ishizaka

# เราสามารถตั้งชื่อ Container name ได้เช่นกัน ด้วยการใส่ --name ได้
# เพิ่ม name มา
docker run -d -p 8000:8000 --name my-container node-server

# ตอน log (ดูเพิ่มเติมจากตอน docker ps ได้)
docker log my-container

### ----------------------------------------------------------------- ###
### รู้จักกับ docker-compose.yml ไฟล์ ###
เราจะเริ่มต้นโดยการลองเปลี่ยน node เป็น docker-compose.yml กันก่อน โดย

# เราจะใช้ Dockerfile อันเดิมที่เราสร้าง
เราจะเปลี่ยนจาก docker run เปลี่ยนเป็นการ run จาก docker-compose.yml
เราจะ start service ด้วย docker-compose up -d --build
ที่ docker-compose.yml เราจะมีหน้าตาแบบนี้

# pattern ของ yaml file คือ key: value โดย ถ้าอันไหนเป็นลูกของ key ไหนก็จะเลื่อน tab ไป
ภายใต้ services = จำนวน container ที่จะ run ใน docker-compose

version: '3' # กำหนด docker version
services:
  node-server: # ตั้งชื่อ container (เหมือน --name)
    build: . # ตำแหน่ง dockerfile
    ports:
      - "8000:8000" # map port ออกมา เหมือน -p ใน docker run 

# วางไว้ตำแหน่งเดียวกันกับ folder project แล้วลอง run ด้วยคำสั่ง
# command
docker-compose up -d --build

จะได้ผลลัพธ์ออกมาเหมือนกันกับก่อนหน้านี้ (สามารถเช็คได้ด้วย docker ps เช่นกัน)

# เสร็จแล้วลอง stop container ด้วยคำสั่ง
# command
docker-compose down

### ----------------------------------------------------------------- ###
### map storage ใน mysql ###
1. map ด้วยการ mount path

services:
  db:
    image: mysql:latest
    container_name: db
    command: --default-authentication-plugin=mysql_native_password
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: tutorial
    ports:
      - "3306:3306"
    volumes:
      - /data:/var/lib/mysql

storage-1

2. map ด้วย docker volume

services:
  ...
  db:
    image: mysql:latest
    container_name: db
    command: --default-authentication-plugin=mysql_native_password
    environment:
      MYSQL_ROOT_PASSWORD: root
      MYSQL_DATABASE: tutorial
    ports:
      - "3306:3306"
    volumes:
      - mysql_data_test:/var/lib/mysql # เปลี่ยน path เป็น volume ที่เราสร้างไปด้านล่างใน docker-compose

volumes:
  mysql_data_test: # กำหนดชื่อ volume ที่ต้องการจะสร้าง
    driver: local


หลังจาก run เสร็จลองดู volume ทั้งหมดโดยใช้คำสั่ง docker volume ls จะเจอ volume ทั้งหมดและเจอชื่อ volume ที่สร้างออกมาได้

### ----------------------------------------------------------------- ###
### วิธีการเข้าไปสำรวจใน container ###

# command
docker exec -it <container name> sh

# example
docker exec -it mysql sh

# ถ้าอันไหน support bash ก็ใช้ bash แทนได้
docker exec -it mysql bash