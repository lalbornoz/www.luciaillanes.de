    <div class="div-box div-content">
      <h1>Open Source Projektbeteiligung</h1>

      <h2>
        <a href="https://github.com/lalbornoz/midipix_build">
          midipix_build: build/cross-compilation-Infrastruktur für Midipix, eine POSIX/Linux-kompatible Entwicklungs/Endnutzerumgebung für Windows
          (Februar 2016-2024)
        </a>
      </h2>
      <p>
        Midipix<a href="http://www.midipix.org/">[1]</a> ist eine POSIX/Linux-kompatible Umgebung für Windows XP/Server 2003 oder später, die
        sowohl Cross-compilation als auch Benutzung von Anwendungen ermöglicht, die nach dem bzw. für POSIX-Standard bzw. Linux programmiert
        wurden. Dies erfolgt hierbei ohne einen untragbaren Leistungsverlust. Im Gegensatz zu Cygwin<a href="https://www.cygwin.com/">[2]</a>
        ist Midipix nicht an Interaktion mit der eigentlichen Windows-Umgebungssystem gebunden um dessen System calls zu implementieren. Im
        Gegensatz zu Interix<a href="https://technet.microsoft.com/en-us/library/bb463204.aspx">[3]</a> stellt Midipix kein eigenes
        Umgebungssystem dar, ohne dementsprechende Server und Client DLL(s). Weder Virtualisierung noch Kernel-mode Treiber sind sind
        benötigt: an dessen Stelle tritt eine kleine Gruppe von “runtime components“, welche die Kommunikation zwischen Musl, die
        libc des Projektes und der Windows NT executive (NTOSKRNL.EXE) vermitteln.<br>
        <br>
        Zu Beginn des midipix_build-Projektes<a href="https://github.com/lalbornoz/midipix_build">[4]</a> fand die [Cross-]compilation der
        Toolchain, der Runtime components und einer offenen Menge Software seitens Drittanbieter durch mehrere Bourne-Shellskripte statt. Dies
        stellte sich letztlich als nicht Skalierbar heraus. Demnach wurde nun eine ausreichend Umfassende Build/Cross-compilation-Infrastruktur
        benötigt. Da Midipix sich bislang auch weiterhin in ständiger Veränderung befindet wurde ein iteratives Entwicklungsparadigma gewählt:
        architekturelle Überlegungen demnach von eher geringer Bedeutung. Umstrukturierung des Codes hat lediglich zwei Male stattgefunden. Die
        derzeitige Konzeption hat sich letztlich dem Zwecke dienend bewähren können. Die folgenden Ziele und Bedingungen sind aus diesem Prozess
        hervorgegangen:<br>
      </p>

      <ol>
        <li>
          <b>Portabilität</b>: midipix_build, vergleichbar mit NetBSD’s build.sh, unter Ausschluss von make(1), musste und muss zum
          Teil weiterhin Cross-compilation einer großen Menge von Software auf einer ebenso großen Menge von Plattformen unterstützen,
          insoweit letztere zu einem Genügenden Maße POSIX-kompatibel sind. Dementsprechend wurde Bourne shell als Programmiersprache
          gewählt, obschon eine geringe Menge von POSIX-Erweiterungen benutzt werden, wie z.B. funktionslokale Variablen. Dies erlaubt
          den Build von Midipix auf Linux, Cygwin und natively, d.h. innerhalb Midipix, als auch die meisten BSD-Derivate.
        </li>
        <li>
          <b>Flexibilität</b>: die Architektur von midipix_build muss ebenso Einfachheit wie Veränderbarkeit kennen, um der Hinzufügung
          und/oder Entfernung von Funktionen mit einer relativ hohen Geschwindigkeit nicht im Wege zu stehen, wie z.B. Abhängigkeitsauflösung,
          Parallelisierung, signierte Distributionsarchive, automatisierte Suche nach neuen Softwareversionen, usw. Desweiteren kann selbst die
          ledigliche Hinzufügung weiterer Software vernotwendigen, neue Abstraktionen einzuführen bzw. bestehende zu verändern, insbesondere
          insoweit sich diese auf GNU autotools- und Cmake-basierte Buildsysteme beziehen.
        </li>
        <li>
          <b>Komfort und Verlässlichkeit</b>: im Üblichen vermittelt midipix_build die Einführung und Benutzung von Midipix, allermindestens
          durch die Distributionsarchive, die es erstellt. Sowohl Entwickler als auch Endnutzer möchten über die Fähigkeit verfügen,
          den Build ein oder einer beliebig großen Menge von Software bzw. Komponenten wie den runtime components oder der vollständige
          Umgebung einzuleiten. Daher lassen sich praktisch alle Aufgaben durch eine kleine Kommandozeile, “build.sh” aufrufend,
          vollständig Automatisiert durchführen.<br>
          Hierüber hinaus wurden die höchst ineffizienten fork-exec-write/read, allzusehr häufig in Bourne/-kompatiblen Shellcode vorkommenden,
          Codeparadigmen so gut wie vollständig eliminiert, außer dort wo diese tatsächlich durch den Aufruf externer Befehle vs. lediglich
          interne Funktionen vernotwendigt sind, mit dem Resultat einer durchaus performanten Implementation mit geringen Latenzen, inkl. dem
          Abhängigkeitsauflösungscode.
        </li>
        <li>
          <b>Einfachheit</b>: zu guter Letzt bleiben geringe Codekomplexität und -größe, insbesondere im Bezug auf Flexibilität,
          eine Priorität: derzeit umfasst der Code, unter Ausschluss von Software/Komponent-spezifische Funktionen/Variablen, ca. 6700
          SLOC; der Software/Komponent-spezifische Code umfasst ca. 4100 SLOC. Frei wiederverwendbare Funktionen, in Form von “Buildschritten”
          (z.B. fetch, extract, build, install, ...) und Prä/postschritten (z.B. setup_env, prereqs bzw. sha256sums, tarballs), befinden sich in
          ihren eigenen Quellmodulen.
        </li>
      </ol>

      <h2>
        Tcl TIP #458: Entwurf und Umsetzung der epoll/kqueue-Unterstützung im Tcl notifier auf Linux bzw. *BSD
        (<a href="https://github.com/flightaware/Tcl-bounties">FlightAware bounty programme</a>) (November 2016-Dezember 2016)
      </h2>
      <p>
        Tcl (Aussprache englisch tickle oder auch als Abkürzung für Tool command language) ist eine Open-Source-Skriptsprache.
        <a href="https://de.wikipedia.org/wiki/Tcl">[5]</a>. Mitarbeit an dem Projekt, insoweit diese öffentliche Schnittstellen in ihrem
        Verhalten verändern, wird durch die “Tcl Improvement Proposal (TIP)”<a href="http://wiki.tcl.tk/983">[6]</a> Prozedur vorgelegt
        und verarbeitet. Zu Beginn des November 2016 wurde ein bounty programme “for improvements to Tcl and certain Tcl packages” auf
        GitHub<a href="https://github.com/flightaware/Tcl-bounties">[7]</a> seitens FlightAware<a href="https://www.flightaware.com/">[8]</a>
        veröffentlicht. Ich entschied mich hierbei, die “[s]upport for epoll()/kqueue() to replace select() in socket handling”
        zu Implementieren<a href="https://github.com/flightaware/Tcl-bounties/issues/14">[9]</a>, welche ich gegen Ende Dezembers 2016
        abschloss.<br>
        <br>
        Tcl setzt eine Event-basierte Architektur in Bezug auf I/O um und verwendet hierbei Callbacks zur Benachrichtigung
        über und Verarbeitung von I/O. Beiderlei werden durch einen plattformspezifischen “notifier” implementiert. Der
        ursprünglich vorhandene Notifier verwandte hierbei den select(2) System call zum I/O multiplexing, welche der Skalabilität
        unaufwindbar im Wege stand. Die Nachteile von select(2) sind sowohl weitläufig dargelegt als auch in meinem TIP
        <a href="http://www.tcl.tk/cgi-bin/tct/tip/458.html">[10]</a> ausgeführt vorhanden, von welchen jedoch genannt werden kann, dass
        die Benutzung von select(2) üblicherweise die Menge von offenen File descriptors auf 1024 begrenzt. Die neuen Notifier für
        Linux auf der Basis von epoll(7) und *BSD auf der Basis von kqueue(2) hingegen kennen diese Probleme nicht.<br>
        <br>
        Zu guter Letzt setzte der ursprüngliche Notifier sowohl Event notification als auch Inter-thread IPC durch einen eigenen Notifier
        Thread um. Multithreading, insbesondere sofern unberechtigt, bringt zusätzliche Komplexität mit sich und führt oft zu ebenso
        komplexen Probleme, wie z.B. Race conditions, Priority inversions, usw. usf. Daher rufen die neuen Notifier epoll(7)/kqueue(2) im
        Threadkontext des Aufrufers ohne dabei neue Threads selber beizusteuern. Die Inter-thread IPC-Frage wurde, nach einiger Debatte
        auf der Mailingliste und IRC, mit einer Trigger pipe(2) auf *BSD und eventfd(2) auf Linux pro Thread gelöst. Hierdurch fügt
        dies einen File descriptor pro Thread, insofern dieser mit dem Notifier interagiert, und zwei bzw. einen File descriptor für
        Inter-thread IPC auf *BSD bzw. Linux hinzu. Da dies zu einem bedeutenden Verlust an Codekomplexität aufgrund der Entfernung des
        Notifier threads führt, ist dies jedoch von geringer Konsequenz. Insbesondere werden keine File descriptors implizit zwischen
        Threads verteilt oder benutzt, insoweit der Notifier betroffen ist.<br>
      </p>

      <h3>Links</h3>
      <p class="p-references">
        [1] <a href="http://www.midipix.org/">midipix</a><br>
        [2] <a href="https://www.cygwin.com/">Cygwin</a><br>
        [3] <a href="https://technet.microsoft.com/en-us/library/bb463204.aspx">Windows Services for UNIX Version 3.0</a><br>
        [4] <a href="https://github.com/lalbornoz/midipix_build">GitHub - lalbornoz/midipix_build: Unified build Bourne shell script for midipix</a><br>
        [5] <a href="https://en.wikipedia.org/wiki/Tcl">Tcl – Wikipedia</a><br>
        [6] <a href="http://wiki.tcl.tk/983">Tcl Improvement Proposal</a><br>
        [7] <a href="https://github.com/flightaware/Tcl-bounties">GitHub - flightaware/Tcl-bounties: Bounty program for improvements to Tcl and certain Tcl packages</a><br>
        [8] <a href="https://www.flightaware.com/">FlightAware - Flug-Tracker / Flugstatus / Flugverfolgung</a><br>
        [9] <a href="https://github.com/flightaware/Tcl-bounties/issues/14">[TIP] Intent to implement epoll()/kqueue() support for sockets on Linux/FreeBSD · Issue #14 · flightaware/Tcl-bounties · GitHub</a><br>
        [10] <a href="https://www.tcl.tk/cgi-bin/tct/tip/458.html">TIP #458: Add Support for epoll() and kqueue() in the Notifier</a><br>
      </p>
    </div>
<?php
// vim:ts=2 sw=2 expandtab fenc=utf-8 foldmethod=marker nowrap tw=145
?>
