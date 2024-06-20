# การระบุตัวตนโดยเราจะต้องใส่ชื่อกับอีเมล์ของเราให้ git จำไว้ เพื่อเวลาที่มีการแก้ไขจะได้รู้ว่าใครเป็นคนแก้ไข โดยอีเมล์แนะนำให้ใช้อันเดียวกับที่สมัคร GitHub ส่วนชื่อก็อะไรก็ได้ เหมือน username บน GitHub ก็ดี

$ git config --global user.name "Your Name"
$ git config --global user.email yourEmail@example.com

# คำสั่งพื้นฐาน
คำส่ัง git
โดยพื้นฐานแล้ว git มีคำสั่งที่หลากหลายมากมายมหาศาลมาก แต่เราจะเริ่มกันด้วยคำสั่งเบื้องต้นที่ทำให้เราสามารถใช้งานได้ก่อนอันได้แก่

git init ใช้สร้าง local repo ขึ้นมา
git add ใช้ stage เพื่อติดตามตามความเปลี่ยนแปลงของไฟล์
git commit ใช้เพื่อบันทึกความเปลี่ยนแปลงที่เกิดขึ้นสู่ local repo
git push ใช้เพื่อส่ง commit ไปยัง remote repo
git clone ใช้เพื่อคัดลอก repo จาก remote มายัง local
git fetch ใช้ดึงความเปลี่ยนแปลงจาก remote มายัง local แต่ยังไม่รวมเข้าด้วยกัน
git merge ใช้รวมความเปลี่ยนแปลงที่ได้มาจาก fetch เข้ากับ local
git pull ใช้ดึงความเปลี่ยนแปลงจาก remote มายัง local และรวมเข้าด้วยกัน (มีค่าเท่ากับ fetch+merge)
git log ใช้เพื่อดูว่า git repo มี commit อะไรแล้วบ้าง

# init local repo & add remote repo
# เข้าไปในโฟลเดอร์ gitrepo
$ cd gitrepo

# สร้าง local repo ในโฟลเดอร์ gitrepo
$ git init
Initialized empty Git repository in /Users/username/gitrepo/.git/

# ลิสต์ไฟล์ที่อยู่ในโฟลเดอร์นี้
$ ls
readme.md

# คราวนี้ลิสต์ไฟล์ทั้งหมด ซึ่งเราจะเห็นโฟลเดอร์ .git ด้วย โฟลเดอร์ .git
# นี่แหละที่ทำหน้าที่เก็บความเปลี่ยนแปลงทั้งหมด
$ ls -a
.         ..        .git      readme.md

# ต่อมาเราจะมาเช็คว่า local repo นี้มี remote repo รึยัง
$ git remote -v

# เมื่อยังไม่มี remote repo เราก็จะเพิ่มมันเข้าไป โดยใช้ url ที่ก็อปปี้ไว้เมื่อกี้
$ git remote add origin https://github.com/winnerboy7/gitrepo.git
$ git remote -v
origin  https://github.com/winnerboy7/gitrepo.git (fetch)
origin  https://github.com/winnerboy7/gitrepo.git (push)
check status
# คำสั่งตรวจสอบ status ของ repo เราจะใช้เพื่อตรวจสอบว่ามีอะไรเปลี่ยนแปลง
# บ้างมั้ยใน repo ของเรา ถ้ามีเกิดความเปลี่ยนแปลงอะไรขึ้นบ้าง กับไฟล์ไหนบ้างเป็นต้น
$ git status
On branch master

Initial commit

# เราจะพบว่ามีไฟล์ใน working dir ที่ยังไม่ได้ stage หรือถูกติดตามความ
# เปลี่ยนแปลงอยู่ ซึ่งก็คือ readme.md นั่นเอง
Untracked files:
  (use "git add <file>..." to include in what will be committed)

        readme.md

nothing added to commit but untracked files present (use "git add" to track)
stage files & check status
# ดังนั้นเราจะมาติดตามมันด้วยคำสั่ง add โดยในที่นี้เราใช้ . แทนชื่อไฟล์ โดย .
# หมายถึงทุกไฟล์ในโฟลเดอร์ gitrepo นั่นเอง
$ git add .
$ git status
On branch master

Initial commit

# ตรงนี้บอกเราว่ามีไฟล์ที่เปลี่ยนแปลงและรอการ commit อยู่นะ
Changes to be committed:
  (use "git rm --cached <file>..." to unstage)

# โดยการเปลี่ยนแปลงนี้คือการสร้างไฟล์ใหม่ขึ้นมา ชื่อ readme.md
        new file:   readme.md
commit staged files

# การ commit คือการบันทึกความเปลี่ยนแปลงเข้าสู่ repo ของเรา เป็นการย้าย
# จาก staging state ไปยัง repository state นั่นเอง
$ git commit -m "initial commit"
[master (root-commit) 8eec696] initial commit
1 file changed, 0 insertions(+), 0 deletions(-)
 create mode 100644 readme.md
