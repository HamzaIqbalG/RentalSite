-- Dropping the rentalDB database if it exists and then creating it
DROP DATABASE IF EXISTS rentalDB;
CREATE DATABASE rentalDB;
USE rentalDB;

-- Creation of the Person table
-- This table stores information about individuals, with a unique ID and contact details.
CREATE TABLE Person (
    ID INT NOT NULL,             -- A unique identifier for each person.
    Phone CHAR(10) NOT NULL,     -- The person's phone number, fixed at 10 characters to fit standard CA phone numbers.
    FName VARCHAR(50) NOT NULL,  -- The person's first name, with a variable length of up to 50 characters.
    LName VARCHAR(50) NOT NULL,  -- The person's last name, also with a variable length of up to 50 characters.
    PRIMARY KEY (ID)             -- The ID column is designated as the primary key, which means each value must be unique and not NULL.
);

-- Creation of the RentalGroup table
-- This table stores information about groups of rentals, such as apartments or houses.
CREATE TABLE RentalGroup (
    Code INT NOT NULL,             -- A unique code identifying the rental group.
    Parking CHAR(1) NOT NULL,      -- A 'Y' or 'N' value indicating the availability of parking.
    Accessibility VARCHAR(50),     -- A description of accessibility features, up to 50 characters. This column can be NULL if there are no features to describe.
    Cost DECIMAL(10,2) NOT NULL,   -- how much rental group is paying 
    Bedrooms INT NOT NULL,         -- The number of bedrooms in the rental group.
    Bathrooms INT NOT NULL,        -- The number of bathrooms in the rental group.
    Laundry CHAR(1) NOT NULL,      -- A 'Y' or 'N' value indicating the availability of laundry services.
    typeAcc VARCHAR(50) NOT NULL,  -- The type of accommodation, such as 'Apartment', 'House', etc.
    PRIMARY KEY (Code)             -- The Code is set as the primary key, so it must be unique and not NULL.
);

-- Creation of the Manager table
-- This table is for property managers who manage the rental properties.
CREATE TABLE Manager (
    ID INT NOT NULL,             -- The manager's unique ID, which references an ID in the Person table.
    PRIMARY KEY (ID),            -- This ID is the primary key, ensuring each manager has a unique identifier.
    FOREIGN KEY (ID) REFERENCES Person(ID) -- This establishes a foreign key relationship with the Person table, meaning the ID must exist in the Person table before it can be inserted here.
);


-- Creation of the Property table
CREATE TABLE Property (
    ID INT NOT NULL, -- Unique identifier for each property
    Accessibility VARCHAR(50) NOT NULL, -- Accessibility features of the property
    Parking CHAR(1) NOT NULL, -- Parking availability at the property ('Y' or 'N')
    DateListed DATE NOT NULL, -- Date when the property was listed for rent
    NumBaths INT NOT NULL, -- Number of bathrooms in the property
    NumBeds INT NOT NULL, -- Number of bedrooms in the property
    Street VARCHAR(100) NOT NULL, -- Street address of the property
    Apartment VARCHAR(50) NOT NULL, -- Apartment number or identifier, if applicable
    Province CHAR(2) NOT NULL, -- Province code where the property is located (ie. ON, BC, etc.)
    City VARCHAR(50) NOT NULL, -- City where the property is located
    PC CHAR(6) NOT NULL, -- Postal code of the property
    RentalGroupCode INT UNIQUE NOT NULL, -- Reference to the RentalGroup, ensuring each property is linked to exactly one rental group
    ManagerID INT NOT NULL, -- Reference to the Manager responsible for this property; assumed to be mandatory
    Cost DECIMAL(10,2), -- Rental cost of the property
    SignDate DATE, -- Date when the lease agreement was signed
    EndDate DATE, -- Date when the lease agreement ends
    Since DATE, -- Date since when the current manager started managing this property
    PRIMARY KEY (ID),
    FOREIGN KEY (RentalGroupCode) REFERENCES RentalGroup(Code),
    FOREIGN KEY (ManagerID) REFERENCES Manager(ID) ON DELETE CASCADE
);

--ALTER TABLE Property ADD Type VARCHAR(50) NOT NULL;

-- Creation of the Owner table
CREATE TABLE Owner (
    ID INT NOT NULL,
    PRIMARY KEY (ID),
    FOREIGN KEY (ID) REFERENCES Person(ID)
);

-- Associative table for Owner and Property relationship
-- This table represents the many-to-many relationship between owners and properties.
CREATE TABLE PropertyOwner (
    OwnerID INT NOT NULL,      -- The unique identifier for the owner, referencing the Owner table.
    PropertyID INT NOT NULL,   -- The unique identifier for the property, referencing the Property table.
    PRIMARY KEY (OwnerID, PropertyID), -- A composite primary key that ensures the combination of OwnerID and PropertyID is unique.
    FOREIGN KEY (OwnerID) REFERENCES Owner(ID) ON DELETE CASCADE, -- A foreign key to the Owner table that cascades deletions.
    FOREIGN KEY (PropertyID) REFERENCES Property(ID) ON DELETE CASCADE -- A foreign key to the Property table that also cascades deletions.
);

