CREATE TABLE Users (
    UserId SERIAL,
    UserName VARCHAR(32),
    UserPassword VARCHAR(256),

    PRIMARY KEY (UserId)
);