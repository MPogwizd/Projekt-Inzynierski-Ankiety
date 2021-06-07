# System umożliwiający anonimowe głosowanie. 
### Repozytorium w ramach przedmiotu "Projekt inżynierski"

## Wymagania
System zrealizowany w formie aplikacji webowej powinien uwzględniać możliwość oddania głosu lub wyrażenia opinii w taki sposób, aby realizować następujące funkcje:

• informacje przechowywane w bazie danych,

• reprezentacja nie umożliwia powiązania użytkownika z konkretnymi danymi,

• reprezentacja umożliwia sprawdzenie czy dana osoba przekazała dane,

• reprezentacja umożliwia sprawdzenie przez użytkownika czy jego dane są zapisane w bazie.

Implementacja powinna uzględniać responsywny interfejs. Do zapewnienia anonimowości należy wykorzystać techniki kryptograficzne (funkcje skrótu) oraz metody generowania tokenów.

Rekomedowane jest wykorzystanie ogólnodostępnych bibliotek programistycznych.

## Funkcjonalności

• wypełnainie ankiet,

• weryfikacja wysłanych odpowiedzi.

### Funkcjonalności dostepne jedynie z poziomu admina serwisu
• tworzenie nowych ankiet,

• dodawanie pytań i odpowiedzi do ankiet,

• sprawdzenie jakie ankiety wypełnił konkretny użytkownik.

## Instalacja
Do zainstalowania na localhoscie wymagane jest posiadanie pakietu XAMPP umożliwającego dostęp do narzędzia phpMyAdmin oraz do serwera lokalnego. Plik Questinaries.sql nalezy zaimportować w phpMyAdmin, a wszytie pliki aplikacji umieścic w folderze .../xampp/htdocs/STRONA
