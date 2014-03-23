KOM-core
=================================================

Version 1.0, 23.03.2014

Autor: Martin Stoppler @stoppegp
Lizenz: GPL


Anleitung (work in prograss)
=============================


1. Installation

Die ./install/install.php aufrufen. Auf der Seite Seitentitel, URL zum KOM-Core (ohne "/" am Ende), Start- und Enddatum der Betrachtungszeit (Legislaturperiode) sowie Datenbank-Zugangsdaten eingaben. Um mehrere Installationen innerhalb einer Datenbank zu verwalten, kann noch ein Präfix für die Tabellen angegeben werden.
Es wird nun automatisch eine config.php im hauptordner bestellt und eine Grundstruktur in der Datenbank. Anschließend unbedingt das Verzeichnis "install" löschen!
Für ein Frontend muss nun noch das KOM-Interface in den Ordner "interface" kopiert werden.

2. Einrichtung

Erst versichern, dass der Ordner "install" gelöscht wurde! Die Administration wird über ./admin/admin.php ausgerufen. Nach der Installation kann man sich mit dem Benutzernamen "admin" und dem Kennwort "admin" einloggen. Diese Daten sollten sofort unter "Benutzer" (siehe 2.1) geändert werden!


2.1 Benutzer anpassen

Als erstes sollten die Benutzer angepasst werden. Über den Menüeintrag "Benutzer" werden alle aktiven benutzeraufgelistet. Nach der Installation existiert hier nur der Eintrag "admin". Über "bearbeiten" kann hier das Kennwort und der Benutzername geändert werden.


2.2 Bewertungen

Als nächstes empfiehlt es sich, die Bewertungen anzupassen. Jedes Versprechen kann unterschiedlich bewertet werden, welche Möglichkeiten zur Verfügung stehen, kann unter "Bewertungen" eingestellt werden. Grundsätzlich wir zwischen zwei Arten unterschieden: "Forderung" - hier geht es um Versprechen, wo aktiv etwas umgesetzt werden muss, und "Zustand" - hier geht es um versprechen, wo ein Zustand bewahrt werden soll, also keine Aktion notwendig ist, um das Versprechen zu halten.
Weiter können die Bewertungen gruppiert werden, um eine übersichtlichere Auswertung zu ermöglichen. Drei Arten sind hier vorgegeben - umgesetzte Versprechen, gebrochene Versprechen und Versprechen, bei denen nichts passiert ist. Weiterhin können auch eigene, neue Gruppen erstellt werden.


2.3 Kategorien

Jedes Thema muss mindestens einer Kategorie zugeteilt werden. Um also Themen erstellen zu können, muss erst mindestens eine Kategorie erstellt werden.


2.4 Parteien

Versprechen müssen einer Partei zugeordnet werden - also müssen erst Pareien erstellt werden.


2.5 Themen, Versprechen, Status

Jetzt ist alles wichtige eingerichtet, und es kann mit der Erstellung der Themen begonnen werden!


3. Administration


3.1 Themen

Auf der Themen-Seite werden alle erstellten Themen, sortiert nach Kategorien, angezeigt.
Ein neues Thema kann über den Button "Neues Thema" erstellt werden. Hier muss zwingend ein Name und mindestens eine Kategorie angegeben werden. Außerdem empfiehlt es sich, eine Beschreibung hinzuzufügen. Nach dem erfolgreichen Erstellen wird das Thema automatisch geöffnet (siehe 3.2 und 3.3).
Über den Button "bearbeiten" kann ein Thema geändert werden, der Button "löschen" entfernt das Theme und alle darin enthaltenen Versprechen (siehe 3.2) und Status (siehe 3.3).
Über den Button "öffnen" oder mit einem Klick auf den Namen des Themas wird das Thema geöffnet (siehe 3.2 und 3.3).


3.2 Versprechen

Wenn ein Thema geöffnet wurde (siehe 3.1) wird in der oberen Hälfte eine Liste aller enthaltenen Versprechen, sortiert nach Partei, angezeigt.
Ein neues Versprechen kann über den Button "Neues Versprechen" erstellt werden. Hier muss zwingend der Text des Versprechens und eine Partei angegeben werden. Außerdem ist das Feld "Startinfo" Pflicht - es definiert zum einen, ob das Versprechen eine "Forderung" oder ein "Zustand" ist (siehe 2.2) und zum anderen, welche Bewertung zu Beginn des Betrachtungszeitraum aktiviert ist. Zusätzlich sollte zu jedem Versprechen eine Quelle definiert sein - hier gibt es zwei Möglichkeiten: Das Wahlprogramm - dann müssen nur die Felder "Zitat" und "Seite im Wahlpogramm ausgefüllt werden", oder eine externe Quelle - dann bleibt das Feld "Seite im Wahlprogramm" leer, dafür muss der Name der Quelle und eine URL angegeben werden.