check commits log
# เราสามารถตรวจสอบ commit ที่เกิดขึ้นใน repo ได้ด้วยคำสั่ง log
$ git log

# ซึ่งตรงนี้จะเข้าหน้าใหม่ ใช้ลูกศรเพื่อนำทาง หรือกด q เพื่อออก
commit 8eec6969f1e74ac2cef7411848def896a8c97582
Author: winnerboy7 <tulakan-@hotmail.com>
Date:   Wed Dec 16 11:38:54 2015 +0900

    initial commit
(END)

# เอาล่ะ มาถึงตรงนี้เราก็ได้มา commit นึงแล้ว จากนี้เราจะทำการ push จาก local ขึ้นไปยัง remote repo โดยการ push เบื้องต้นเราต้องกำหนดว่าเราจะ push ไปที่ไหน (ในที่นี้คือ origin ให้คิดว่าเรากำหนดให้ remote repo คือ original copy และในเครื่องของเราก็มี local copy อยู่ด้วย) และ push ไป branch อะไร (ในที่นี้คือ master)

$ git push origin master
# กรอก username กับ password
Username for 'https://github.com':
Password for 'https://winnerboy7@github.com':
Counting objects: 3, done.
Writing objects: 100% (3/3), 212 bytes | 0 bytes/s, done.
Total 3 (delta 0), reused 0 (delta 0)
To https://github.com/winnerboy7/gitrepo.git
 * [new branch]      master -> master

# เราจะเห็นได้ว่าการ push ทุกครั้งนั้นเราจะต้องกรอก username และ password ซึ่งก็เป็นรูปแบบการรักษาความปลอดภัยผ่านโปรโตคอล HTTPS ถ้าเริ่มเบื่อที่จะกรอกแล้วก็แนะนำให้ไปทำความรู้จักกับ SSH หรือ Secure Shell สำหรับ GitHub ซึ่งจะใช้รูปแบบอื่นในการรักษาความปลอดภัย

# เราจะ clone repo นี้มาไว้ที่เครื่องเรา แต่ไม่ใช่ที่เดิม เป็นเหมือนการจำลองว่าเรา clone ไปในอีกเครื่องนึงนะ โดยเราจะ clone ไปไว้ใน dir เดียวกับที่โฟลเดอร์ gitrepo ของเราอยู่นั่นแหละ แต่ใช้ชื่อว่า another_pc_gitrepo ไปที่ terminal เลย

# ก่อนอื่นก็เช็คก่อนว่าเราอยู่ที่ dir ไหน
$ pwd
/Users/username/gitrepo

# แล้วก็ย้อนกลับขึ้นไปที่ /Users/username
$ cd ..

# จากนั้นก็ clone remote repo มาใส่โฟลเดอร์ชื่อ another_pc_gitrepo
$ git clone https://github.com/winnerboy7/gitrepo.git another_pc_gitrepo
gitrepo.git another_pc_gitrepo
Cloning into 'another_pc_gitrepo'...
remote: Counting objects: 3, done.
remote: Total 3 (delta 0), reused 3 (delta 0), pack-reused 0
Unpacking objects: 100% (3/3), done.
Checking connectivity... done.

# ลิสต์โฟลเดอร์ทั้งหมดอีกครั้ง จะพบว่าเรามีโฟลเดอร์ชื่อ another_pc_gitrepo ด้วย
$ ls
Desktop    Documents    Downloads    gitrepo    another_pc_gitrepo
$ cd another_pc_gitrepo

# โอเค ตอนนี้เราย้ายมาอยู่ใน another_pc_gitrepo กันแล้ว เราจะมาลองแก้ไฟล์กัน เปิดไฟล์ readme.md ที่อยู่ในโฟลเดอร์ another_pc_gitrepo ขึ้นมา ใช้โปรแกรมอะไรก็ได้เช่น Notepad, TextEdit หรือจะ Gedit ก็ได้หมด เราจะลองสร้างความเปลี่ยนแปลงให้มันกัน

<!-- in readme.md file -->
# Hello
Hello, it's me, I was wondering...

สวัสดี นี่คือไฟล์ `readme.md` ที่ได้ถูกแก้ไขจากโฟลเดอร์ `another_pc_gitrepo`
เสร็จแล้วก็เซฟแล้วกลับไปที่ terminal คราวนี้เราจะติดตาม, บันทึกความเปลี่ยนแปลงแล้วก็ push มันกลับไปที่ repo อีกครั้ง

# ตรวจสอบ status ก่อน
$ git status
On branch master
Your branch is up-to-date with 'origin/master'.
# มีความเปลี่ยนแปลงที่ยังไม่ได้ stage อยู่
Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git checkout -- <file>..." to discard changes in working directory)

        modified:   readme.md

no changes added to commit (use "git add" and/or "git commit -a")

# ทำการ stage แล้วก็ commit ซะ
$ git add .
$ git commit -m "from another_pc_gitrepo"
[master fc8d069] from another_pc_gitrepo
 1 file changed, 4 insertions(+)

