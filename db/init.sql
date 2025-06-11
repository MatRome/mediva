-- Tworzenie bazy danych
CREATE DATABASE IF NOT EXISTS magazyn CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE magazyn;

-- Tworzenie tabeli
CREATE TABLE IF NOT EXISTS magazyn (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazwa VARCHAR(255) NOT NULL,
    cena DECIMAL(10,2) NOT NULL,
    kolor VARCHAR(100) NOT NULL,
    rozmiar VARCHAR(10) NOT NULL,
    ilosc_magazyn INT NOT NULL,
    opis TEXT
);

-- Przykładowe dane
INSERT INTO magazyn (nazwa, cena, kolor, rozmiar, ilosc_magazyn, opis) VALUES
('Scrubsy Comfort', 139.99, 'Niebieski', 'S', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Niebieski', 'M', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Niebieski', 'L', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Niebieski', 'XL', 10, 'Scrubsy damskie Comfort'),

('Scrubsy Comfort', 139.99, 'Ciemna zieleń', 'S', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Ciemna zieleń', 'M', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Ciemna zieleń', 'L', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Ciemna zieleń', 'XL', 10, 'Scrubsy damskie Comfort'),

('Scrubsy Comfort', 139.99, 'Różowy', 'S', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Różowy', 'M', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Różowy', 'L', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Różowy', 'XL', 10, 'Scrubsy damskie Comfort'),

('Scrubsy Comfort', 139.99, 'Czarny', 'S', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Czarny', 'M', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Czarny', 'L', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Czarny', 'XL', 10, 'Scrubsy damskie Comfort'),

('Scrubsy Comfort', 139.99, 'Fioletowy', 'S', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Fioletowy', 'M', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Fioletowy', 'L', 10, 'Scrubsy damskie Comfort'),
('Scrubsy Comfort', 139.99, 'Fioletowy', 'XL', 10, 'Scrubsy damskie Comfort');

('Scrubsy ComfortFit', 139.99, 'Granatowy', 'S', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Granatowy', 'M', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Granatowy', 'L', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Granatowy', 'XL', 10, 'Scrubsy męskie ComfortFit'),

('Scrubsy ComfortFit', 139.99, 'Czarny', 'S', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Czarny', 'M', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Czarny', 'L', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Czarny', 'XL', 10, 'Scrubsy męskie ComfortFit'),

('Scrubsy ComfortFit', 139.99, 'Niebieski', 'S', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Niebieski', 'M', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Niebieski', 'L', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Niebieski', 'XL', 10, 'Scrubsy męskie ComfortFit'),

('Scrubsy ComfortFit', 139.99, 'Ciemna zieleń', 'S', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Ciemna zieleń', 'M', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Ciemna zieleń', 'L', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Ciemna zieleń', 'XL', 10, 'Scrubsy męskie ComfortFit'),

('Scrubsy ComfortFit', 139.99, 'Ciemna czerwień', 'S', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Ciemna czerwień', 'M', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Ciemna czerwień', 'L', 10, 'Scrubsy męskie ComfortFit'),
('Scrubsy ComfortFit', 139.99, 'Ciemna czerwień', 'XL', 10, 'Scrubsy męskie ComfortFit');

('Maseczka medyczna', 9.99, 'Biały', 'Uni', 50, 'Jednorazowa maseczka ochronna.'),
('Chusta medyczna', 12.99, 'Różowy', 'Uni', 30, 'Kolorowa chusta ochronna dla personelu.');




