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

INSERT INTO Ingredients (IngredientName) VALUES ('Carrots');
INSERT INTO Ingredients (IngredientName) VALUES ('Soy Sauce');
INSERT INTO Ingredients (IngredientName) VALUES ('Strawberries');
INSERT INTO Ingredients (IngredientName) VALUES ('Mint');
INSERT INTO Ingredients (IngredientName) VALUES ('Chicken');
INSERT INTO Ingredients (IngredientName) VALUES ('Tomatoes');
INSERT INTO Ingredients (IngredientName) VALUES ('Cheese');
INSERT INTO Ingredients (IngredientName) VALUES ('Salt');
INSERT INTO Ingredients (IngredientName) VALUES ('Pepper');
INSERT INTO Ingredients (IngredientName) VALUES ('Potatoes');
INSERT INTO Ingredients (IngredientName) VALUES ('Cucumber');
INSERT INTO Ingredients (IngredientName) VALUES ('Bananas');
INSERT INTO Ingredients (IngredientName) VALUES ('Onions');
INSERT INTO Ingredients (IngredientName) VALUES ('Garlic');
INSERT INTO Ingredients (IngredientName) VALUES ('Thyme');
INSERT INTO Ingredients (IngredientName) VALUES ('BBQ Sauce');
INSERT INTO Ingredients (IngredientName) VALUES ('Corn');
INSERT INTO Ingredients (IngredientName) VALUES ('Pasta');
INSERT INTO Ingredients (IngredientName) VALUES ('Parsley');
INSERT INTO Ingredients (IngredientName) VALUES ('Ground Beef');
INSERT INTO Ingredients (IngredientName) VALUES ('Steak');
INSERT INTO Ingredients (IngredientName) VALUES ('Eggplants');
INSERT INTO Ingredients (IngredientName) VALUES ('Eggs');
INSERT INTO Ingredients (IngredientName) VALUES ('Watermelon');
INSERT INTO Ingredients (IngredientName) VALUES ('Vegetable Oil');
INSERT INTO Ingredients (IngredientName) VALUES ('Olive Oil');
INSERT INTO Ingredients (IngredientName) VALUES ('Oranges');
INSERT INTO Ingredients (IngredientName) VALUES ('Lemons');
INSERT INTO Ingredients (IngredientName) VALUES ('Limes');
INSERT INTO Ingredients (IngredientName) VALUES ('Apples');
INSERT INTO Ingredients (IngredientName) VALUES ('Mangoes');
INSERT INTO Ingredients (IngredientName) VALUES ('Flour');
INSERT INTO Ingredients (IngredientName) VALUES ('Sugar');
INSERT INTO Ingredients (IngredientName) VALUES ('Water');
INSERT INTO Ingredients (IngredientName) VALUES ('Milk');