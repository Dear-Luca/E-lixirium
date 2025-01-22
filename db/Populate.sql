-- Insert categories
INSERT INTO CATEGORY (name) VALUES
('Potions'),
('Scrolls'),
('Charms'),
('Amulets'),
('Books'),
('Miscellaneous');

-- Insert products with longer descriptions
INSERT INTO PRODUCT (name, description, image_name, price, amount_left, duration, stars)
VALUES
('Aqua Potion', 'A mystical blue potion that replenishes mana instantly, perfect for wizards and mages in dire need during battle.', 'aqua_potion.png', 10.50, 100, 'Instant', 4.5),
('Bolt Charm', 'A charm imbued with the essence of lightning, boosting the power of electrical spells significantly for a short time.', 'bolt_charm.png', 25.00, 50, '30 minutes', 4.0),
('Fire Scroll', 'A rare scroll that unleashes a burst of powerful fire magic, ideal for both combat and clearing obstacles.', 'fire_scroll.jpeg', 15.00, 75, 'Single-use', 3.5),
('Frozen Potion', 'A cooling potion that not only lowers body temperature but also grants resistance to fire for a brief period.', 'frozen.png', 8.00, 120, 'Instant', 4.0),
('Ghost Cloak', 'A spectral cloak that renders the wearer invisible to all but the sharpest eyes. Ideal for stealth missions.', 'ghoast_cloak.png', 50.00, 10, '10 minutes', 5.0),
('Guard Amulet', 'A sturdy amulet that enhances the wearer’s defense, reducing damage from physical and magical attacks.', 'guard_amulet.png', 20.00, 40, '1 hour', 4.0),
('Heart Elixir', 'A vibrant red elixir that heals physical injuries and restores stamina immediately upon consumption.', 'hear-elixir.png', 30.00, 60, 'Instant', 5.0),
('Life Stone', 'A magical artifact that revitalizes the user, offering a one-time full restoration of health and energy.', 'life_stone.png', 100.00, 5, 'Permanent', 5.0),
('Luck Potion', 'A bright green potion said to twist fate in the user’s favor, increasing their luck for an hour.', 'luck_potion.png', 12.00, 80, '1 hour', 4.0),
('Magic Scroll', 'An ancient scroll that contains a randomly selected spell from a wide variety of magical disciplines.', 'magic_scroll.png', 18.00, 90, 'Single-use', 3.0),
('Shadow Book', 'A forbidden tome that teaches powerful shadow magic, perfect for those walking the darker path.', 'shadow_book.png', 40.00, 30, 'Permanent', 4.5),
('Time Glass', 'A rare hourglass that allows the user to rewind or pause time briefly, ideal for critical situations.', 'time_glass.png', 150.00, 3, '10 uses', 5.0),
('Vision Ball', 'A crystal ball that reveals glimpses of possible futures, aiding in decision-making and strategy.', 'vision_ball.png', 60.00, 20, '5 uses', 4.0),
('Vital Potion', 'A robust potion that temporarily increases vitality, making the user more resilient to fatigue and damage.', 'vital_potion.jpeg', 14.00, 100, '30 minutes', 4.0),
('Wise Scroll', 'A scroll filled with wisdom enchantments that grants the user a temporary boost in intellect and problem-solving abilities.', 'wise_scroll.png', 20.00, 70, 'Single-use', 5.0),
('Wolf Brew', 'A strong potion that enhances agility and sharpens reflexes, perfect for hunters and adventurers.', 'wolf_brew.png', 22.00, 50, '1 hour', 4.0),
('Youth Elixir', 'A rare elixir rumored to reverse the effects of aging, restoring youthful vigor and appearance.', 'youth_elixir.png', 500.00, 2, 'Permanent', 4.5);

-- Insert into `IS` using valid id_product values
INSERT INTO `IS` (name, id_product)
SELECT 'Potions', id_product FROM PRODUCT WHERE name = 'Aqua Potion'
UNION ALL
SELECT 'Charms', id_product FROM PRODUCT WHERE name = 'Bolt Charm'
UNION ALL
SELECT 'Scrolls', id_product FROM PRODUCT WHERE name = 'Fire Scroll'
UNION ALL
SELECT 'Potions', id_product FROM PRODUCT WHERE name = 'Frozen Potion'
UNION ALL
SELECT 'Miscellaneous', id_product FROM PRODUCT WHERE name = 'Ghost Cloak'
UNION ALL
SELECT 'Amulets', id_product FROM PRODUCT WHERE name = 'Guard Amulet'
UNION ALL
SELECT 'Potions', id_product FROM PRODUCT WHERE name = 'Heart Elixir'
UNION ALL
SELECT 'Miscellaneous', id_product FROM PRODUCT WHERE name = 'Life Stone'
UNION ALL
SELECT 'Potions', id_product FROM PRODUCT WHERE name = 'Luck Potion'
UNION ALL
SELECT 'Scrolls', id_product FROM PRODUCT WHERE name = 'Magic Scroll'
UNION ALL
SELECT 'Books', id_product FROM PRODUCT WHERE name = 'Shadow Book'
UNION ALL
SELECT 'Miscellaneous', id_product FROM PRODUCT WHERE name = 'Time Glass'
UNION ALL
SELECT 'Miscellaneous', id_product FROM PRODUCT WHERE name = 'Vision Ball'
UNION ALL
SELECT 'Potions', id_product FROM PRODUCT WHERE name = 'Vital Potion'
UNION ALL
SELECT 'Scrolls', id_product FROM PRODUCT WHERE name = 'Wise Scroll'
UNION ALL
SELECT 'Potions', id_product FROM PRODUCT WHERE name = 'Wolf Brew'
UNION ALL
SELECT 'Potions', id_product FROM PRODUCT WHERE name = 'Youth Elixir';