3.3 Status

Wenn ein Thema geöffnet wurde (siehe 3.1) wird in der unteren Hälfte eine Liste aller enthaltenen Status, sortiert nach Datum, angezeigt.
Ein neuer Status kann über den Button "Neuer Status" erstellt werden. Hier sind alle Felder Pflichtfelder. Im unteren Bereich kann für jedes Versprechen eine Bewertung ausgewählt werden, die mit diesem Status zusammengehört. Ist in diesem Status keine Information über ein Versprechen enthalten, sollte hier "Keine Information" ausgewählt werden.


[...]


Dokumentation (work in progress)
=============================

1. Struktur


1.1 Parteien / "parties"

Parteien enthalten einen Namen ("name"), ein Kürzel ("acronym"), eine Farbe ("colour") und eine Reihenfolge ("order"). Außerdem werden URL ("programme_url") und Name ("programme_name") sowie ein Seiten-Offset ("programme_offset") festgelegt. Parteien können in die Wertung aufgenommen oder aus der Wertung ausgeschlossen werden ("doValue"). Üblicherweise wird dadurch zwischen Regierungs- und Oppositionsparteien unterschieden.



1.2 Themen / "issues"

Die oberste Ebene sind die Themen. Sie werden noch keinen Parteien zugeordnet, sondern sind erstmal grobe Zusammenfassungen. Themen enthalten einen Namen ("name"), eine Beschreibung ("desc") und können mehreren Kategorien zugeordnet werden ("category_ids").


1.3 Kategorien / "categories"

Themen werden in Kategorien zusammengefasst. Kategorien enthalten einen Namen ("name"). Außerdem können sie deaktiviert werden, um sie nicht in der Übersicht anzuzeigen ("disabled").


1.4 Versprechen / "pledges"

Versprechen werden einem Thema ("issue_id") und einer Partei ("party_id") zugeordnet. Sie enthalten einen Namen ("name") und eine Beschreibung ("desc"). Außerdem wird die Quelle definiert, hierbei wird unterschieden zwischen dem Wahlprogramm ("quotetype" = "programme") und einer anderen externen Quelle ("quotetype" = "link"). Fürs Wahlprogramm muss zusätzlich noch die Seite angegeben werden ("quotepage"), für eine externe Quelle die URl ("quoteurl") und der Name der Quelle ("quotesource"). In beiden Fällen muss ein Zitat der Quelle angegeben werden ("quotetext").
Grundsätzlich wird zwischen zwei verschiedenen Arten von versprechen unterschieden: Einer Forderung ("type" = 0) und einer Bewahrung eines Zustands ("type" = 1).
Weiterhin wird ein Startwert für die Umsetzung über "default_pledgestatetype_id" festgelegt.


1.5 Status / "states"

Wie sich der Zustand eines Themas mit der Zeit ändert, wird über Status geregelt. Ein Status wird einem Thema zugeordnet ("issue_id"). Er entält einen Text ("name"), ein Datum ("datum") und eine Quelle, mit URL ("quoteurl"), Quellenname ("quotesource") und einem Zitat ("quotetext").


1.6 Verbindung von Status und Versprechen / "pledgestates"

Mit jeder Statusänderung kann sich auch der Umsetzungsstand der Versprechen innherhalb eines Themas ändern. Das wird über die "pledgestates" geregelt.
Pledgestates sind einem Versprechen ("pledge_id") und einem Status ("state_id") zugeordnet. Außerdem wird der neue Umsetzungsstand über "pledgestatetype_id" festgelegt. 0 bedeutet hierbei, dass der Status keine Auswirkungen auf das versprechen hat.


1.7 "pledgestatetypes"

Welchen Zustand ein Versprechen haben kann, wird über die "pledgestatetypes" geregelt. Hier wird wie bei den versprechen grundsätzlich zwischen Forderung ("type" = 0) und Zustand bewahren ("type" = 1) unterschieden.
Ein pledgestatetype enthält eine Bezeichnung ("name"), einen Wert ("value", üblicherweise 0 oder 1), eine Reihenfolge ("order"), und eine Farbe ("colour"). Außerdem kann über "multipl" festgelet werden, ob Versprechen mit diesem Zustand zur Gesamtzahl hinzugezählt werden sollen ("multipl", üblicherweise 0 oder 1).


1.8 "pledgestatetypegroups"

Pledgestatetypes können in Gruppen zusammengefasst werden. Pledgestatetypegroups enthalten eine Bezeichnung ("name"), eine Farbe ("colour"), eine Reihenfolge ("order") und die pledgestatetypes ("pledgestatetype_ids").