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

CREATE TABLE Recipes_Ingredients
(
    JoinId SERIAL PRIMARY KEY,
    RecipeId INTEGER,
    IngredientId INTEGER,
    Measurement VARCHAR(128),

    FOREIGN KEY (RecipeId) REFERENCES Recipes(RecipeId),
    FOREIGN KEY (IngredientId) REFERENCES Ingredients(IngredientId)
);

-- DROP TABLE Recipes_Ingredients;
-- DROP TABLE Ingredients;
-- DROP TABLE Recipes;
-- DROP TABLE SkillLevel;
-- DROP TABLE RecipeTypes;
-- DROP TABLE Users;

--
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
    INSERT INTO Ingredients (IngredientName) VALUES ('Barbecue Sauce');
    INSERT INTO Ingredients (IngredientName) VALUES ('Corn');
    INSERT INTO Ingredients (IngredientName) VALUES ('Pasta');
    INSERT INTO Ingredients (IngredientName) VALUES ('Parsley');
    INSERT INTO Ingredients (IngredientName) VALUES ('Ground Beef');
    INSERT INTO Ingredients (IngredientName) VALUES ('Steak');
    INSERT INTO Ingredients (IngredientName) VALUES ('Eggplants');
    INSERT INTO Ingredients (IngredientName) VALUES ('Eggs');
    INSERT INTO Ingredients (IngredientName) VALUES ('Watermelon');
    INSERT INTO Ingredients (IngredientName) VALUES ('Vegetable oil');
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
    INSERT INTO Ingredients (IngredientName) VALUES ('Yeast');

--
    INSERT INTO Users (UserName) VALUES ('Tyler');
--
    INSERT INTO RecipeTypes (TypeName) VALUES ('Breakfast');
    INSERT INTO RecipeTypes (TypeName) VALUES ('Lunch');
    INSERT INTO RecipeTypes (TypeName) VALUES ('Snack');
    INSERT INTO RecipeTypes (TypeName) VALUES ('Appetizer');
    INSERT INTO RecipeTypes (TypeName) VALUES ('Main course');
    INSERT INTO RecipeTypes (TypeName) VALUES ('Dessert');
--
    INSERT INTO SkillLevel (SkillName) VALUES ('Easy');
    INSERT INTO SkillLevel (SkillName) VALUES ('Intermediate');
    INSERT INTO SkillLevel (SkillName) VALUES ('Advanced');
--
    INSERT INTO Recipes (
        Creator,
        RecipeName, 
        RecipeType,
        Methods,
        Skill,
        PrepTime,
        Date_Created,
        Last_Updated
    ) VALUES (
        1,
        'Cacio e Pepe',
        (SELECT TypeId FROM RecipeTypes WHERE TypeName = 'Appetizer'),
        'Cook pasta, reserving some pasta water. Add pecorino romano cheese and pepper, toss vigorously.',
        (SELECT LevelId FROM SkillLevel WHERE SkillName = 'Advanced'),
        30,
        NOW(),
        NOW()
    );

    INSERT INTO Recipes_Ingredients (RecipeId, IngredientId, Measurement) VALUES (
        (SELECT RecipeId FROM Recipes WHERE RecipeName = 'Cacio e Pepe'),
        (SELECT IngredientId FROM Ingredients WHERE IngredientName = 'Cheese'),
        '1/2 cup'
    );
    INSERT INTO Recipes_Ingredients (RecipeId, IngredientId, Measurement) VALUES (
        (SELECT RecipeId FROM Recipes WHERE RecipeName = 'Cacio e Pepe'),
        (SELECT IngredientId FROM Ingredients WHERE IngredientName = 'Pasta'),
        '1 pound'
    );

    INSERT INTO Recipes_Ingredients (RecipeId, IngredientId, Measurement) VALUES (
        (SELECT RecipeId FROM Recipes WHERE RecipeName = 'Cacio e Pepe'),
        (SELECT IngredientId FROM Ingredients WHERE IngredientName = 'Pepper'),
        '1 tablespoon'
    );
--

    INSERT INTO Recipes (
        Creator,
        RecipeName, 
        RecipeType,
        Methods,
        Skill,
        PrepTime,
        Date_Created,
        Last_Updated
    ) VALUES (
        1,
        'Bread',
        (SELECT TypeId FROM RecipeTypes WHERE TypeName = 'Lunch'),
        'Combine water and yeast, let proof. Add salt and flour and knead for 5-10 minutes. Let rise for 1 hour. Punch down and place in bread pans. Let rise for 30 minutes more and then bake at 350 F for 20-25 minutes.',
        (SELECT LevelId FROM SkillLevel WHERE SkillName = 'Intermediate'),
        180,
        NOW(),
        NOW()
    );

    INSERT INTO Recipes_Ingredients (RecipeId, IngredientId, Measurement) VALUES (
        (SELECT RecipeId FROM Recipes WHERE RecipeName = 'Bread'),
        (SELECT IngredientId FROM Ingredients WHERE IngredientName = 'Flour'),
        '6 cups'
    );
    INSERT INTO Recipes_Ingredients (RecipeId, IngredientId, Measurement) VALUES (
        (SELECT RecipeId FROM Recipes WHERE RecipeName = 'Bread'),
        (SELECT IngredientId FROM Ingredients WHERE IngredientName = 'Water'),
        '2 cups'
    );
    INSERT INTO Recipes_Ingredients (RecipeId, IngredientId, Measurement) VALUES (
        (SELECT RecipeId FROM Recipes WHERE RecipeName = 'Bread'),
        (SELECT IngredientId FROM Ingredients WHERE IngredientName = 'Yeast'),
        '1 tablespoon'
    );
    INSERT INTO Recipes_Ingredients (RecipeId, IngredientId, Measurement) VALUES (
        (SELECT RecipeId FROM Recipes WHERE RecipeName = 'Bread'),
        (SELECT IngredientId FROM Ingredients WHERE IngredientName = 'Salt'),
        '1 tablespoon'
    );