-- Creation of the Renter table
-- This table holds information about individuals who are renting or interested in renting properties.
CREATE TABLE Renter (
    ID INT NOT NULL,                      -- The unique identifier for the renter, referencing the Person table.
    GradYear INT,                         -- The graduation year of the renter, if applicable (nullable).
    ProgramStudy VARCHAR(100),            -- The program of study for the renter, if they are a student (nullable).
    RentalGroupCode INT,                  -- The ID of the rental group the renter belongs to, if any (nullable).
    PRIMARY KEY (ID),                     -- The ID is the primary key, ensuring each renter has a unique identifier.
    FOREIGN KEY (ID) REFERENCES Person(ID),  -- A foreign key relationship with the Person table.
    FOREIGN KEY (RentalGroupCode) REFERENCES RentalGroup(Code) ON DELETE SET NULL -- A foreign key to the RentalGroup table that sets the value to NULL if the rental group is deleted.
);

-- Creation of the House table
-- This table specifically holds information about properties that are houses.
CREATE TABLE House (
    PropertyID INT NOT NULL,            -- The unique identifier for the property, referencing the Property table.
    Fence VARCHAR(50) NOT NULL,         -- Description of the fence type, if any (not nullable as all houses are assumed to have some kind of fencing).
    Detached CHAR(1) NOT NULL,          -- A 'Y' or 'N' value indicating if the house is detached.
    PRIMARY KEY (PropertyID),           -- The PropertyID is the primary key, ensuring each house has a unique identifier.
    FOREIGN KEY (PropertyID) REFERENCES Property(ID) -- A foreign key relationship with the Property table.
);

-- Creation of the Apartment table
-- This table specifically holds information about properties that are apartments.
CREATE TABLE Apartment (
    PropertyID INT NOT NULL,            -- The unique identifier for the property, same as in the Property table.
    Floor INT NOT NULL,                 -- The floor number of the apartment.
    Elevator CHAR(1) NOT NULL,          -- A 'Y' or 'N' value indicating if the building has an elevator.
    PRIMARY KEY (PropertyID),           -- The PropertyID is the primary key, ensuring each apartment has a unique identifier.
    FOREIGN KEY (PropertyID) REFERENCES Property(ID) -- A foreign key relationship with the Property table.
);


-- Creation of the Room table with a unique RoomID
CREATE TABLE Room (
    RoomID INT NOT NULL, -- Unique identifier for each room
    PropertyID INT NOT NULL, 
    RoomNumber INT NOT NULL, 
    Kitchen CHAR(1) NOT NULL,  -- Y/N 
    NumFurnishings INT NOT NULL,
    PRIMARY KEY (RoomID), -- Using RoomID as the primary key
    UNIQUE (PropertyID, RoomNumber), -- Ensure uniqueness for each room within a property
    FOREIGN KEY (PropertyID) REFERENCES Property(ID)
);

-- Creation of the Furnishings table simplified
CREATE TABLE Furnishings (
    RoomID INT NOT NULL, -- Referencing the unique identifier for each room
    Furnishing VARCHAR(50) NOT NULL, -- Description of the furnishing
    PRIMARY KEY (RoomID, Furnishing), -- Composite primary key consisting of RoomID and Furnishing
    FOREIGN KEY (RoomID) REFERENCES Room(RoomID) -- Establishes a relationship with the Room table
);


-- Inserting data into Person table
-- Including both owners, renters, and managers
INSERT INTO Person VALUES
(1, '1234567890', 'Gon', 'Freecs'),
(2, '0987654321', 'Killua', 'Zoldyck'),
(3, '1122334455', 'Chrollo', 'Lucilfer'),
(4, '2233445566', 'Michael', 'Brown'),
(5, '3344556677', 'Jessica', 'Davis'),
(6, '4455667788', 'Christopher', 'Martinez'),
(7, '5566778899', 'Ashley', 'Garcia'),
(8, '6677889900', 'Joshua', 'Wilson'),
(9, '7778899900', 'Alice', 'Williams'),
(10, '8889900112', 'Bob', 'Harris'),
(11, '9990011223', 'Carol', 'Sanders'),
(12, '1100220334', 'David', 'Thompson'),
(13, '2210331445', 'Eve', 'Collins'),
(14, '3320442556', 'Frank', 'Peterson'),
(15, '4430553667', 'Grace', 'Baker'),
(16, '5540664778', 'Henry', 'Murphy'),
(17, '5551234567', 'Sasuke', 'Uchiha'),
(18, '5552345678', 'Naruto', 'Uzumaki');

