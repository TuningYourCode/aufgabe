## Aufgabe

Richte eine Entwicklungsumgebung mit Docker, Ansible oder Puppet für dieses PHP Projekt ein.
Nutze einen HyperVisor um eine Debian Linux VM zu starten sofern Ansible oder Puppet verwendet wird.

Beachten Sie dabei folgende Vorgaben:

- Schreibe alle eingehenden Requests um, dass diese von der `index.php` verarbeitet werden.
- Die `index.php` erwartet die Angaben zur Datenbankverbindung als Umgebungsvariablen.
    - `DB_HOST` - Hostname der Datenbank
    - `DB_PORT` - Port der Datenbank
    - `DB_NAME` - Name der bereits angelegten Datenbank
    - `DB_USER` - Benutzername für die Datenbankverbindung
    - `DB_PASS` - Passwort für die Datenbankverbindung

## Empfohlener Stack

- PHP 8.2 (mit FPM)
- MySQL 8.0
- nginx
