# TransArcServer
Services web de l'application mobile [TransArc](https://github.com/danydacosta/TransArc).

## Documentation
Ce programme peuple une base de donnée avec les régions, lignes/directions ainsi que les arrêts du réseau des transports publiques de l'arc jurassien. Il contient également une API REST permettant de récupérer les informations sous format JSON.

![alt text](https://img4.hostingpics.net/pics/558732transarcservermld.png)
*Modèle logique de donnée (MLD)*

### Librairie
[Simple HTML DOM](https://github.com/sunra/php-simple-html-dom-parser) est une libraire permettant de manipuler du code HTML un peu à la manière de jQuery. Pour plus d'informations, lire la [documentation](http://simplehtmldom.sourceforge.net/).

### Requêtes à l'API
Afin de récupérer les informations de la BDD dans le but de les utiliser, il suffit de faire une requête HTTP (voir exemples). Les informations sont ainsi retournés sous format JSON.

##### Regions :
```
http://example.com/transarcserver/scripts/getRegions.php
```

##### Lignes/directions :
```
http://example.com/transarcserver/scripts/getLinesDirections.php?numregion=ID DE LA REGION
```

##### Arrêts :
```
http://example.com/transarcserver/scripts/getStops.php?numlinedirection=ID DE LA LIGNE/DIRECTION
```

##### Exemple de résultat :
```JSON
[
  {
    "id":"1","0":"1",
    "name":"Littoral & Val-de-Ruz","1":"Littoral & Val-de-Ruz",
    "url":"https:\/\/m.transn.ch\/transports-publics-neuchatelois\/reseau-horaires\/littoral-val-de-ruz.html","2":"https:\/\/m.transn.ch\/transports-publics-neuchatelois\/reseau-horaires\/littoral-val-de-ruz.html"
  }
]
```
