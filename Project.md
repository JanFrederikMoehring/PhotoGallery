# Azubi-Projekt: Foto-Alben in PHP

## Ziel & Rahmen

Du baust eine Web-App, in der angemeldete Nutzer Fotos in Alben hochladen, ansehen und per Link teilen können.

## Technische Vorgaben

| Bereich | Vorgabe |
| --- | --- |
| Sprache | PHP |
| Framework | eigenes, selbstgeschriebenes Framework (Aufbau, Controller, Datenbankzugriff, Views) |
| Packages | zusätzliche Packages über Composer erlaubt, z. B. für den Router |
| Datenbank | SQLite |
| Styling | Tailwind CSS, eingebunden per Script-Link (CDN) |
| Foto-Speicherort | außerhalb des Webroots |

## Benutzer & Rollen

Ohne Login geht nichts (Ausnahme: Teilen-Links). Es gibt zwei Rollen und genau einen Admin.

| Rolle | Darf |
| --- | --- |
| User | anmelden und abmelden; eigene Alben anlegen; eigene Fotos hochladen, ansehen, löschen und teilen |
| Admin | alle Alben und Fotos aller User sehen; einzelne Fotos und Alben löschen; neue User anlegen |

- Der Admin wird über einen **CLI-Befehl** angelegt.
- Es gibt **keine Selbstregistrierung**. Neue User legt nur der Admin an.

## Alben & Fotos

Jeder User sieht nur seine eigenen Alben und Fotos.

- **Alben:** User legen Alben an und laden Fotos hinein.
- **Album-Ansicht:** 10 Fotos pro Seite, die weiteren über Pagination. Sortiert wird nach Upload-Datum.
- **Formate:** gängige Bildformate, mindestens JPEG und PNG. Geprüft wird der echte Dateityp, nicht nur die Endung.
- **Zwei Versionen pro Foto:** Das Original wird für die Großansicht gespeichert, die per Klick im Album aufgeht. Dazu kommt eine verkleinerte Vorschau für die Album-Ansicht.
- **Löschen:** User löschen eigene Fotos und Alben. Dabei verschwinden der Datenbankeintrag und beide Dateien von der Platte. Ein gelöschtes Album nimmt alle seine Fotos mit.

## Teilen

Ein Teilen-Link ist der einzige Weg, fremde Fotos zu sehen.

- Teilen geht für **einzelne Fotos** und für **ganze Alben**. Ein Klick auf "Teilen" erzeugt den Link.
- Wer den Link hat, sieht das Foto oder Album ohne Login. Bei geteilten Alben funktionieren Pagination und Großansicht wie gewohnt.
- Der Link enthält einen **zufälligen, nicht erratbaren Token** statt einer fortlaufenden ID.
- Ein Link läuft nicht ab und kann nicht widerrufen werden.
- Ist das Foto oder Album gelöscht, liefert der Link **404**.

## Sicherheit

Rechte werden immer serverseitig geprüft, nicht nur durch ausgeblendete Buttons.

- Fotos werden nur über einen Controller ausgeliefert. Der prüft, ob der Nutzer das Foto sehen darf (Besitzer, Admin oder gültiger Teilen-Link). Eine direkte Datei-URL gibt es nicht.
- Passwörter werden gehasht gespeichert (`password_hash`).
- Datenbankzugriffe laufen über Prepared Statements.
- Ausgaben in Templates werden escaped.

## Git & Abgabe

Git nutzt du vom ersten Tag an.

- Committe in sinnvollen Abschnitten: Ein Commit enthält eine abgeschlossene Änderung und hat eine aussagekräftige Message.
- Das DB-Schema bzw. die Migrationen gehören ins Repo. Die SQLite-Datei, die Uploads und `vendor/` kommen in die `.gitignore`.
- Schreib eine README mit Setup-Anleitung: Packages installieren, Datenbank anlegen, Admin per CLI anlegen, App starten.
- Fertig ist das Projekt, wenn jemand das Repo frisch klonen und mit der README zum Laufen bringen kann.

## Eigene Entscheidungen

Diese Punkte entscheidest du selbst. Begründe deine Wahl jeweils kurz in der README.

- Größe der Vorschaubilder und womit du sie erzeugst (GD oder ein Composer-Package)
- Maximale Dateigröße beim Upload und ob mehrere Fotos auf einmal hochgeladen werden können
- Sortierrichtung: neueste oder älteste Fotos zuerst
- Ob User ihr Passwort selbst ändern können
- Ob der Admin auch eigene Alben hat
- PHP-Version und Coding-Standard (z. B. PSR-12)
- Tests: ob und wofür
- Branches: ob du mit Feature-Branches arbeitest oder direkt auf `master`
 