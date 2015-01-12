VCP Niedersachsen
====

Das offizielle Wordpress-Theme des [VCP Niedersachsen](http://www.vcp-niedersachsen.de/) basierend auf dem [Yoko](http://www.elmastudio.de/wordpress-themes/yoko/)-Theme von [Elmastudio](http://www.elmastudio.de/).

## Mitarbeit

Mitarbeit am Theme ist hoch willkommen! Daher auch die Entscheidung, das Theme auf GitHub zu lagern. Es gibt zwei Wege, einen Beitrag zu leisten: Bug-Reports melden bzw. Anregungen geben und Code beisteuern.

### Bug-Reports & Anregungen

Wenn an der [Seite](http://www.vcp-niedersachsen.de/) etwas kaputt ist oder verbessert werden kann, kannst du einen [Issue](https://github.com/herschel666/wp-vcp-niederdsachsen/issues/) aufmachen und beschreiben, worum es geht. Achte bei Bug-Reports aber bitte darauf, dass diese genau beschreiben, was nicht so funktioniert, wie es soll. Issues à la "Die Navigation ist kaputt" sind nicht hilfreich.

Außerdem ist es wichtig, alle nötigen Kontext-Informationen mit zu geben: welcher Browser (plus Version) auf welchem Betriebssystem (plus Version) auf was für einem Gerät (Desktop-PC, Tablet, Smartphone, …).

Bei Anregungen schadet es ebenfalls nicht, konkret und detailreich zu beschreiben, was man für verbesserungswürdig erachtet. Ein Issue à la "Der Fußbereich der Seite könnte schöner sein." ist nur bedingt brauchbar.

### Code beisteuern

Am besten ist natürlich, nicht nur Bug-Reports und Anregungen zu liefern, sondern die Lösungen/Umsetzungen gleich nach zu schieben. Dies geschieht über den klassischen GitHub-Workflow:

1. Du forkst dieses Repo
2. Du legt einen neuen Branch für dein/en Fix/Feature an
3. Du pushst den Branch in dein Repo
4. Du öffnest einen Pull-Request im ursprünglichen Repo

Wenn mit deinem Code alles in Ordnung ist, werden deine Änderungen in dieses Repo ge-mergt. Bitte beachte Punkt 2 — Pull-Requests in den Master-Branch werden nicht ge-mergt!

## Entwickeln

Im folgenden wird beschrieben, was du tun musst, um an diesem Theme mit entwickeln zu können.

### Vorbereitungen

Um mit entwicklen zu können, ist ein ganzer Haufen Software nötig. Was du noch nicht auf deinem Rechner hast, musst du installieren. Folgendes wird benötigt:

1. [Git - Versionsmanagement](http://git-scm.com/downloads)
2. [Sublime Text 2](http://www.sublimetext.com/2) (oder ein anderer Code-Editor)
2. [Virtualbox](https://www.virtualbox.org/wiki/Downloads)
3. [Vagrant](https://www.vagrantup.com/downloads.html)
4. [Vagrant-LAMP](https://github.com/r8/vagrant-lamp)
4. [Node.js](http://nodejs.org/download/)
5. [Ruby](https://www.ruby-lang.org/de/downloads/)
6. [SASS](http://sass-lang.com/)
7. [Bower](http://bower.io/)
8. [Grunt](gruntjs.com)

#### Git

Git wird für die Versionierung benötigt. Eine gute Einführung findest du bei [Codeschool](https://try.github.io). Weiterführende Informationen bietet das [Git-Buch](http://git-scm.com/book/de). Wobei man meist nicht mehr als die Basis-Befehle braucht.


#### Sublime Text 2

Sublime Text ist ein Code-Editor. Falls du schon einen präferierten Code-Editor hast, kannst du diesen Punkt ignorieren.

#### Virtualbox

Virtualbox wird benötigt, um Vagrant zum Laufen zu bringen.

#### Vagrant

Vagrant ist ein Command-Line-Tool, mit dem man sehr einfach vorkonfigurierte Server aufsetzen kann. Weiter unten beschreibe ich, wie man ohne Vagrant arbeiten kann.

#### Vagrant-LAMP

Vagrant-LAMP ist ein klassischer **L**inux/**A**pache/**M**ySQL/**P**HP-Server für die Vagrantbox. Damit hast du eine vernünftige Entwicklungsumgebung und musst nicht am Live-Server rum schrauben.

#### Node.js

Node.js ist ein System, um Javascript mithilfe von Googles V8-Engine Server-seitig laufen lassen zu können. Es wird für den Entwicklungs-Workflow benötigt.

#### Ruby

Ruby ist eine dynamische Programmiersprache. Benötigt wird sie für den CSS-Präprozessor. Auf Mac OSX ist Ruby bereits installiert, für Windows gibt es einen Installer.

#### SASS

SASS ist ein sogenannter CSS-Präprozessor. Er macht das Schreiben von CSS etwas erträglicher. Wenn du Ruby auf deinem System hast, kannst du SASS bequem über die Kommandozeile installieren:

```bash
$ gem install sass
```

#### Bower

Bower ist ein Package-Manager für Frontend-Dependencies. Er wird mithilfe des Node-Package-Managers ([NPM](https://docs.npmjs.com/getting-started/what-is-npm)) installiert. Klingt bescheuert, ist es irgendwie auch. Aber darum geht es jetzt nicht. Also ran an die Kommandozeile und folgendes eingegeben:

```bash
$ npm install -g bower
```

Unter Mac OSX musst du wahrscheinlich ein `sudo` voran stellen.

#### Grunt

Grunt ist ein Task-Runner. Er hilft uns u. a. dabei, das SASS zu kompilieren und das Javascript zu minifizieren. Er kann ebenfalls per NPM installiert werden:

```bash
$ npm install -g grunt-cli
```

Unter Mac OSX wieder ein `sudo` voran stellen.

### Anlegen eines GitHub-Accounts

Das Code-Versionierungs-Tool Git hast du ja bereits installiert. Nun brauchst du noch einen GitHub-Account, um deine Versionsstände mit anderen teilen zu können. Lege einen Account an. GitHub bietet dir eine gute Anleitung, wie du deinen Computer für die Arbeit mit einem *Remote Git Server* einrichtest.

### Einrichten des Wordpress-Systems

Sobald alles installiert ist und die Vagrantbox mit dem LAMP-Server läuft, kann das Wordpress-System eingerichtet werden. Dafür müsst ihr als erstes den Host "vcp-niedersachsen.xy" anlegen.

Da Wordpress mit serialisierten Daten arbeitet, ist es wichtig, dass die Seite lokal unter [http://www.vcp-niedersachsen.xy](http://www.vcp-niedersachsen.xy) läuft, da sonst bei der Datenbank-Migration Daten verloren gehen.

Ist der Host angelegt, kann der komplette Inhalt vom Strato-Server (Ordner *vcp-niedersachsen.de*) unter *./public/vcp-niedersachsen.xy* abgelegt werden. Das kann eine Weile dauern, da im *wp-content*-Ordner eine Menge Fotos liegen.

Ist alles runter geladen, könnt ihr den Ordner *./wp-content/themes/vcp-niedersachsen/* löschen, da dieser von GitHub kommen wird. Alternativ kann man den Ordner beim Runterladen auch einfach übergehen.

Als nächstes loggen wir uns bei Strato ein und laden einen MySQL-Dump der Datenbank runter. Die entsprechenden Zugangsdaten gibt es bei der AG Medien. Den Dump öffnen wir im Code-Editor und machen einen Search-Replace auf "*www.vcp-niedersachsen.de*" **=&gt;** "*www.vcp-niedersachsen.xy*".

Den bearbeiteten Dump laden wir nun unter [http://local.dev/phpmyadmin](http://local.dev/phpmyadmin) in die lokale Datenbank der Vagrantbox.

Nun können wir das eigentliche Theme mithilfe von Git runter laden. Dafür begeben wir uns in der Kommandozeile in den Themes-Ordner und machen dort ein `git clone` auf den Fork auf das **wp-vcp-niedersachsen**-Repo.

```bash
$ pwd
  => ./path/to/vagrantbox/
$ cd public/vcp-niedersachsen.xy/wp-content/themes/
$ git clone git@github.com:<your username>/wp-vcp-niederdsachsen.git vcp-niedersachsen
```

Anschließend begeben wir uns in den Ordner *vcp-niedersachsen* und installieren die für die Entwicklung benötigten Packages:

```bash
$ cd vcp-niedersachsen
$ npm install
$ bower install
```

Nun sind alle nötigen Tools installiert und die Seite sollte lokal bei euch unter [http://www.vcp-niedersachsen.xy](http://www.vcp-niedersachsen.xy) im Browser laufen.

### Nutzung des Grunt-Taskrunners

Der Grunt-Taskrunner kennt vier relevante Befehle. Diese musst du in der Kommandozeile im Theme-Ordner eingeben (*./path/to/vagrant/public/vcp-niedersachsen.xy/wp-content/themes/vcp-niedersachsen/*).

#### `grunt scss`

Dieser Task kompiliert das SASS und speichert das Resultat als *./style.css* im Theme-Ordner.

```bash
$ grunt scss
```

#### `grunt js`

Dieser Task fasst alle relevanten Javascript-Dateien zusammen und speichert diese unter *./assets/scripts/main.js* im Theme-Ordner.

```bash
$ grunt js
```

#### `grunt build`

Dieser Task führt die beiden voran gegangenen Tasks aus und minifiziert zusätzlich noch die *./assets/scripts/main.js*. Dies geschieht aus Performance-Gründen.

```bash
$ grunt build
```

#### `grunt watch`

Dieser Befehl "beobachtet" alle `.scss`-Dateien unter *./assets/styles/* und alle `.js`-Dateien und *./assets/scripts/project/* und ruft die korrespondierenden Grunt-Tasks (`grunt scss` und `grunt js`) auf, wenn bei diesen eine Änderung gespeichert wird. So musst du dich um nichts mehr kümmern.

### Schreiben von SASS

Die Überschrift ist nicht ganz korrekt, da bei diesem Theme die SCSS-Syntax verwendet wird. Ganz ohne geschweifte Klammern und Semikolons sieht es einfach nach nichts aus.

Wenn du CSS kennst, kannst du eigentlich direkt loslegen. Allerdings gibt es ein paar Dinge zu beachten.

#### SASS kann mehr

SASS bietet verschiedene Sachen, die es im CSS größtenteils so nicht gibt. Sei es das Anlegen von Variablen, das Definieren von Mixins und Funktionen, Rechen-Operationen, Funktionen zum Modifizieren von Farbwerten, etc. pp.

Daher ist es wichtig, dass du dir — falls du noch nicht mit SASS gearbeitet hast — einmal die Doku anguckst, um einen ungefähren Überblick über die Möglichkeiten zu kriegen. Dabei musst du nicht gleich alles uswendig lernen — es reicht, eine ungefähre Ahnung zu bekommen. Nachschlagen kannst du dann im konkreten Fall immer.

#### Funktionen, Mixins und Variablen

Ganz oben im Ordner *./assets/styles/project/* befinden sich die drei Dateien für Funktionen, Mixins und Variablen.

##### Funktionen

Funktionen bieten die Möglichkeit, Werte oder Zeichenketten zu manipulieren. Wenn du z. B. mehrmals über die gleiche bzw. eine ähnliche Rechen-Operation stolperst, kannst du diese in eine Funktion auslagern. Ganz im Sinne von [DRY](http://de.wikipedia.org/wiki/Don%E2%80%99t_repeat_yourself).

Wirf einen Blick in die `_functions.scss`-Datei, um einen Überblick darüber zu bekommen, was für Funktionen bereits definiert sind.

##### Mixins

Ein Mixin ist so ähnlich wie eine Funktion, es nimmt bspw. auch Argumente entgegen. Genau genommen ist es jedoch eine Direktive, die es dir ermöglich, SASS-Code programmatisch zu erzeugen.

Im einfachsten Fall kann ein Mixin dafür herhalten, Vendor-Prefixes "weg zu abstrahieren". Es lassen sih jedoch auch viele weitere Anwendungsfälle denken. Auch bei den Mixins geht es letztlich darum, seinen Code [DRY](http://de.wikipedia.org/wiki/Don%E2%80%99t_repeat_yourself) zu halten.

Solltest du also bei deiner Arbeit an einen Punkt kommen, wo du dich im SASS bei sehr grundlegenden Sachen zu wiederholen anfängst, überlege, ob man das ganze in ein Mixin auslagern kann.

Weiterhin ist ein Mixin ratsam, wenn du bei einer CSS3-Eigenschaft Vendor-Prefixes schreiben musst. Anstatt diese über deine ganze SASS-Codebase zu verteilen, kannst du sie an einer Stelle "vorhalten" und bequem pflegen, wenn die Browser-Landschaft sich wieder modernisiert hat.

Auch hier gilt: wirf einen Blick in die `_mixins.scss`, um eine Vorstellung davon zu bekommen, welche Mixins es schon gibt.

##### Variablen

Variablen sind eine großartige Möglichkeit, bestimmte Werte wie Farben, Schriftgrößen, Dimensionen, etc. pp. an einer zentralen Stelle zu verwalten.

Ändert sich dann bspw. mal das CI-Blau, musst du nicht durch alle SCSS-Dateien asten, um den Farbwert anzupassen, sondern machst dies einmal bequem in der `_variables.scss`.

Beim Anlegen von Variablen muss man es nicht übertreiben, schließlich soll die Liste pflegbar bleiben. Aber achte auch hier darauf, dass du Werte, die sich an vielen Stellen wiederholen und dabei einen Bezug zueinander haben, in einer Variable fest zu halten.

#### Modulares SASS

Früher hatte man eine CSS-Datei, in die man alle seine Angaben rein geworfen hat. Dabei hat man sich sukzessive durch seine Website geackert und munter drauf los geschrieben.

Das muss heutzutage nicht mehr sein. Zum einen können wir aus mehreren `.scss`-Dateien bequem eine CSS-Datei kompilieren, so dass man nicht mehr hundert Zeilen und mehr in einer Datei haben muss.

Außerdem ist es bei der Größe der heutigen Websites wichtig, sein CSS nicht unnötig aufzublähen. Wie oben schon erwähnt, geht es darum, seinen Code [DRY](http://de.wikipedia.org/wiki/Don%E2%80%99t_repeat_yourself) zu halten. Du solltest daher versuchen, deine Selektoren mit Hinblick auf Wiederverwendbarkeit zu schreiben und diese nicht unnötig zu verschachteln, da dadurch die Spezifität erhöht wird, was wir nicht gebrauchen können.

Außerdem gilt ein absolutes **ID-Verbot** im SASS. Klassen-Selektoren sind optimal, Attribut- und Pseudo-Selektoren runden das ganze ab.

#### Warum kein BEM?

[BEM](http://csswizardry.com/2013/01/mindbemding-getting-your-head-round-bem-syntax/) ist eine Art und Weise, seine CSS-Selektoren zu schreiben und sein CSS zu strukturieren. Die Grundannahme dabei ist, dass sich alle Elemente einer Website als Blöcke betrachten lassen, die wiederum eine gewisse Anzahl von Elementen beinhalten, welche wiederum je nach "Einsatzort" geringfügig modifiziert sein können.

```html
<div class="slideshow">
  <h2 class="slideshow__caption">Eine Slideshow</h2>
  <div class="slideshow__content">
    <img class="slideshow__item" src="…" alt="…">
    <img class="slideshow__item slideshow__item--current" src="…" alt="…">
    …
  </div>
</div>
```

So lässt sich — in der Theorie — sehr schlankes, performantes CSS mit einer hohhen Wiederverwendbarkeit schreiben.

Ich selbst finde die BEM-Syntax sehr charmant, allerdings ist das Theme, auf welchem die VCP-Niedersachsen-Seite basiert, mit "klassischer" CSS-Selektor-Benamung/-Strukturierung gebaut worden. Ein Refactoring auf BEM wäre sehr zeitintensiv und hat momentan keine Priorität.

Allerdings solltest du versuchen, den Ansatz zu verstehen und beim Schreiben von SCSS für dieses Theme, die enthaltenen Grundsätze der Modularität so gut es geht mit einfließen zu lassen.

### Schreiben von Javascript

Beim Schreiben von Javascript kommt [jQuery](https://jquery.org/) zum Einsatz, um die Angelegenheit nicht unnötig kompliziert zu machen. Dieses wird direkt von Wordpress "gezogen". Alle weiteren benötigten Skripte (z. B. jQuery-Plugins) können mit dem Package-Manager Bower bezogen werden.

#### Organisation von Dateien

Da wir Dank Grunt eine automatische Konkatenation und Minifizierung haben, gibt es keinen Grund, alles in eine Datei zu schreiben. Daher gilt hier der gleiche, modulare Ansatz wie beim CSS. Ein Element auf der Seite — bspw. eine Bilder-Slideshow — hat eine Funktionalität — Bilder sliden! — und bekommt daher seine eigene `.js`-Datei, in welcher diese Funktionalität definiert ist.

Als Selektoren werden in der Regel `js-`-ge-präfixte Klassen verwendet. Z. B.:

```html
<div class="slideshow js-slideshow">
  …
</div>
```

So lässt sich das Styling von der Funktionalität trennen.

#### Was ist mit IDs?

Im Javascript sind ID-Selektoren grundsätzlich okay, da sie sehr schnell sind. Überlege jedoch vorher, ob du eine Funktionalität baust, die mehrfach auf einer Seite auftretn kann. In diesem Fall solltest du auf einen Klassen-Selektor zurück greifen.

#### Verwendung von jQuery

jQuery läuft unter Wordpress Standard-mäßig im sog. *No-Conflict-Mode*. D. h. es ist nicht über die `$`-Funktion im globalen Namensraum ansprechbar, sondern über das etwas umständlichere `jQuery`.

Um trotzdem die `$`-Funktion verwenden zu können, gibt es zwei Möglichkeiten.

##### Die *Immediately Invoced Function Expression* (IIFE)

Dies ist eine Funktion, die sofort ausgeführt und dafür "missbraucht" wird, einen lokalen Namensraum auf zu machen, in welchem man bspw. relativg efahrlos die `$`-Funktion nutzen kann. Das ganze sieht so aus:

```javascript
(function ($) {
  …
})(jQuery);
```

Der Funktion wird `jQuery` als Argument übergeben, innerhalb der Funktion ist dann die `$`-Funktion nuttbar.

##### Der implizite `DOMReady`-Callback der `$`-Funktion

Die `$`-Funktion von jQuery wartet immer, bis das DOM (Document Object Model) fertig gebaut ist. Außerdem gibt sie einer ihr übergebenen, anonymen Callback-Funktion sich selbst mit. Das klingt kompliziert, ist aber ganz einfach:

```javascript
jQuery(function ($) {
  …
});
```

Wie bei der IIFE ist innerhalb dieses Blocks die `$`-Funktion nutzbar. Zusätzlich hat man den Vorteil, dass das DOM fertig ge-rendert ist, wenn man seine Funktionen ausführt. Letzteres ist in der Regel jedoch nicht so relevant, da die `main.js` ganz am Ende der Seite eingebunden wird und das DOM bis dahin sowieso fertig aufgebaut ist.

#### 3rd-Party-Skripte hinzufügen mit Bower

Man muss natürlich nicht alles selbst schreiben. Viele gute (und leider auch weniger gute, aber sehr engagierte) Entwickler haben unzählige Plugins für jQuery geschrieben. Diese können mit dem Package-Manager Bower installiert werden.

Angenommen, man möchte performante Animationen machen. Dafür bietet sich Velocity.js an. Wir guken also, ob es das bei Bower gibt und installieren es, wenn dem so ist.

Dafür geben wir in der Kommandozeile in unserem Theme folgendes ein:

```bash
# Suchen nach Velocity.js
$ bower search velocity

# Wir werden fündig und installieren es
$ bower install velocity --save
```

Durch das `--save` wird die Information (Package-Name und Version) in die `bower.json` geschrieben. Wir müssen die Packages also nicht mit versionieren, sondern können diese bequem aus dem Bower-Repository ziehen, wann immer wir sie brauchen.

Um das installierte Package nun noch verwenden zu können, müssen wir den Pfad in der `Gruntfile.coffee` im Bereich `concat::dist::src` hinzufügen. Die Datei(en) liegen im Ordner *./assets/vendor/*, der Platzhalter `<%= paths.vendor %>` zeigt auf diesen. Orientiere dich einfach an den bereits eingebundenen Skripten.

Nun wird das neue Skript beim `grunt js`-Task mit in die `main.js` "gesteckt".

### Entwicklen ohne Vagrant

…

## License

Copyright (C) 2014  Emanuel Kluge

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
