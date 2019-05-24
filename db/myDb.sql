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