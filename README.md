# Sulis-Weblap02
Webprogramozás beadandó
Dokumentáció: Sulisweblap02
Célkitűzés (feladatspecifikáció)
A projekt célja egy iskolai weboldal létrehozása, amely lehetővé teszi a felhasználók számára az autók feltöltését és eladását. Az oldalnak egyszerűnek és könnyen kezelhetőnek kell lennie, lehetővé téve a felhasználók számára, hogy regisztráljanak, bejelentkezzenek, autókat töltsenek fel és kilépjenek a fiókjukból.
Oldal- és funkciótervek

Oldalak

Az oldal a következő fájlokból áll:
1. config.php: Adatbázis-kapcsolat konfigurálása.
2. dark-theme.css: Az oldal sötét módjának beállítása.
3. footer.php: Lábléc, amely tartalmazza a fejlesztők nevét.
4. header.php: Navigációs sáv egy keresőrésszel.
5. index.php: A kezdőoldal.
6. login.php: Bejelentkezési oldal.
7. logout.php: Kilépés a fiókból.
8. register.php: Regisztrációs oldal.
9. upload_car.php: Autók feltöltése az oldal adatbázisába.
10. sulisweblap.sql: Az oldalhoz kapcsolt adatbázis.

Funkciók

A weboldal a következő funkciókat kínálja:
1. Regisztráció: A felhasználók létrehozhatnak egy fiókot az oldalon.
2. Bejelentkezés: A felhasználók bejelentkezhetnek a meglévő fiókjukba.
3. Kilépés: A felhasználók kijelentkezhetnek a fiókjukból.
4. Autófeltöltés: A felhasználók feltölthetik az eladásra szánt autókat az adatbázisba.
5. Keresés: A felhasználók keresést végezhetnek az oldalon elérhető autók között.
 
A kivitelezés dokumentálása

Fájlszerkezet bemutatása

A projekt fájlszerkezete a következő:

sulisweblap02/
│
├── config.php
├── dark-theme.css
├── footer.php
├── header.php
├── index.php
├── login.php
├── logout.php
├── register.php
├── upload_car.php
└── sulisweblap.sql

Funkciók megvalósítása

1. config.php: Az adatbázis-kapcsolat konfigurálása a `$servername`, `$username`, `$password` és `$dbname` változók segítségével. A `mysqli` objektumot használva az adatbázishoz való kapcsolódáshoz. Hiba esetén a kapcsolat megszakítása és hibaüzenet megjelenítése.
2. dark-theme.css: Az oldal sötét módjának beállítása, amely tartalmazza a szükséges CSS stílusokat a sötét téma alkalmazásához. Ez a fájl be van kötve az összes többi PHP fájlba, így a sötét mód minden oldalon elérhető.
3. footer.php: A lábléc, amely tartalmazza a fejlesztők nevét (Strausz Balázs és Munkhárt Levente). A lábléc minden oldalon megjelenik, mivel az összes többi PHP fájlba be van kötve.
4. header.php: Egy navigációs sávot hoz létre egy kereső résszel. A navigációs sáv minden oldalon megjelenik, mivel az összes többi PHP fájlba be van kötve. A kereső rész lehetővé teszi a felhasználók számára, hogy gyorsan megtalálják az eladásra kínált autókat.
5. index.php: A kezdőoldal, amely tartalmazza az oldal általános bemutatását és a legújabb eladásra kínált autók listáját.
6. login.php: A bejelentkezési oldal, amely egy űrlapot tartalmaz a felhasználónév és jelszó megadásához. A felhasználói adatok ellenőrzése az adatbázisban történik, és sikeres bejelentkezés esetén a felhasználót átirányítják a kezdőoldalra.
7. logout.php: A kilépési funkció, amely kijelentkezteti a felhasználót a fiókjából és átirányítja őket a kezdőoldalra.
8. register.php: A regisztrációs oldal, amely egy űrlapot tartalmaz a felhasználói adatok megadásához. Az adatok validálása és az adatbázisba történő mentése után a felhasználó sikeres regisztráció esetén a bejelentkezési oldalra kerül átirányítva.
9. upload_car.php: Az autófeltöltési oldal, amely egy űrlapot tartalmaz az autó adatainak megadásához és képének feltöltéséhez. Sikeres feltöltés esetén az autó adatai elmentésre kerülnek az adatbázisba, és a felhasználót értesítik a sikeres feltöltésről.
10. sulisweblap.sql: Az oldalhoz kapcsolt adatbázis, amely tárolja a felhasználók és az eladásra kínált autók adatait. Az adatbázis a következő táblákat tartalmazza:
- Felhasználók: A regisztrált felhasználók adatait tárolja, beleértve a felhasználónevet, jelszót, e-mail címet és egyéb személyes adatokat.
- Autók: Az eladásra kínált autók adatait tárolja, beleértve a márka, modell, évjárat, ár, leírás és feltöltött képek adatait.

Menü megvalósítása

A menü megvalósítása a header.php fájlban történik. A navigációs sáv tartalmazza a következő menüelemeket:

1. Kezdőoldal: A felhasználókat a weboldal kezdőoldalára irányítja, ahol megtekinthetik az eladásra kínált autók listáját.
2. Bejelentkezés: A bejelentkezési oldalra navigál, ahol a felhasználók bejelentkezhetnek a meglévő fiókjukba.
3. Regisztráció: A regisztrációs oldalra navigál, ahol a felhasználók létrehozhatnak egy új fiókot az oldalon.
4. Autófeltöltés: Az autófeltöltési oldalra navigál, ahol a felhasználók feltölthetik az eladásra szánt autókat az adatbázisba.
5. Kilépés: A felhasználókat kijelentkezteti a fiókjukból és visszairányítja őket a kezdőoldalra.

A menü dinamikusan változik a felhasználó bejelentkezési állapota alapján. Bejelentkezett felhasználók esetén a "Bejelentkezés" és "Regisztráció" menüpontok eltűnnek, helyette pedig a "Kilépés" és "Autófeltöltés" menüpontok jelennek meg.

A feladatok megvalósításához az XAMPP-ot használtuk, és a weblap működtetéséhez szükségünk volt az Apache-ra, MySQL-re és a FileZillára.