-- Insert multiple users
INSERT INTO USER (name, surname, username, email, password, birthday)
VALUES
('Alice', 'Smith', 'alice123', 'alice@example.com', 'password123', '1995-05-15'),
('Bob', 'Johnson', 'bob_the_wise', 'bob@example.com', 'securepass', '1990-08-25'),
('Carol', 'Brown', 'carolB', 'carol@example.com', 'mypassword', '1998-03-10'),
('Dave', 'Williams', 'davey', 'dave@example.com', 'letmein', '1992-12-05'),
('Eve', 'Taylor', 'eveT', 'eve@example.com', 'qwerty123', '1987-07-19'),
('Frank', 'Miller', 'frankM', 'frank@example.com', 'password456', '1993-02-14');

-- Insert revews
-- Reviews for Aqua Potion
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'alice123', 5, 'A rejuvenating potion that works wonders!'
FROM PRODUCT
WHERE name = 'Aqua Potion';

INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'bob_the_wise', 4, 'Really refreshing, but a bit pricey for frequent use.'
FROM PRODUCT
WHERE name = 'Aqua Potion';

-- Reviews for Bolt Charm
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'carolB', 4, 'Powerful charm but drains energy quickly.'
FROM PRODUCT
WHERE name = 'Bolt Charm';

-- Reviews for Fire Scroll
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'davey', 3, 'Effective, but the magic is hard to control.'
FROM PRODUCT
WHERE name = 'Fire Scroll';

INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'eveT', 4, 'Great for quick attacks, but requires practice to master.'
FROM PRODUCT
WHERE name = 'Fire Scroll';

-- Reviews for Frozen Potion
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'frankM', 4, 'A handy potion for fire resistance, saved me several times.'
FROM PRODUCT
WHERE name = 'Frozen Potion';

-- Reviews for Ghost Cloak
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'alice123', 5, 'This cloak is a game changer for stealth lovers.'
FROM PRODUCT
WHERE name = 'Ghost Cloak';

INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'davey', 5, 'I felt invisible to the world. Highly recommend it!'
FROM PRODUCT
WHERE name = 'Ghost Cloak';

-- Reviews for Guard Amulet
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'carolB', 4, 'Reliable protection for intense combat situations.'
FROM PRODUCT
WHERE name = 'Guard Amulet';

-- Reviews for Heart Elixir
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'bob_the_wise', 5, 'Incredible healing potion, a must-have for adventurers.'
FROM PRODUCT
WHERE name = 'Heart Elixir';

INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'frankM', 5, 'It saved me when I was on the verge of collapse.'
FROM PRODUCT
WHERE name = 'Heart Elixir';

-- Reviews for Life Stone
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'eveT', 5, 'This stone is worth every gold coin. It saved my life once.'
FROM PRODUCT
WHERE name = 'Life Stone';

-- Reviews for Luck Potion
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'davey', 4, 'Luck improved my dice rolls for hours. Highly recommend it!'
FROM PRODUCT
WHERE name = 'Luck Potion';

-- Reviews for Magic Scroll
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'alice123', 3, 'The spell was too random for my liking, but still useful.'
FROM PRODUCT
WHERE name = 'Magic Scroll';

-- Reviews for Shadow Book
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'carolB', 5, 'An excellent book for mastering shadow magic!'
FROM PRODUCT
WHERE name = 'Shadow Book';

INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'eveT', 4, 'A bit advanced, but incredibly powerful when mastered.'
FROM PRODUCT
WHERE name = 'Shadow Book';

-- Reviews for Time Glass
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'bob_the_wise', 5, 'Time manipulation saved me in a battle. Truly priceless!'
FROM PRODUCT
WHERE name = 'Time Glass';

-- Reviews for Vision Ball
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'frankM', 4, 'Helped me see an upcoming ambush, very handy tool.'
FROM PRODUCT
WHERE name = 'Vision Ball';

-- Reviews for Vital Potion
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'alice123', 4, 'Great potion for staying energized during long battles.'
FROM PRODUCT
WHERE name = 'Vital Potion';

-- Reviews for Wise Scroll
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'bob_the_wise', 5, 'Boosted my intellect significantly. Highly recommend it!'
FROM PRODUCT
WHERE name = 'Wise Scroll';

-- Reviews for Wolf Brew
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'carolB', 4, 'This brew made me feel like a wolf. Great agility boost!'
FROM PRODUCT
WHERE name = 'Wolf Brew';

-- Reviews for Youth Elixir
INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'davey', 5, 'Restored my youth and energy. Absolutely legendary!'
FROM PRODUCT
WHERE name = 'Youth Elixir';

INSERT INTO REVIEW (id_product, username, stars, comment)
SELECT id_product, 'eveT', 4, 'A powerful elixir, but I wish it lasted longer.'
FROM PRODUCT
WHERE name = 'Youth Elixir';
