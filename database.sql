CREATE DATABASE IF NOT EXISTS videogames_review;
USE videogames_review;

CREATE TABLE IF NOT EXISTS users (
  id int(255) auto_increment not null,
  rol varchar(20),
  nick varchar(100),
  email varchar(255),
  password varchar(255),
  image varchar(255),
  created_at datetime,
  updated_at datetime,
  remember_token varchar(255),
  CONSTRAINT pk_users PRIMARY KEY(id)
) ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS genres (
id   int(255)auto_increment not null,
name varchar(255),
CONSTRAINT pk_genres PRIMARY KEY(id)
) ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS platforms (
id  int(255) auto_increment not null,
name varchar(255),
CONSTRAINT pk_platforms PRIMARY KEY(id)
)ENGINE=InnoDb;



CREATE TABLE IF NOT EXISTS games (
  id int(255) auto_increment not null,
  platform_id int(255),
  title varchar(100),
  description text,
  date date,
  developer varchar(255),
  rating float(8,2),
  image varchar(255),
  created_at datetime,
  updated_at datetime,
  CONSTRAINT pk_games PRIMARY KEY(id),
  CONSTRAINT fk_games_platform FOREIGN KEY(platform_id) REFERENCES platforms(id)
) ENGINE=InnoDb;



CREATE TABLE IF NOT EXISTS reviews (
  id int(255) auto_increment not null,
  user_id int(255),
  game_id int(255),
  comment  varchar(255),
  rating   int(10),
  created_at datetime,
  updated_at datetime,
  CONSTRAINT pk_reviews PRIMARY KEY(id),
  CONSTRAINT fk_reviews_users FOREIGN KEY(user_id) REFERENCES users(id),
  CONSTRAINT fk_reviews_games FOREIGN KEY(game_id) REFERENCES games(id)

) ENGINE=InnoDb;


CREATE TABLE IF NOT EXISTS likes  (
  id int(255) auto_increment not null,
  user_id int(255),
  review_id int(255),
  created_at datetime,
  updated_at datetime,
  CONSTRAINT pk_likes PRIMARY KEY(id),
  CONSTRAINT fk_likes_users FOREIGN KEY(user_id) REFERENCES users(id),
  CONSTRAINT fk_likes_reviews FOREIGN KEY(review_id) REFERENCES reviews(id)

) ENGINE=InnoDb;

CREATE TABLE IF NOT EXISTS detail_genres(
id int(255) auto_increment not null,
game_id int(255),
genre_id int(255),
CONSTRAINT pk_detail_genres PRIMARY KEY(id),
CONSTRAINT fk_detail_genres FOREIGN KEY(genre_id) REFERENCES genres(id),
CONSTRAINT fk_detail_games FOREIGN KEY(game_id) REFERENCES games(id)

) ENGINE=InnoDb;
