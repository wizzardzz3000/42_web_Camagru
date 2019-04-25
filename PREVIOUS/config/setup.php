#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        user_id       Int  Auto_increment  NOT NULL ,
        user_pseudo   Varchar (100) NOT NULL ,
        user_password Varchar (100) NOT NULL ,
        user_email    Varchar (100) NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (user_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: photos
#------------------------------------------------------------

CREATE TABLE photos(
        photo_id      Int  Auto_increment  NOT NULL ,
        photo_content Varchar (500) NOT NULL
	,CONSTRAINT photos_PK PRIMARY KEY (photo_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: likes
#------------------------------------------------------------

CREATE TABLE likes(
        photo_id Int NOT NULL ,
        user_id  Int NOT NULL
	,CONSTRAINT likes_PK PRIMARY KEY (photo_id,user_id)

	,CONSTRAINT likes_photos_FK FOREIGN KEY (photo_id) REFERENCES photos(photo_id)
	,CONSTRAINT likes_user0_FK FOREIGN KEY (user_id) REFERENCES user(user_id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: comments
#------------------------------------------------------------

CREATE TABLE comments(
        user_id          Int NOT NULL ,
        photo_id         Int NOT NULL ,
        user_id_comments Int NOT NULL ,
        photo_id_photos  Int NOT NULL
	,CONSTRAINT comments_PK PRIMARY KEY (user_id,photo_id,user_id_comments,photo_id_photos)

	,CONSTRAINT comments_user_FK FOREIGN KEY (user_id) REFERENCES user(user_id)
	,CONSTRAINT comments_photos0_FK FOREIGN KEY (photo_id) REFERENCES photos(photo_id)
	,CONSTRAINT comments_user1_FK FOREIGN KEY (user_id_comments) REFERENCES user(user_id)
	,CONSTRAINT comments_photos2_FK FOREIGN KEY (photo_id_photos) REFERENCES photos(photo_id)
)ENGINE=InnoDB;