# จากนั้นเราก็จะมาเช็ค log กันแบบสั้นๆ
$ git log --oneline

fc8d069 from another_pc_gitrepo
8eec696 initial commit
(END)

# แล้วก็ push to origin (remote repo)
$ git push origin master
Username for 'https://github.com':
Password for 'https://winnerboy7@github.com':
Counting objects: 3, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (2/2), done.
Writing objects: 100% (3/3), 412 bytes | 0 bytes/s, done.
Total 3 (delta 0), reused 0 (delta 0)
To https://github.com/winnerboy7/gitrepo.git
   8eec696..fc8d069  master -> master

#  ไฟล์ที่ถูกแก้ใน another_pc_gitrepo ได้ถูก push ไปยัง remote repo แล้ว คำถามต่อไป แล้ว gitrepo อันแรกล่ะ? นั่นน่ะสิ ไปลองดูกันเถอะ

# ออกจาก `another_pc_gitrepo` ก่อน
$ cd ..
$ cd gitrepo

# ดึงความเปลี่ยนแปลงลงมาตรวจสอบ
$ git fetch
remote: Counting objects: 3, done.
remote: Compressing objects: 100% (2/2), done.
remote: Total 3 (delta 0), reused 3 (delta 0), pack-reused 0
Unpacking objects: 100% (3/3), done.
From https://github.com/winnerboy7/gitrepo
   8eec696..fc8d069  master     -> origin/master

$ git log origin/master --oneline

fc8d069 from another_pc_gitrepo
8eec696 initial commit
(END)

# จะเห็นได้ว่ามี commit เพิ่มขึ้นมาหนึ่งอันจาก another_pc_gitrepo ที่เราแก้เมื่อกี้นี่เอง แต่ fetch แล้วมันยังไม่รวมร่างกันนะ ไม่เชื่อลองไปเปิดไฟล์ gitrepo/readme.md ดูก็ได้ คราวนี้เราจะมารวมความเปลี่ยนแปลงที่เกิดขึ้นเข้ากับไฟล์ใน gitrepo นี้กัน

$ git merge origin/master
Updating 8eec696..fc8d069
Fast-forward
 readme.md | 4 ++++
 1 file changed, 4 insertions(+)

# เรียบร้อย ทีนี้ลองเปิดไฟล์อีกรอบได้ ก็จะเห็นว่าไฟล์ gitrepo/readme.md ของเราได้รับความเปลี่ยนแปลงจาก another_pc_gitrepo/readme.md แล้ว เฮ~ แต่เรายังเหลืออีกคำสั่งที่ยังไม่ได้ใช้นั่นก็คือ git pull มาลองใช้กันแบบเร็วๆ เลย ก่อนอื่นก็ไปแก้ gitrepo/readme.md ก่อน

<!-- in readme.md file -->
# Hello
Hello, it's me, I was wondering...

สวัสดี นี่คือไฟล์ `readme.md` ที่ได้ถูกแก้ไขจากโฟลเดอร์ `another_pc_gitrepo`

ส่วนบรรทัดนี้ได้ถูกแก้ไขจากโฟลเดอร์ `gitrepo`
เสร็จแล้วก็ไปที่ terminal กัน

# check status
$ git status
On branch master
Changes not staged for commit:
  (use "git add <file>..." to update what will be committed)
  (use "git checkout -- <file>..." to discard changes in working directory)

        modified:   readme.md

no changes added to commit (use "git add" and/or "git commit -a")

# stage file
$ git add . && git commit -m "edit on gitrepo"
[master bc4c7e2] edit on gitrepo
 1 file changed, 2 insertions(+)

# push to remote
$ git push origin master
Username for 'https://github.com':
Password for 'https://winnerboy7@github.com':
Counting objects: 3, done.
Delta compression using up to 4 threads.
Compressing objects: 100% (2/2), done.
Writing objects: 100% (3/3), 321 bytes | 0 bytes/s, done.
Total 3 (delta 1), reused 0 (delta 0)
To https://github.com/winnerboy7/gitrepo.git
   fc8d069..bc4c7e2  master -> master

# go to another_pc_gitrepo folder
$ cd ../another_pc_gitrepo
$ git pull origin master
remote: Counting objects: 3, done.
remote: Compressing objects: 100% (1/1), done.
remote: Total 3 (delta 1), reused 3 (delta 1), pack-reused 0
Unpacking objects: 100% (3/3), done.
From https://github.com/winnerboy7/gitrepo
 * branch            master     -> FETCH_HEAD
   fc8d069..bc4c7e2  master     -> origin/master
Updating fc8d069..bc4c7e2
Fast-forward
 readme.md | 2 ++
 1 file changed, 2 insertions(+)

# จากการ pull เราจะเห็นความแตกต่างก็คือ pull นั้นดึงความเปลี่ยนแปลงจาก remote มาแล้วทำการรวมเข้าด้วยกันกับ repo ที่อยู่ในเครื่องของเราเลย หรือเทียบเท่ากับ fetch + merge นั่นเอง