-- Inserting data into RentalGroup table
INSERT INTO RentalGroup VALUES
(1, 'Y', 'Wheelchair ramp', 1800.00, 3, 2, 'Y', 'Apartment'),
(2, 'N', NULL, 1950.23, 2, 1, 'N', 'House'),
(3, 'Y', 'Elevator', 3000.00, 3, 2, 'Y', 'Condo'),
(4, 'N', NULL, 2500.00, 1, 1, 'N', 'Studio'),
(5, 'Y', 'Elevator', 2130.00, 4, 3, 'Y', 'Penthouse'),
(6, 'N', NULL, 1500.00, 2, 1, 'N', 'Townhouse');

-- Inserting data into Manager table
-- Assuming managers are also in the Person table
INSERT INTO Manager VALUES
(13), (14), (15), (16), (17), (18);

-- Inserting data into Property table
-- Making sure ManagerID and RentalGroupCode are valid
INSERT INTO Property VALUES
(1, 'Wheelchair ramp', 'Y', '2023-01-01', 2, 3, '123 Main St', '101', 'ON', 'Toronto', 'M5H3M7', 1, 13, 2000.00, '2023-01-15', '2024-01-14', '2022-12-01'),
(2, 'None', 'N', '2023-01-02', 1, 2, '456 Secondary Rd', NULL, 'ON', 'Ottawa', 'K1P1J9', 2, 14, 1800.00, '2023-09-12', '2024-09-12', '2022-12-02'),
(3, 'Elevator', 'Y', '2023-01-03', 2, 3, '789 Market Ave', '202', 'BC', 'Vancouver', 'V6B4N9', 3, 15, 2500.00, '2023-02-01', '2024-01-31', '2023-01-01'),
(4, 'None', 'N', '2023-02-04', 1, 1, '321 Hill Valley', '4A', 'QC', 'Montreal', 'H1A2B2', 4, 16, 1200.00, '2023-02-15', '2024-02-14', '2023-02-01'),
(5, 'Elevator', 'Y', '2023-03-01', 3, 4, '159 Bay Street', '1501', 'ON', 'Toronto', 'M5J2T2', 5, 17, 3500.00, '2023-03-15', '2024-03-14', '2023-03-01'),
(6, 'None', 'N', '2023-04-01', 1, 2, '456 Rural Rd', '6B', 'AB', 'Calgary', 'T2P5M5', 6, 18, 1300.00, '2023-04-15', '2024-04-14', '2023-04-01');

-- Inserting data into Owner table
-- Making sure IDs match those in the Person table
INSERT INTO Owner VALUES
(1), (2), (3), (4), (5), (6);

-- Inserting data into PropertyOwner table
-- Ensuring PropertyID and OwnerID are valid and correspond to existing entries
INSERT INTO PropertyOwner VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- Inserting data into Renter table
-- Ensuring IDs match those in the Person table and RentalGroupCode is valid
INSERT INTO Renter VALUES
(7, 2022, 'Computer Science', 1),
(8, 2021, 'Commerce', 2),
(9, 2023, 'Political Science', 3),
(10, 2024, 'Mechanical Engineering', 4),
(11, 2020, 'Health Science', 5),
(12, 2023, 'Life Science', 6);

-- Inserting data into House table
-- Aligning PropertyID with the existing entries in the Property table
INSERT INTO House VALUES
(1, 'Wooden', 'Y'),
(2, 'None', 'N'),
(3, 'Electric', 'Y'),
(4, 'Privacy', 'Y'),
(5, 'Chain Link', 'N'),
(6, 'Iron', 'Y');

-- Inserting data into Apartment table
-- Aligning PropertyID with the existing entries in the Property table
INSERT INTO Apartment VALUES
(1, 10, 'Y'),
(2, 5, 'Y'),
(3, 20, 'Y'),
(4, 3, 'N'),
(5, 15, 'Y'),
(6, 8, 'N');

-- Inserting data into Room table
-- Aligning PropertyID with the existing entries in the Property table
-- RoomID will be assumed to be the same as RoomNumber for simplicity
INSERT INTO Room VALUES
(101, 1, 101, 'Y', 5),
(102, 1, 102, 'N', 3),
(201, 2, 201, 'Y', 4),
(202, 2, 202, 'N', 2),
(301, 3, 301, 'Y', 3),
(302, 3, 302, 'N', 3),
(401, 4, 401, 'Y', 6),
(402, 4, 402, 'N', 2),
(501, 5, 501, 'Y', 7),
(502, 5, 502, 'N', 3),
(601, 6, 601, 'Y', 4),
(602, 6, 602, 'N', 2);

-- Inserting data into Furnishings table
-- Assuming RoomID corresponds to the actual rooms created above
INSERT INTO Furnishings VALUES
(101, 'Sofa'),
(102, 'Desk'),
(201, 'Sofa'),
(202, 'Desk'),
(301, 'Bed'),
(302, 'Desk'),
(401, 'Sofa Set'),
(402, 'Futon'),
(501, 'Sectional Sofa'),
(502, 'Small Bed'),
(601, 'Pull-out Couch'),
(602, 'Day Bed');





