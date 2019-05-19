CREATE TABLE Users
( 
    UserId INT PRIMARY KEY,
    UserName VARCHAR(128),
    HashedPassword VARCHAR(128),
    Salt VARCHAR(128)
);

CREATE TABLE Recipes
(
    RecipeId INT PRIMARY KEY,
    Creator INT,
    RecipeName TEXT,
    RecipeType INT,
    Methods TEXT,
    Skill INT,
    PrepTime INT,
    Date_Created DATE,
    Last_Updated DATE,

    FOREIGN KEY (Creator) REFERENCES Users(UserId),
    FOREIGN KEY (RecipeType) REFERENCES RecipeTypes(TypeId),
    FOREIGN KEY (Skill) REFERENCES SkillLevel(LevelId)
);

CREATE TABLE Ingredients
(
    IngredientId INT PRIMARY KEY,
    IngredientName VARCHAR(128),
    Measurement INT,

    FOREIGN KEY (Measurement) REFERENCES MeasureTypes(MeasureId)
);

CREATE TABLE RecipeJoin
(
    JoinId INT PRIMARY KEY,
    RecipeId INT,
    IngredientId INT,
    Count INT,

    FOREIGN KEY (RecipeId) REFERENCES Recipes(RecipeId),
    FOREIGN KEY (IngredientId) REFERENCES Ingredients(IngredientId)
);

CREATE TABLE RecipeTypes
(
    TypeId INT PRIMARY KEY,
    TypeName VARCHAR(128)
);

CREATE TABLE SkillLevel
(
    LevelId INT PRIMARY KEY,
    SkillName VARCHAR(128)
);

CREATE TABLE MeasureTypes
(
    MeasureId INT PRIMARY KEY,
    MeasureName VARCHAR(128)
);