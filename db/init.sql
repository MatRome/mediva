-- Utworzenie bazy danych
CREATE DATABASE IF NOT EXISTS scrubsy;
USE scrubsy;

-- Tabela produktów
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nazwa VARCHAR(100),
    opis TEXT,
    cena DECIMAL(10,2),
    rozmiar VARCHAR(10),
    kolor VARCHAR(30),
    zdjecie VARCHAR(100)
);

-- Tabela ocen i recenzji
CREATE TABLE reviews (
    id INT AUTO_INCREMENT PRIMARY KEY,
    produkt_id INT,
    ocena INT,
    komentarz TEXT,
    data_dodania DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (produkt_id) REFERENCES products(id)
);

-- Tabela zamówień
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    imie_nazwisko VARCHAR(100),
    email VARCHAR(100),
    adres TEXT,
    data_zamowienia DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Pozycje zamówienia (produkty w zamówieniu)
CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    zamowienie_id INT,
    produkt_id INT,
    ilosc INT,
    FOREIGN KEY (zamowienie_id) REFERENCES orders(id),
    FOREIGN KEY (produkt_id) REFERENCES products(id)
);
