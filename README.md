Opis projektu
Projektem jest sklep internetowy Mediva Wear, umożliwiający prezentację i sprzedaż odzieży medycznej (scrubsy, chusty i maseczki medyczne). Skrypt został zaimplementowany w języku PHP, HTML, CSS, JavaScript z wykorzystaniem biblioteki Bootstrap 5. Aplikacja pozwala użytkownikowi wybrać produkt, dobrać rozmiar, kolor oraz ilość, a następnie dodać wybrany zestaw do koszyka. Koszyk obsługiwany jest lokalnie w przeglądarce (localStorage) i aktualizowany dynamicznie za pomocą JavaScript.
Główne funkcjonalności:
•	dynamiczne wczytywanie produktów z bazy danych,
•	dynamiczna zmiana zdjęć produktów po wyborze koloru,
•	możliwość wyboru rozmiaru, koloru i ilości,
•	dodawanie produktów do koszyka (localStorage),
•	dynamiczny podgląd koszyka (ilość i łączna wartość zamówienia),
•	responsywny i nowoczesny interfejs z wykorzystaniem Bootstrap.
•	możliwość wpisania kodu rabatu
•	wysyłanie faktury na wpisany email
•	panel admina z możliwością edycji bazy danych
•	symulacja różnych form płatności i dostawy
Instrukcja uruchomienia projektu
Środowisko lokalne:
Projekt może być uruchamiany lokalnie na serwerze XAMPP lub innym serwerze obsługującym PHP i MySQL.
Kroki instalacyjne:
•	Skopiuj projekt do katalogu serwera (htdocs w przypadku XAMPP).
•	Skonfiguruj połączenie z bazą danych w pliku db_connect.php (podając host, nazwę użytkownika, hasło oraz nazwę bazy danych).
•	Utwórz bazę danych MySQL i zaimportuj przygotowaną strukturę tabel (tabela magazyn zawierająca produkty i ich warianty, plik init.sql).
•	Uruchom serwer Apache i MySQL.
•	Otwórz projekt w przeglądarce: http://localhost/mediva/index.html (ścieżka zależna od lokalizacji projektu).
