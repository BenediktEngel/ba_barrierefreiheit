# ba_barrierefreiheit
Dieses Repository beinhaltet alle Implementierungen aus der Bachelorarbeit "Erstellung barrierefreier Webinhalte mit Hilfe des Content-Management-Systems WordPress".

## Aufbau
Die Implemenierung unterteilte sich in Kapitel 5 in zwei Teile, zum einen die Überarbeitung der überprüften Themes. Die Theme-Ordner dieser sind im Ordner `/Themes` zu finden. Der zweite Teil stellt das Plugin dar, welches neue Blöcke zum Gutenberg-Editor hinzufügt. Dieses befindet sich im Ordner `/Plugin`.

## Verwendung der Themes
1. Jeweiligen Themeordner in `/wp-content/themes` verschieben. 
2. `.mo`- und `.po`-Dateien aus dem Themeordner nach `/wp-content/langauges/themes` verschieben.
3. In der Wordpress-Administrationsoberfläche unter Themes jeweiliges Theme aktivieren (.../wordpress/wp-admin/themes.php).

## Verwendung des Plugins
1. Ordner `barrierefreie-bloecke` in den Ordner `/wp-content/plugins` verschieben.
2. In der Wordpress-Administrationsoberfläche unter Plugins das Plugin `Barrierefreie Blöcke` aktivieren (.../wp-admin/plugins.php).
3. Block-Editor für beliebige Seite oder Beitrag öffnen.