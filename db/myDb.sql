CREATE TABLE Users
( 
    UserId SERIAL PRIMARY KEY,
    UserName VARCHAR(128),
    HashedPassword VARCHAR(128),
    Salt VARCHAR(128)
);

CREATE TABLE RecipeTypes
(
    TypeId SERIAL PRIMARY KEY,
    TypeName VARCHAR(128)
);

CREATE TABLE SkillLevel
(
    LevelId SERIAL PRIMARY KEY,
    SkillName VARCHAR(128)
);

CREATE TABLE Recipes
(
    RecipeId SERIAL PRIMARY KEY,
    Creator INTEGER,
    RecipeName TEXT,
    RecipeType INTEGER,
    Methods TEXT,
    Skill INTEGER,
    PrepTime INT,
    Date_Created DATE,
    Last_Updated DATE,

    FOREIGN KEY (Creator) REFERENCES Users(UserId),
    FOREIGN KEY (RecipeType) REFERENCES RecipeTypes(TypeId),
    FOREIGN KEY (Skill) REFERENCES SkillLevel(LevelId)
);

CREATE TABLE Ingredients
(
    IngredientId SERIAL PRIMARY KEY,
    IngredientName VARCHAR(128)
);

CREATE TABLE RecipeJoin
(
    JoinId SERIAL PRIMARY KEY,
    RecipeId INTEGER,
    IngredientId INTEGER,
    Count INT,

    FOREIGN KEY (RecipeId) REFERENCES Recipes(RecipeId),
    FOREIGN KEY (IngredientId) REFERENCES Ingredients(IngredientId)
);

-- DROP TABLE RecipeJoin;
-- DROP TABLE Ingredients;
-- DROP TABLE Recipes;
-- DROP TABLE SkillLevel;
-- DROP TABLE RecipeTypes;
-- DROP TABLE Users;

INSERT INTO Ingredients (IngredientName) VALUES ('carrots');
INSERT INTO Ingredients (IngredientName) VALUES ('soy sauce');
INSERT INTO Ingredients (IngredientName) VALUES ('strawberries');
INSERT INTO Ingredients (IngredientName) VALUES ('mint');
INSERT INTO Ingredients (IngredientName) VALUES ('chicken');
INSERT INTO Ingredients (IngredientName) VALUES ('tomatoes');
INSERT INTO Ingredients (IngredientName) VALUES ('cheese');
INSERT INTO Ingredients (IngredientName) VALUES ('salt');
INSERT INTO Ingredients (IngredientName) VALUES ('pepper');
INSERT INTO Ingredients (IngredientName) VALUES ('potatoes');
INSERT INTO Ingredients (IngredientName) VALUES ('cucumber');
INSERT INTO Ingredients (IngredientName) VALUES ('bananas');
INSERT INTO Ingredients (IngredientName) VALUES ('onions');
INSERT INTO Ingredients (IngredientName) VALUES ('garlic');
INSERT INTO Ingredients (IngredientName) VALUES ('thyme');
INSERT INTO Ingredients (IngredientName) VALUES ('barbecue sauce');
INSERT INTO Ingredients (IngredientName) VALUES ('corn');
INSERT INTO Ingredients (IngredientName) VALUES ('pasta');
INSERT INTO Ingredients (IngredientName) VALUES ('parsley');
INSERT INTO Ingredients (IngredientName) VALUES ('ground beef');
INSERT INTO Ingredients (IngredientName) VALUES ('steak');
INSERT INTO Ingredients (IngredientName) VALUES ('eggplants');
INSERT INTO Ingredients (IngredientName) VALUES ('eggs');
INSERT INTO Ingredients (IngredientName) VALUES ('watermelon');
INSERT INTO Ingredients (IngredientName) VALUES ('vegetable oil');
INSERT INTO Ingredients (IngredientName) VALUES ('olive oil');
INSERT INTO Ingredients (IngredientName) VALUES ('oranges');
INSERT INTO Ingredients (IngredientName) VALUES ('lemons');
INSERT INTO Ingredients (IngredientName) VALUES ('limes');
INSERT INTO Ingredients (IngredientName) VALUES ('apples');
INSERT INTO Ingredients (IngredientName) VALUES ('mangoes');
INSERT INTO Ingredients (IngredientName) VALUES ('flour');
INSERT INTO Ingredients (IngredientName) VALUES ('sugar');
INSERT INTO Ingredients (IngredientName) VALUES ('water');
INSERT INTO Ingredients (IngredientName) VALUES ('milk');